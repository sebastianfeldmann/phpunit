<?php

namespace _PhpScoper5bf3cbdac76b4\DeepCopy\f001;

class B extends \_PhpScoper5bf3cbdac76b4\DeepCopy\f001\A
{
    private $bProp;
    public function getBProp()
    {
        return $this->bProp;
    }
    public function setBProp($prop)
    {
        $this->bProp = $prop;
        return $this;
    }
}
