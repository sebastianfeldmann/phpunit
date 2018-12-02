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
 * @covers \SebastianBergmann\Comparator\ResourceComparator<extended>
 *
 * @uses \SebastianBergmann\Comparator\Comparator
 * @uses \SebastianBergmann\Comparator\Factory
 * @uses \SebastianBergmann\Comparator\ComparisonFailure
 */
final class ResourceComparatorTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var ResourceComparator
     */
    private $comparator;
    protected function setUp() : void
    {
        $this->comparator = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\ResourceComparator();
    }
    public function acceptsSucceedsProvider()
    {
        $tmpfile1 = \tmpfile();
        $tmpfile2 = \tmpfile();
        return [[$tmpfile1, $tmpfile1], [$tmpfile2, $tmpfile2], [$tmpfile1, $tmpfile2]];
    }
    public function acceptsFailsProvider()
    {
        $tmpfile1 = \tmpfile();
        return [[$tmpfile1, null], [null, $tmpfile1], [null, null]];
    }
    public function assertEqualsSucceedsProvider()
    {
        $tmpfile1 = \tmpfile();
        $tmpfile2 = \tmpfile();
        return [[$tmpfile1, $tmpfile1], [$tmpfile2, $tmpfile2]];
    }
    public function assertEqualsFailsProvider()
    {
        $tmpfile1 = \tmpfile();
        $tmpfile2 = \tmpfile();
        return [[$tmpfile1, $tmpfile2], [$tmpfile2, $tmpfile1]];
    }
    /**
     * @dataProvider acceptsSucceedsProvider
     */
    public function testAcceptsSucceeds($expected, $actual) : void
    {
        $this->assertTrue($this->comparator->accepts($expected, $actual));
    }
    /**
     * @dataProvider acceptsFailsProvider
     */
    public function testAcceptsFails($expected, $actual) : void
    {
        $this->assertFalse($this->comparator->accepts($expected, $actual));
    }
    /**
     * @dataProvider assertEqualsSucceedsProvider
     */
    public function testAssertEqualsSucceeds($expected, $actual) : void
    {
        $exception = null;
        try {
            $this->comparator->assertEquals($expected, $actual);
        } catch (\_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\ComparisonFailure $exception) {
        }
        $this->assertNull($exception, 'Unexpected ComparisonFailure');
    }
    /**
     * @dataProvider assertEqualsFailsProvider
     */
    public function testAssertEqualsFails($expected, $actual) : void
    {
        $this->expectException(\_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\ComparisonFailure::class);
        $this->comparator->assertEquals($expected, $actual);
    }
}
