<?php

declare(strict_types=1);

namespace Icanhazstring\PhpstanReadonlyPropertyExtension\Test;

use Icanhazstring\PhpstanReadonlyPropertyExtension\Rule\WritingToReadonlyAttributePropertiesRule;
use PHPStan\Rules\Properties\PropertyDescriptor;
use PHPStan\Rules\Properties\PropertyReflectionFinder;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleLevelHelper;
use PHPStan\Testing\RuleTestCase;

final class WritingToReadonlyAttributePropertiesRuleTest extends RuleTestCase
{
    private bool $checkThisOnly = false;

    protected function getRule(): Rule
    {
        return new WritingToReadonlyAttributePropertiesRule(
            new PropertyDescriptor(),
            new PropertyReflectionFinder(),
            new RuleLevelHelper($this->createReflectionProvider(), true, false, true, false),
            $this->checkThisOnly
        );
    }

    public function testPromotedProperties(): void
    {
        $this->analyse(
            [__DIR__ . '/data/WritingToReadonlyAttributePromotedProperty.php'],
            [
                [
                    'Property Icanhazstring\PhpstanReadonlyPropertyExtension\Test\data\WritingToReadonlyAttributePromotedProperty::$name is declared as readonly and can not be written.',
                    19,
                ],
            ]
        );
    }

    public function testClassProperties(): void
    {
        $this->analyse(
            [__DIR__ . '/data/WritingToReadonlyAttributeClassProperty.php'],
            [
                [
                    'Property Icanhazstring\PhpstanReadonlyPropertyExtension\Test\data\WritingToReadonlyAttributeClassProperty::$name is declared as readonly and can not be written.',
                    21,
                ],
            ]
        );
    }

    public function testNonAttributeClass(): void
    {
        $this->analyse(
            [__DIR__ . '/data/NonAttributeClass.php'],
            []
        );
    }
}
