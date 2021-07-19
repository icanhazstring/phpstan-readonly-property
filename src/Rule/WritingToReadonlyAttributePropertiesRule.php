<?php

declare(strict_types=1);

namespace Icanhazstring\PhpstanReadonlyPropertyExtension\Rule;

use Error;
use Icanhazstring\PhpstanReadonlyPropertyExtension\Attribute\Readonly;
use PhpParser\Node;
use PhpParser\Node\Expr;
use PhpParser\Node\Expr\Assign;
use PhpParser\Node\Expr\AssignOp;
use PhpParser\Node\Expr\AssignRef;
use PhpParser\Node\Expr\PropertyFetch;
use PhpParser\Node\Expr\StaticPropertyFetch;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Properties\PropertyDescriptor;
use PHPStan\Rules\Properties\PropertyReflectionFinder;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;
use PHPStan\Rules\RuleLevelHelper;

use function sprintf;

/**
 * @implements \PHPStan\Rules\Rule<\PhpParser\Node\Expr>
 */
final class WritingToReadonlyAttributePropertiesRule implements Rule
{
    private PropertyDescriptor $propertyDescriptor;
    private PropertyReflectionFinder $propertyReflectionFinder;
    private RuleLevelHelper $ruleLevelHelper;
    private bool $checkThisOnly;

    public function __construct(
        PropertyDescriptor $propertyDescriptor,
        PropertyReflectionFinder $propertyReflectionFinder,
        RuleLevelHelper $ruleLevelHelper,
        bool $checkThisOnly
    ) {
        $this->propertyDescriptor = $propertyDescriptor;
        $this->propertyReflectionFinder = $propertyReflectionFinder;
        $this->ruleLevelHelper = $ruleLevelHelper;
        $this->checkThisOnly = $checkThisOnly;
    }

    public function getNodeType(): string
    {
        return Expr::class;
    }

    public function processNode(Node $node, Scope $scope) : array
    {
        if (!$node instanceof Assign && !$node instanceof AssignOp && !$node instanceof AssignRef) {
            return [];
        }
        if (!$node->var instanceof PropertyFetch && !$node->var instanceof StaticPropertyFetch) {
            return [];
        }
        if ($node->var instanceof PropertyFetch && $this->checkThisOnly && !$this->ruleLevelHelper->isThis($node->var->var)) {
            return [];
        }
        /** @var PropertyFetch|StaticPropertyFetch $propertyFetch */
        $propertyFetch = $node->var;
        $propertyReflection = $this->propertyReflectionFinder->findPropertyReflectionFromNode($propertyFetch, $scope);
        if ($propertyReflection === null) {
            return [];
        }
        if (!$scope->canAccessProperty($propertyReflection)) {
            return [];
        }

        if ($propertyReflection->getScope()->getFunctionName() === '__construct') {
            return [];
        }

        $nativeDeclaringClass = $propertyReflection->getDeclaringClass()->getNativeReflection();
        $nativeProperty = $nativeDeclaringClass->getProperty($propertyReflection->getName());

        try {
            $nativePropertyAttributes = $nativeProperty->getAttributes();
        } catch (Error $internalError) {
            // This will throw an internal error when no attributes are given
            // Just ignore it
            return [];
        }

        $hasReadonlyAttribute = false;

        foreach ($nativePropertyAttributes as $nativePropertyAttribute) {
            if ($nativePropertyAttribute->getName() === Readonly::class) {
                $hasReadonlyAttribute = true;
                break;
            }
        }

        if (!$propertyReflection->isWritable()) {
            $propertyDescription = $this->propertyDescriptor->describeProperty($propertyReflection, $propertyFetch);
            return [RuleErrorBuilder::message(sprintf('%s is not writable.', $propertyDescription))->build()];
        }

        if ($hasReadonlyAttribute) {
            $propertyDescription = $this->propertyDescriptor->describeProperty($propertyReflection, $propertyFetch);
            return [RuleErrorBuilder::message(sprintf('%s is declared as readonly and can not be written.', $propertyDescription))->build()];
        }

        return [];
    }
}
