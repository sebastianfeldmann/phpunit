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
 * @covers \SebastianBergmann\Comparator\ScalarComparator<extended>
 *
 * @uses \SebastianBergmann\Comparator\Comparator
 * @uses \SebastianBergmann\Comparator\Factory
 * @uses \SebastianBergmann\Comparator\ComparisonFailure
 */
final class ScalarComparatorTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var ScalarComparator
     */
    private $comparator;
    protected function setUp() : void
    {
        $this->comparator = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\ScalarComparator();
    }
    public function acceptsSucceedsProvider()
    {
        return [['string', 'string'], [new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\ClassWithToString(), 'string'], ['string', new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\ClassWithToString()], ['string', null], [\false, 'string'], [\false, \true], [null, \false], [null, null], ['10', 10], ['', \false], ['1', \true], [1, \true], [0, \false], [0.1, '0.1']];
    }
    public function acceptsFailsProvider()
    {
        return [[[], []], ['string', []], [new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\ClassWithToString(), new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\ClassWithToString()], [\false, new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\ClassWithToString()], [\tmpfile(), \tmpfile()]];
    }
    public function assertEqualsSucceedsProvider()
    {
        return [['string', 'string'], [new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\ClassWithToString(), new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\ClassWithToString()], ['string representation', new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\ClassWithToString()], [new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\ClassWithToString(), 'string representation'], ['string', 'STRING', \true], ['STRING', 'string', \true], ['String Representation', new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\ClassWithToString(), \true], [new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\ClassWithToString(), 'String Representation', \true], ['10', 10], ['', \false], ['1', \true], [1, \true], [0, \false], [0.1, '0.1'], [\false, null], [\false, \false], [\true, \true], [null, null]];
    }
    public function assertEqualsFailsProvider()
    {
        $stringException = 'Failed asserting that two strings are equal.';
        $otherException = 'matches expected';
        return [
            ['string', 'other string', $stringException],
            ['string', 'STRING', $stringException],
            ['STRING', 'string', $stringException],
            ['string', 'other string', $stringException],
            // https://github.com/sebastianbergmann/phpunit/issues/1023
            ['9E6666666', '9E7777777', $stringException],
            [new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\ClassWithToString(), 'does not match', $otherException],
            ['does not match', new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\ClassWithToString(), $otherException],
            [0, 'Foobar', $otherException],
            ['Foobar', 0, $otherException],
            ['10', 25, $otherException],
            ['1', \false, $otherException],
            ['', \true, $otherException],
            [\false, \true, $otherException],
            [\true, \false, $otherException],
            [null, \true, $otherException],
            [0, \true, $otherException],
            ['0', '0.0', $stringException],
            ['0.', '0.0', $stringException],
            ['0e1', '0e2', $stringException],
            ["\n\n\n0.0", '                   0.', $stringException],
            ['0.0', '25e-10000', $stringException],
        ];
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
    public function testAssertEqualsSucceeds($expected, $actual, $ignoreCase = \false) : void
    {
        $exception = null;
        try {
            $this->comparator->assertEquals($expected, $actual, 0.0, \false, $ignoreCase);
        } catch (\_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\ComparisonFailure $exception) {
        }
        $this->assertNull($exception, 'Unexpected ComparisonFailure');
    }
    /**
     * @dataProvider assertEqualsFailsProvider
     */
    public function testAssertEqualsFails($expected, $actual, $message) : void
    {
        $this->expectException(\_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\ComparisonFailure::class);
        $this->expectExceptionMessage($message);
        $this->comparator->assertEquals($expected, $actual);
    }
}
