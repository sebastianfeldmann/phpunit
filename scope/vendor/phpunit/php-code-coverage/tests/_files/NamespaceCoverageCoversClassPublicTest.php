<?php

namespace _PhpScoper5bf3cbdac76b4;

use PHPUnit\Framework\TestCase;
/**
 * @coversDefaultClass \Foo\CoveredClass
 */
class NamespaceCoverageCoversClassPublicTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers ::publicMethod
     */
    public function testSomething()
    {
        $o = new \_PhpScoper5bf3cbdac76b4\Foo\CoveredClass();
        $o->publicMethod();
    }
}
