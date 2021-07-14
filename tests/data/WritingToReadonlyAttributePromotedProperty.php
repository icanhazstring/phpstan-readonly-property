<?php

declare(strict_types=1);

namespace Icanhazstring\PhpstanReadonlyPropertyExtension\Test\data;

use Icanhazstring\PhpstanReadonlyPropertyExtension\Attribute\Readonly;

final class WritingToReadonlyAttributePromotedProperty
{
    public function __construct(
        #[Readonly] public string $name
    )
    {
    }
}

$test = new WritingToReadonlyAttributePromotedProperty('fu');
$test->name = 'bar';
