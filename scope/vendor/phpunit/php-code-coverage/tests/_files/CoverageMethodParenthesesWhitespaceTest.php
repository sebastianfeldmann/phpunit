<?php

namespace _PhpScoper5bf3cbdac76b4;

use PHPUnit\Framework\TestCase;
class CoverageMethodParenthesesWhitespaceTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers CoveredClass::publicMethod ( )
     */
    public function testSomething()
    {
        $o = new \_PhpScoper5bf3cbdac76b4\CoveredClass();
        $o->publicMethod();
    }
}
