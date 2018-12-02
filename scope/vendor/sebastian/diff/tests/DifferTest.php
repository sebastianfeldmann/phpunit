<?php

declare (strict_types=1);
/*
 * This file is part of sebastian/diff.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff;

use PHPUnit\Framework\TestCase;
use _PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Output\UnifiedDiffOutputBuilder;
/**
 * @covers SebastianBergmann\Diff\Differ
 * @covers SebastianBergmann\Diff\Output\UnifiedDiffOutputBuilder
 *
 * @uses SebastianBergmann\Diff\MemoryEfficientLongestCommonSubsequenceCalculator
 * @uses SebastianBergmann\Diff\TimeEfficientLongestCommonSubsequenceCalculator
 * @uses SebastianBergmann\Diff\Output\AbstractChunkOutputBuilder
 */
final class DifferTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Differ
     */
    private $differ;
    protected function setUp() : void
    {
        $this->differ = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ();
    }
    /**
     * @param array        $expected
     * @param array|string $from
     * @param array|string $to
     *
     * @dataProvider arrayProvider
     */
    public function testArrayRepresentationOfDiffCanBeRenderedUsingTimeEfficientLcsImplementation(array $expected, $from, $to) : void
    {
        $this->assertSame($expected, $this->differ->diffToArray($from, $to, new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\TimeEfficientLongestCommonSubsequenceCalculator()));
    }
    /**
     * @param string $expected
     * @param string $from
     * @param string $to
     *
     * @dataProvider textProvider
     */
    public function testTextRepresentationOfDiffCanBeRenderedUsingTimeEfficientLcsImplementation(string $expected, string $from, string $to) : void
    {
        $this->assertSame($expected, $this->differ->diff($from, $to, new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\TimeEfficientLongestCommonSubsequenceCalculator()));
    }
    /**
     * @param array        $expected
     * @param array|string $from
     * @param array|string $to
     *
     * @dataProvider arrayProvider
     */
    public function testArrayRepresentationOfDiffCanBeRenderedUsingMemoryEfficientLcsImplementation(array $expected, $from, $to) : void
    {
        $this->assertSame($expected, $this->differ->diffToArray($from, $to, new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\MemoryEfficientLongestCommonSubsequenceCalculator()));
    }
    /**
     * @param string $expected
     * @param string $from
     * @param string $to
     *
     * @dataProvider textProvider
     */
    public function testTextRepresentationOfDiffCanBeRenderedUsingMemoryEfficientLcsImplementation(string $expected, string $from, string $to) : void
    {
        $this->assertSame($expected, $this->differ->diff($from, $to, new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\MemoryEfficientLongestCommonSubsequenceCalculator()));
    }
    public function testTypesOtherThanArrayAndStringCanBePassed() : void
    {
        $this->assertSame("--- Original\n+++ New\n@@ @@\n-1\n+2\n", $this->differ->diff(1, 2));
    }
    public function testArrayDiffs() : void
    {
        $this->assertSame('--- Original
+++ New
@@ @@
-one
+two
', $this->differ->diff(['one'], ['two']));
    }
    public function arrayProvider() : array
    {
        return [[[['a', \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ::REMOVED], ['b', \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ::ADDED]], 'a', 'b'], [[['ba', \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ::REMOVED], ['bc', \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ::ADDED]], 'ba', 'bc'], [[['ab', \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ::REMOVED], ['cb', \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ::ADDED]], 'ab', 'cb'], [[['abc', \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ::REMOVED], ['adc', \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ::ADDED]], 'abc', 'adc'], [[['ab', \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ::REMOVED], ['abc', \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ::ADDED]], 'ab', 'abc'], [[['bc', \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ::REMOVED], ['abc', \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ::ADDED]], 'bc', 'abc'], [[['abc', \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ::REMOVED], ['abbc', \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ::ADDED]], 'abc', 'abbc'], [[['abcdde', \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ::REMOVED], ['abcde', \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ::ADDED]], 'abcdde', 'abcde'], 'same start' => [[[17, \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ::OLD], ['b', \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ::REMOVED], ['d', \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ::ADDED]], [30 => 17, 'a' => 'b'], [30 => 17, 'c' => 'd']], 'same end' => [[[1, \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ::REMOVED], [2, \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ::ADDED], ['b', \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ::OLD]], [1 => 1, 'a' => 'b'], [1 => 2, 'a' => 'b']], 'same start (2), same end (1)' => [[[17, \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ::OLD], [2, \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ::OLD], [4, \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ::REMOVED], ['a', \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ::ADDED], [5, \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ::ADDED], ['x', \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ::OLD]], [30 => 17, 1 => 2, 2 => 4, 'z' => 'x'], [30 => 17, 1 => 2, 3 => 'a', 2 => 5, 'z' => 'x']], 'same' => [[['x', \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ::OLD]], ['z' => 'x'], ['z' => 'x']], 'diff' => [[['y', \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ::REMOVED], ['x', \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ::ADDED]], ['x' => 'y'], ['z' => 'x']], 'diff 2' => [[['y', \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ::REMOVED], ['b', \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ::REMOVED], ['x', \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ::ADDED], ['d', \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ::ADDED]], ['x' => 'y', 'a' => 'b'], ['z' => 'x', 'c' => 'd']], 'test line diff detection' => [[["#Warning: Strings contain different line endings!\n", \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ::DIFF_LINE_END_WARNING], ["<?php\r\n", \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ::REMOVED], ["<?php\n", \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ::ADDED]], "<?php\r\n", "<?php\n"], 'test line diff detection in array input' => [[["#Warning: Strings contain different line endings!\n", \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ::DIFF_LINE_END_WARNING], ["<?php\r\n", \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ::REMOVED], ["<?php\n", \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ::ADDED]], ["<?php\r\n"], ["<?php\n"]]];
    }
    public function textProvider() : array
    {
        return [["--- Original\n+++ New\n@@ @@\n-a\n+b\n", 'a', 'b'], ["--- Original\n+++ New\n@@ @@\n-A\n+A1\n B\n", "A\nB", "A1\nB"], [<<<EOF
--- Original
+++ New
@@ @@
 a
-b
+p
 c
 d
 e
@@ @@
 g
 h
 i
-j
+w
 k

EOF
, "a\nb\nc\nd\ne\nf\ng\nh\ni\nj\nk\n", "a\np\nc\nd\ne\nf\ng\nh\ni\nw\nk\n"], [<<<EOF
--- Original
+++ New
@@ @@
-A
+B
 1
 2
 3

EOF
, "A\n1\n2\n3\n4\n5\n6\n1\n1\n1\n1\n1\n1\n1\n1\n1\n1\n1\n1\n1\n1\n1\n", "B\n1\n2\n3\n4\n5\n6\n1\n1\n1\n1\n1\n1\n1\n1\n1\n1\n1\n1\n1\n1\n1\n"], ["--- Original\n+++ New\n@@ @@\n #Warning: Strings contain different line endings!\n-<?php\r\n+<?php\n A\n", "<?php\r\nA\n", "<?php\nA\n"], ["--- Original\n+++ New\n@@ @@\n #Warning: Strings contain different line endings!\n-a\r\n+\n+c\r\n", "a\r\n", "\nc\r"]];
    }
    public function testDiffToArrayInvalidFromType() : void
    {
        $this->expectException(\_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\InvalidArgumentException::class);
        $this->expectExceptionMessageRegExp('#^"from" must be an array or string\\.$#');
        $this->differ->diffToArray(null, '');
    }
    public function testDiffInvalidToType() : void
    {
        $this->expectException(\_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\InvalidArgumentException::class);
        $this->expectExceptionMessageRegExp('#^"to" must be an array or string\\.$#');
        $this->differ->diffToArray('', new \stdClass());
    }
    /**
     * @param array  $expected
     * @param string $input
     *
     * @dataProvider provideSplitStringByLinesCases
     */
    public function testSplitStringByLines(array $expected, string $input) : void
    {
        $reflection = new \ReflectionObject($this->differ);
        $method = $reflection->getMethod('splitStringByLines');
        $method->setAccessible(\true);
        $this->assertSame($expected, $method->invoke($this->differ, $input));
    }
    public function provideSplitStringByLinesCases() : array
    {
        return [[[], ''], [['a'], 'a'], [["a\n"], "a\n"], [["a\r"], "a\r"], [["a\r\n"], "a\r\n"], [["\n"], "\n"], [["\r"], "\r"], [["\r\n"], "\r\n"], [["A\n", "B\n", "\n", "C\n"], "A\nB\n\nC\n"], [["A\r\n", "B\n", "\n", "C\r"], "A\r\nB\n\nC\r"], [["\n", "A\r\n", "B\n", "\n", 'C'], "\nA\r\nB\n\nC"]];
    }
    public function testConstructorNull() : void
    {
        $this->assertAttributeInstanceOf(\_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Output\UnifiedDiffOutputBuilder::class, 'outputBuilder', new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ(null));
    }
    public function testConstructorString() : void
    {
        $this->assertAttributeInstanceOf(\_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Output\UnifiedDiffOutputBuilder::class, 'outputBuilder', new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ("--- Original\n+++ New\n"));
    }
    public function testConstructorInvalidArgInt() : void
    {
        $this->expectException(\_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\InvalidArgumentException::class);
        $this->expectExceptionMessageRegExp('/^Expected builder to be an instance of DiffOutputBuilderInterface, <null> or a string, got integer "1"\\.$/');
        new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ(1);
    }
    public function testConstructorInvalidArgObject() : void
    {
        $this->expectException(\_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\InvalidArgumentException::class);
        $this->expectExceptionMessageRegExp('/^Expected builder to be an instance of DiffOutputBuilderInterface, <null> or a string, got instance of "SplFileInfo"\\.$/');
        new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Differ(new \SplFileInfo(__FILE__));
    }
}
