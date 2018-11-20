<?php

/*
 * This file is part of sebastian/comparator.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator;

use PHPUnit\Framework\TestCase;
/**
 * @covers \SebastianBergmann\Comparator\ComparisonFailure
 *
 * @uses \SebastianBergmann\Comparator\Factory
 */
final class ComparisonFailureTest extends \PHPUnit\Framework\TestCase
{
    public function testComparisonFailure() : void
    {
        $actual = "\nB\n";
        $expected = "\nA\n";
        $message = 'Test message';
        $failure = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\ComparisonFailure($expected, $actual, '|' . $expected, '|' . $actual, \false, $message);
        $this->assertSame($actual, $failure->getActual());
        $this->assertSame($expected, $failure->getExpected());
        $this->assertSame('|' . $actual, $failure->getActualAsString());
        $this->assertSame('|' . $expected, $failure->getExpectedAsString());
        $diff = '
--- Expected
+++ Actual
@@ @@
 |
-A
+B
';
        $this->assertSame($diff, $failure->getDiff());
        $this->assertSame($message . $diff, $failure->toString());
    }
    public function testDiffNotPossible() : void
    {
        $failure = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\ComparisonFailure('a', 'b', \false, \false, \true, 'test');
        $this->assertSame('', $failure->getDiff());
        $this->assertSame('test', $failure->toString());
    }
}
