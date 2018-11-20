<?php

namespace _PhpScoper5bf3cbdac76b4\DeepCopy\f005;

class Foo
{
    public $cloned = \false;
    public function __clone()
    {
        $this->cloned = \true;
    }
}
