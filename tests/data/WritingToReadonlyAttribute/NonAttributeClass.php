<?php

declare(strict_types=1);

namespace Icanhazstring\PhpstanReadonlyPropertyExtension\Test\data\WritingToReadonlyAttribute;

final class NonAttributeClass
{
    private string $abc;

    public function test(string $abc)
    {
        $this->abc = 'abc';
    }
}
