<?php

declare(strict_types=1);

namespace Icanhazstring\PhpstanReadonlyPropertyExtension\Test\data\WritingToReadonlyAttribute;

use Icanhazstring\PhpstanReadonlyPropertyExtension\Attribute\IsReadonly;

final class ThroughSetter
{
    #[IsReadonly]
    public string $value;

    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    public function setAnotherValue(string $value): void
    {
        $this->value = $value;
    }
}
