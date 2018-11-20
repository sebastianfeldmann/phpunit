<?php

namespace _PhpScoper5bf3cbdac76b4;

/**
 * @coversDefaultClass \NamespaceOne
 * @coversDefaultClass \AnotherDefault\Name\Space\Does\Not\Work
 */
class CoverageTwoDefaultClassAnnotations
{
    /**
     * @covers Foo\CoveredClass::<public>
     */
    public function testSomething()
    {
        $o = new \_PhpScoper5bf3cbdac76b4\Foo\CoveredClass();
        $o->publicMethod();
    }
}
