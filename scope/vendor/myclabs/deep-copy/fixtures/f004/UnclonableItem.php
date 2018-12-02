<?php

namespace _PhpScoper5bf3cbdac76b4\DeepCopy\f004;

use BadMethodCallException;
class UnclonableItem
{
    private function __clone()
    {
        throw new \BadMethodCallException('Unsupported call.');
    }
}
