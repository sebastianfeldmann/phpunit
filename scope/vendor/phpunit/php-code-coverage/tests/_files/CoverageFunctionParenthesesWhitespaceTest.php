<?php

namespace _PhpScoper5bf3cbdac76b4;

use PHPUnit\Framework\TestCase;
class CoverageFunctionParenthesesWhitespaceTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers ::globalFunction ( )
     */
    public function testSomething()
    {
        \_PhpScoper5bf3cbdac76b4\globalFunction();
    }
}
