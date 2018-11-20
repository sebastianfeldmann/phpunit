<?php

namespace _PhpScoper5bf3cbdac76b4;

use PHPUnit\Framework\TestCase;
class NamespaceCoverageMethodTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers Foo\CoveredClass::publicMethod
     */
    public function testSomething()
    {
        $o = new \_PhpScoper5bf3cbdac76b4\Foo\CoveredClass();
        $o->publicMethod();
    }
}
