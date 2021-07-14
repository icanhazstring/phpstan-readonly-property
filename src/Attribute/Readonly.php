<?php

declare(strict_types=1);

namespace Icanhazstring\PhpstanReadonlyPropertyExtension\Attribute;

use Attribute;

#[Attribute(Attribute::TARGET_PROPERTY)]
final class Readonly
{
}
