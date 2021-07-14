<?php

declare(strict_types=1);

namespace Icanhazstring\PhpstanReadonlyPropertyExtension\Test\data;

use Icanhazstring\PhpstanReadonlyPropertyExtension\Attribute\Readonly;

final class WritingToReadonlyAttributeClassProperty
{
    #[Readonly]
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}

$test = new WritingToReadonlyAttributeClassProperty('fu');
$test->name = 'bar';
