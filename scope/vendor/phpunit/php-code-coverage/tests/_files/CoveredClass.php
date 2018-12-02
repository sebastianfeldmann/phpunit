<?php

namespace _PhpScoper5bf3cbdac76b4;

class CoveredParentClass
{
    private function privateMethod()
    {
    }
    protected function protectedMethod()
    {
        $this->privateMethod();
    }
    public function publicMethod()
    {
        $this->protectedMethod();
    }
}
class CoveredClass extends \_PhpScoper5bf3cbdac76b4\CoveredParentClass
{
    private function privateMethod()
    {
    }
    protected function protectedMethod()
    {
        parent::protectedMethod();
        $this->privateMethod();
    }
    public function publicMethod()
    {
        parent::publicMethod();
        $this->protectedMethod();
    }
}
