<?php

declare(strict_types=1);

namespace Icanhazstring\PhpstanReadonlyPropertyExtension\Test\data\WritingToReadonlyAttribute;

use Icanhazstring\PhpstanReadonlyPropertyExtension\Attribute\Readonly;

final class ClassProperty
{
    #[Readonly]
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}

$test = new ClassProperty('fu');
$test->name = 'bar';
