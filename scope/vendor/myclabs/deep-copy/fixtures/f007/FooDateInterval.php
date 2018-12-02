<?php

namespace _PhpScoper5bf3cbdac76b4\DeepCopy\f007;

use DateInterval;
class FooDateInterval extends \DateInterval
{
    public $cloned = \false;
    public function __clone()
    {
        $this->cloned = \true;
    }
}
