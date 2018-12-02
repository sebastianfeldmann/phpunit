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
use stdClass;
/**
 * @covers \SebastianBergmann\Comparator\ObjectComparator<extended>
 *
 * @uses \SebastianBergmann\Comparator\Comparator
 * @uses \SebastianBergmann\Comparator\Factory
 * @uses \SebastianBergmann\Comparator\ComparisonFailure
 */
final class ObjectComparatorTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var ObjectComparator
     */
    private $comparator;
    protected function setUp() : void
    {
        $this->comparator = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\ObjectComparator();
        $this->comparator->setFactory(new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\Factory());
    }
    public function acceptsSucceedsProvider()
    {
        return [[new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\TestClass(), new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\TestClass()], [new \stdClass(), new \stdClass()], [new \stdClass(), new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\TestClass()]];
    }
    public function acceptsFailsProvider()
    {
        return [[new \stdClass(), null], [null, new \stdClass()], [null, null]];
    }
    public function assertEqualsSucceedsProvider()
    {
        // cyclic dependencies
        $book1 = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\Book();
        $book1->author = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\Author('Terry Pratchett');
        $book1->author->books[] = $book1;
        $book2 = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\Book();
        $book2->author = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\Author('Terry Pratchett');
        $book2->author->books[] = $book2;
        $object1 = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\SampleClass(4, 8, 15);
        $object2 = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\SampleClass(4, 8, 15);
        return [[$object1, $object1], [$object1, $object2], [$book1, $book1], [$book1, $book2], [new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\Struct(2.3), new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\Struct(2.5), 0.5]];
    }
    public function assertEqualsFailsProvider()
    {
        $typeMessage = 'is not instance of expected class';
        $equalMessage = 'Failed asserting that two objects are equal.';
        // cyclic dependencies
        $book1 = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\Book();
        $book1->author = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\Author('Terry Pratchett');
        $book1->author->books[] = $book1;
        $book2 = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\Book();
        $book2->author = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\Author('Terry Pratch');
        $book2->author->books[] = $book2;
        $book3 = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\Book();
        $book3->author = 'Terry Pratchett';
        $book4 = new \stdClass();
        $book4->author = 'Terry Pratchett';
        $object1 = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\SampleClass(4, 8, 15);
        $object2 = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\SampleClass(16, 23, 42);
        return [[new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\SampleClass(4, 8, 15), new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\SampleClass(16, 23, 42), $equalMessage], [$object1, $object2, $equalMessage], [$book1, $book2, $equalMessage], [$book3, $book4, $typeMessage], [new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\Struct(2.3), new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\Struct(4.2), $equalMessage, 0.5]];
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
    public function testAssertEqualsSucceeds($expected, $actual, $delta = 0.0) : void
    {
        $exception = null;
        try {
            $this->comparator->assertEquals($expected, $actual, $delta);
        } catch (\_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\ComparisonFailure $exception) {
        }
        $this->assertNull($exception, 'Unexpected ComparisonFailure');
    }
    /**
     * @dataProvider assertEqualsFailsProvider
     */
    public function testAssertEqualsFails($expected, $actual, $message, $delta = 0.0) : void
    {
        $this->expectException(\_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\ComparisonFailure::class);
        $this->expectExceptionMessage($message);
        $this->comparator->assertEquals($expected, $actual, $delta);
    }
}
