<?php

declare(strict_types=1);

namespace Icanhazstring\PhpstanReadonlyPropertyExtension\Test\data\WritingToReadonlyAttribute;

use Icanhazstring\PhpstanReadonlyPropertyExtension\Attribute\IsReadonly;

final class ClassProperty
{
    #[IsReadonly]
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }
}

$test = new ClassProperty('fu');
$test->name = 'bar';
