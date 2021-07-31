<?php

declare(strict_types=1);

namespace Icanhazstring\PhpstanReadonlyPropertyExtension\Test\data\WritingToReadonlyAttribute;

use stdClass;

final class GenericStdClassAccess
{
    public function __construct()
    {
        $c = new stdClass();
        $c->data = 'fubar';
    }
}
