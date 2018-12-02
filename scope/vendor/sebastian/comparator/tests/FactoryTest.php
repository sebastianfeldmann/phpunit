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
 * @covers \SebastianBergmann\Comparator\Factory
 *
 * @uses \SebastianBergmann\Comparator\Comparator
 * @uses \SebastianBergmann\Comparator\Factory
 * @uses \SebastianBergmann\Comparator\ComparisonFailure
 */
final class FactoryTest extends \PHPUnit\Framework\TestCase
{
    public function instanceProvider()
    {
        $tmpfile = \tmpfile();
        return [
            [null, null, '_PhpScoper5bf3cbdac76b4\\SebastianBergmann\\Comparator\\ScalarComparator'],
            [null, \true, '_PhpScoper5bf3cbdac76b4\\SebastianBergmann\\Comparator\\ScalarComparator'],
            [\true, null, '_PhpScoper5bf3cbdac76b4\\SebastianBergmann\\Comparator\\ScalarComparator'],
            [\true, \true, '_PhpScoper5bf3cbdac76b4\\SebastianBergmann\\Comparator\\ScalarComparator'],
            [\false, \false, '_PhpScoper5bf3cbdac76b4\\SebastianBergmann\\Comparator\\ScalarComparator'],
            [\true, \false, '_PhpScoper5bf3cbdac76b4\\SebastianBergmann\\Comparator\\ScalarComparator'],
            [\false, \true, '_PhpScoper5bf3cbdac76b4\\SebastianBergmann\\Comparator\\ScalarComparator'],
            ['', '', '_PhpScoper5bf3cbdac76b4\\SebastianBergmann\\Comparator\\ScalarComparator'],
            ['0', '0', '_PhpScoper5bf3cbdac76b4\\SebastianBergmann\\Comparator\\ScalarComparator'],
            ['0', 0, '_PhpScoper5bf3cbdac76b4\\SebastianBergmann\\Comparator\\NumericComparator'],
            [0, '0', '_PhpScoper5bf3cbdac76b4\\SebastianBergmann\\Comparator\\NumericComparator'],
            [0, 0, '_PhpScoper5bf3cbdac76b4\\SebastianBergmann\\Comparator\\NumericComparator'],
            [1.0, 0, '_PhpScoper5bf3cbdac76b4\\SebastianBergmann\\Comparator\\DoubleComparator'],
            [0, 1.0, '_PhpScoper5bf3cbdac76b4\\SebastianBergmann\\Comparator\\DoubleComparator'],
            [1.0, 1.0, '_PhpScoper5bf3cbdac76b4\\SebastianBergmann\\Comparator\\DoubleComparator'],
            [[1], [1], '_PhpScoper5bf3cbdac76b4\\SebastianBergmann\\Comparator\\ArrayComparator'],
            [$tmpfile, $tmpfile, '_PhpScoper5bf3cbdac76b4\\SebastianBergmann\\Comparator\\ResourceComparator'],
            [new \stdClass(), new \stdClass(), '_PhpScoper5bf3cbdac76b4\\SebastianBergmann\\Comparator\\ObjectComparator'],
            [new \DateTime(), new \DateTime(), '_PhpScoper5bf3cbdac76b4\\SebastianBergmann\\Comparator\\DateTimeComparator'],
            [new \SplObjectStorage(), new \SplObjectStorage(), '_PhpScoper5bf3cbdac76b4\\SebastianBergmann\\Comparator\\SplObjectStorageComparator'],
            [new \Exception(), new \Exception(), '_PhpScoper5bf3cbdac76b4\\SebastianBergmann\\Comparator\\ExceptionComparator'],
            [new \DOMDocument(), new \DOMDocument(), '_PhpScoper5bf3cbdac76b4\\SebastianBergmann\\Comparator\\DOMNodeComparator'],
            // mixed types
            [$tmpfile, [1], '_PhpScoper5bf3cbdac76b4\\SebastianBergmann\\Comparator\\TypeComparator'],
            [[1], $tmpfile, '_PhpScoper5bf3cbdac76b4\\SebastianBergmann\\Comparator\\TypeComparator'],
            [$tmpfile, '1', '_PhpScoper5bf3cbdac76b4\\SebastianBergmann\\Comparator\\TypeComparator'],
            ['1', $tmpfile, '_PhpScoper5bf3cbdac76b4\\SebastianBergmann\\Comparator\\TypeComparator'],
            [$tmpfile, new \stdClass(), '_PhpScoper5bf3cbdac76b4\\SebastianBergmann\\Comparator\\TypeComparator'],
            [new \stdClass(), $tmpfile, '_PhpScoper5bf3cbdac76b4\\SebastianBergmann\\Comparator\\TypeComparator'],
            [new \stdClass(), [1], '_PhpScoper5bf3cbdac76b4\\SebastianBergmann\\Comparator\\TypeComparator'],
            [[1], new \stdClass(), '_PhpScoper5bf3cbdac76b4\\SebastianBergmann\\Comparator\\TypeComparator'],
            [new \stdClass(), '1', '_PhpScoper5bf3cbdac76b4\\SebastianBergmann\\Comparator\\TypeComparator'],
            ['1', new \stdClass(), '_PhpScoper5bf3cbdac76b4\\SebastianBergmann\\Comparator\\TypeComparator'],
            [new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\ClassWithToString(), '1', '_PhpScoper5bf3cbdac76b4\\SebastianBergmann\\Comparator\\ScalarComparator'],
            ['1', new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\ClassWithToString(), '_PhpScoper5bf3cbdac76b4\\SebastianBergmann\\Comparator\\ScalarComparator'],
            [1.0, new \stdClass(), '_PhpScoper5bf3cbdac76b4\\SebastianBergmann\\Comparator\\TypeComparator'],
            [new \stdClass(), 1.0, '_PhpScoper5bf3cbdac76b4\\SebastianBergmann\\Comparator\\TypeComparator'],
            [1.0, [1], '_PhpScoper5bf3cbdac76b4\\SebastianBergmann\\Comparator\\TypeComparator'],
            [[1], 1.0, '_PhpScoper5bf3cbdac76b4\\SebastianBergmann\\Comparator\\TypeComparator'],
        ];
    }
    /**
     * @dataProvider instanceProvider
     */
    public function testGetComparatorFor($a, $b, $expected) : void
    {
        $factory = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\Factory();
        $actual = $factory->getComparatorFor($a, $b);
        $this->assertInstanceOf($expected, $actual);
    }
    public function testRegister() : void
    {
        $comparator = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\TestClassComparator();
        $factory = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\Factory();
        $factory->register($comparator);
        $a = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\TestClass();
        $b = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\TestClass();
        $expected = '_PhpScoper5bf3cbdac76b4\\SebastianBergmann\\Comparator\\TestClassComparator';
        $actual = $factory->getComparatorFor($a, $b);
        $factory->unregister($comparator);
        $this->assertInstanceOf($expected, $actual);
    }
    public function testUnregister() : void
    {
        $comparator = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\TestClassComparator();
        $factory = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\Factory();
        $factory->register($comparator);
        $factory->unregister($comparator);
        $a = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\TestClass();
        $b = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\TestClass();
        $expected = '_PhpScoper5bf3cbdac76b4\\SebastianBergmann\\Comparator\\ObjectComparator';
        $actual = $factory->getComparatorFor($a, $b);
        $this->assertInstanceOf($expected, $actual);
    }
    public function testIsSingleton() : void
    {
        $f = \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\Factory::getInstance();
        $this->assertSame($f, \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\Factory::getInstance());
    }
}
