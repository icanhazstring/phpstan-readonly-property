<?php

declare(strict_types=1);

namespace Icanhazstring\PhpstanReadonlyPropertyExtension\Test\data\WritingToReadonlyAttribute;

use Icanhazstring\PhpstanReadonlyPropertyExtension\Attribute\IsReadonly;

final class PromotedProperty
{
    public function __construct(
        #[IsReadonly] public string $name
    )
    {
    }
}

$test = new PromotedProperty('fu');
$test->name = 'bar';
