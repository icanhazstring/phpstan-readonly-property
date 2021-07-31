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
            [__DIR__ . '/data/WritingToReadonlyAttribute/PromotedProperty.php'],
            [
                [
                    'Property Icanhazstring\PhpstanReadonlyPropertyExtension\Test\data\WritingToReadonlyAttribute\PromotedProperty::$name is declared as readonly and can not be written.',
                    19,
                ],
            ]
        );
    }

    public function testClassProperties(): void
    {
        $this->analyse(
            [__DIR__.'/data/WritingToReadonlyAttribute/ClassProperty.php'],
            [
                [
                    'Property Icanhazstring\PhpstanReadonlyPropertyExtension\Test\data\WritingToReadonlyAttribute\ClassProperty::$name is declared as readonly and can not be written.',
                    21,
                ],
            ]
        );
    }

    public function testNonAttributeClass(): void
    {
        $this->analyse(
            [__DIR__ . '/data/WritingToReadonlyAttribute/NonAttributeClass.php'],
            []
        );
    }

    public function testSetterAccess(): void
    {
        $this->analyse(
            [__DIR__.'/data/WritingToReadonlyAttribute/ThroughSetter.php'],
            [
                [
                    'Property Icanhazstring\PhpstanReadonlyPropertyExtension\Test\data\WritingToReadonlyAttribute\ThroughSetter::$value is declared as readonly and can only be written once in declaring class.',
                    21
                ]
            ]
        );
    }

    public function testGenericStdClass(): void
    {
        $this->analyse(
            [__DIR__.'/data/WritingToReadonlyAttribute/GenericStdClassAccess.php'],
            [
            ]
        );
    }
}
