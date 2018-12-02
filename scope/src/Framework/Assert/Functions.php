<?php

namespace _PhpScoper5bf3cbdac76b4;

/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\Constraint\ArrayHasKey;
use PHPUnit\Framework\Constraint\Attribute;
use PHPUnit\Framework\Constraint\Callback;
use PHPUnit\Framework\Constraint\ClassHasAttribute;
use PHPUnit\Framework\Constraint\ClassHasStaticAttribute;
use PHPUnit\Framework\Constraint\Constraint;
use PHPUnit\Framework\Constraint\Count;
use PHPUnit\Framework\Constraint\DirectoryExists;
use PHPUnit\Framework\Constraint\FileExists;
use PHPUnit\Framework\Constraint\GreaterThan;
use PHPUnit\Framework\Constraint\IsAnything;
use PHPUnit\Framework\Constraint\IsEmpty;
use PHPUnit\Framework\Constraint\IsEqual;
use PHPUnit\Framework\Constraint\IsFalse;
use PHPUnit\Framework\Constraint\IsFinite;
use PHPUnit\Framework\Constraint\IsIdentical;
use PHPUnit\Framework\Constraint\IsInfinite;
use PHPUnit\Framework\Constraint\IsInstanceOf;
use PHPUnit\Framework\Constraint\IsJson;
use PHPUnit\Framework\Constraint\IsNan;
use PHPUnit\Framework\Constraint\IsNull;
use PHPUnit\Framework\Constraint\IsReadable;
use PHPUnit\Framework\Constraint\IsTrue;
use PHPUnit\Framework\Constraint\IsType;
use PHPUnit\Framework\Constraint\IsWritable;
use PHPUnit\Framework\Constraint\LessThan;
use PHPUnit\Framework\Constraint\LogicalAnd;
use PHPUnit\Framework\Constraint\LogicalNot;
use PHPUnit\Framework\Constraint\LogicalOr;
use PHPUnit\Framework\Constraint\LogicalXor;
use PHPUnit\Framework\Constraint\ObjectHasAttribute;
use PHPUnit\Framework\Constraint\RegularExpression;
use PHPUnit\Framework\Constraint\StringContains;
use PHPUnit\Framework\Constraint\StringEndsWith;
use PHPUnit\Framework\Constraint\StringMatchesFormatDescription;
use PHPUnit\Framework\Constraint\StringStartsWith;
use PHPUnit\Framework\Constraint\TraversableContains;
use PHPUnit\Framework\Constraint\TraversableContainsOnly;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\MockObject\Matcher\AnyInvokedCount as AnyInvokedCountMatcher;
use PHPUnit\Framework\MockObject\Matcher\InvokedAtIndex as InvokedAtIndexMatcher;
use PHPUnit\Framework\MockObject\Matcher\InvokedAtLeastCount as InvokedAtLeastCountMatcher;
use PHPUnit\Framework\MockObject\Matcher\InvokedAtLeastOnce as InvokedAtLeastOnceMatcher;
use PHPUnit\Framework\MockObject\Matcher\InvokedAtMostCount as InvokedAtMostCountMatcher;
use PHPUnit\Framework\MockObject\Matcher\InvokedCount as InvokedCountMatcher;
use PHPUnit\Framework\MockObject\Stub\ConsecutiveCalls as ConsecutiveCallsStub;
use PHPUnit\Framework\MockObject\Stub\Exception as ExceptionStub;
use PHPUnit\Framework\MockObject\Stub\ReturnArgument as ReturnArgumentStub;
use PHPUnit\Framework\MockObject\Stub\ReturnCallback as ReturnCallbackStub;
use PHPUnit\Framework\MockObject\Stub\ReturnSelf as ReturnSelfStub;
use PHPUnit\Framework\MockObject\Stub\ReturnStub;
use PHPUnit\Framework\MockObject\Stub\ReturnValueMap as ReturnValueMapStub;
/**
 * Asserts that an array has a specified key.
 *
 * @param int|string        $key
 * @param array|ArrayAccess $array
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertArrayHasKey($key, $array, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertArrayHasKey(...\func_get_args());
}
/**
 * Asserts that an array has a specified subset.
 *
 * @param array|ArrayAccess $subset
 * @param array|ArrayAccess $array
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertArraySubset($subset, $array, bool $checkForObjectIdentity = \false, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertArraySubset(...\func_get_args());
}
/**
 * Asserts that an array does not have a specified key.
 *
 * @param int|string        $key
 * @param array|ArrayAccess $array
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertArrayNotHasKey($key, $array, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertArrayNotHasKey(...\func_get_args());
}
/**
 * Asserts that a haystack contains a needle.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertContains($needle, $haystack, string $message = '', bool $ignoreCase = \false, bool $checkForObjectIdentity = \true, bool $checkForNonObjectIdentity = \false) : void
{
    \PHPUnit\Framework\Assert::assertContains(...\func_get_args());
}
/**
 * Asserts that a haystack that is stored in a static attribute of a class
 * or an attribute of an object contains a needle.
 *
 * @param object|string $haystackClassOrObject
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertAttributeContains($needle, string $haystackAttributeName, $haystackClassOrObject, string $message = '', bool $ignoreCase = \false, bool $checkForObjectIdentity = \true, bool $checkForNonObjectIdentity = \false) : void
{
    \PHPUnit\Framework\Assert::assertAttributeContains(...\func_get_args());
}
/**
 * Asserts that a haystack does not contain a needle.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertNotContains($needle, $haystack, string $message = '', bool $ignoreCase = \false, bool $checkForObjectIdentity = \true, bool $checkForNonObjectIdentity = \false) : void
{
    \PHPUnit\Framework\Assert::assertNotContains(...\func_get_args());
}
/**
 * Asserts that a haystack that is stored in a static attribute of a class
 * or an attribute of an object does not contain a needle.
 *
 * @param object|string $haystackClassOrObject
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertAttributeNotContains($needle, string $haystackAttributeName, $haystackClassOrObject, string $message = '', bool $ignoreCase = \false, bool $checkForObjectIdentity = \true, bool $checkForNonObjectIdentity = \false) : void
{
    \PHPUnit\Framework\Assert::assertAttributeNotContains(...\func_get_args());
}
/**
 * Asserts that a haystack contains only values of a given type.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertContainsOnly(string $type, iterable $haystack, ?bool $isNativeType = null, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertContainsOnly(...\func_get_args());
}
/**
 * Asserts that a haystack contains only instances of a given class name.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertContainsOnlyInstancesOf(string $className, iterable $haystack, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertContainsOnlyInstancesOf(...\func_get_args());
}
/**
 * Asserts that a haystack that is stored in a static attribute of a class
 * or an attribute of an object contains only values of a given type.
 *
 * @param object|string $haystackClassOrObject
 * @param bool          $isNativeType
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertAttributeContainsOnly(string $type, string $haystackAttributeName, $haystackClassOrObject, ?bool $isNativeType = null, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertAttributeContainsOnly(...\func_get_args());
}
/**
 * Asserts that a haystack does not contain only values of a given type.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertNotContainsOnly(string $type, iterable $haystack, ?bool $isNativeType = null, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertNotContainsOnly(...\func_get_args());
}
/**
 * Asserts that a haystack that is stored in a static attribute of a class
 * or an attribute of an object does not contain only values of a given
 * type.
 *
 * @param object|string $haystackClassOrObject
 * @param bool          $isNativeType
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertAttributeNotContainsOnly(string $type, string $haystackAttributeName, $haystackClassOrObject, ?bool $isNativeType = null, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertAttributeNotContainsOnly(...\func_get_args());
}
/**
 * Asserts the number of elements of an array, Countable or Traversable.
 *
 * @param Countable|iterable $haystack
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertCount(int $expectedCount, $haystack, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertCount(...\func_get_args());
}
/**
 * Asserts the number of elements of an array, Countable or Traversable
 * that is stored in an attribute.
 *
 * @param object|string $haystackClassOrObject
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertAttributeCount(int $expectedCount, string $haystackAttributeName, $haystackClassOrObject, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertAttributeCount(...\func_get_args());
}
/**
 * Asserts the number of elements of an array, Countable or Traversable.
 *
 * @param Countable|iterable $haystack
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertNotCount(int $expectedCount, $haystack, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertNotCount(...\func_get_args());
}
/**
 * Asserts the number of elements of an array, Countable or Traversable
 * that is stored in an attribute.
 *
 * @param object|string $haystackClassOrObject
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertAttributeNotCount(int $expectedCount, string $haystackAttributeName, $haystackClassOrObject, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertAttributeNotCount(...\func_get_args());
}
/**
 * Asserts that two variables are equal.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertEquals($expected, $actual, string $message = '', float $delta = 0.0, int $maxDepth = 10, bool $canonicalize = \false, bool $ignoreCase = \false) : void
{
    \PHPUnit\Framework\Assert::assertEquals(...\func_get_args());
}
/**
 * Asserts that a variable is equal to an attribute of an object.
 *
 * @param object|string $actualClassOrObject
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertAttributeEquals($expected, string $actualAttributeName, $actualClassOrObject, string $message = '', float $delta = 0.0, int $maxDepth = 10, bool $canonicalize = \false, bool $ignoreCase = \false) : void
{
    \PHPUnit\Framework\Assert::assertAttributeEquals(...\func_get_args());
}
/**
 * Asserts that two variables are not equal.
 *
 * @param float $delta
 * @param int   $maxDepth
 * @param bool  $canonicalize
 * @param bool  $ignoreCase
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertNotEquals($expected, $actual, string $message = '', $delta = 0.0, $maxDepth = 10, $canonicalize = \false, $ignoreCase = \false) : void
{
    \PHPUnit\Framework\Assert::assertNotEquals(...\func_get_args());
}
/**
 * Asserts that a variable is not equal to an attribute of an object.
 *
 * @param object|string $actualClassOrObject
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertAttributeNotEquals($expected, string $actualAttributeName, $actualClassOrObject, string $message = '', float $delta = 0.0, int $maxDepth = 10, bool $canonicalize = \false, bool $ignoreCase = \false) : void
{
    \PHPUnit\Framework\Assert::assertAttributeNotEquals(...\func_get_args());
}
/**
 * Asserts that a variable is empty.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertEmpty($actual, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertEmpty(...\func_get_args());
}
/**
 * Asserts that a static attribute of a class or an attribute of an object
 * is empty.
 *
 * @param object|string $haystackClassOrObject
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertAttributeEmpty(string $haystackAttributeName, $haystackClassOrObject, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertAttributeEmpty(...\func_get_args());
}
/**
 * Asserts that a variable is not empty.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertNotEmpty($actual, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertNotEmpty(...\func_get_args());
}
/**
 * Asserts that a static attribute of a class or an attribute of an object
 * is not empty.
 *
 * @param object|string $haystackClassOrObject
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertAttributeNotEmpty(string $haystackAttributeName, $haystackClassOrObject, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertAttributeNotEmpty(...\func_get_args());
}
/**
 * Asserts that a value is greater than another value.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertGreaterThan($expected, $actual, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertGreaterThan(...\func_get_args());
}
/**
 * Asserts that an attribute is greater than another value.
 *
 * @param object|string $actualClassOrObject
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertAttributeGreaterThan($expected, string $actualAttributeName, $actualClassOrObject, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertAttributeGreaterThan(...\func_get_args());
}
/**
 * Asserts that a value is greater than or equal to another value.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertGreaterThanOrEqual($expected, $actual, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertGreaterThanOrEqual(...\func_get_args());
}
/**
 * Asserts that an attribute is greater than or equal to another value.
 *
 * @param object|string $actualClassOrObject
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertAttributeGreaterThanOrEqual($expected, string $actualAttributeName, $actualClassOrObject, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertAttributeGreaterThanOrEqual(...\func_get_args());
}
/**
 * Asserts that a value is smaller than another value.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertLessThan($expected, $actual, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertLessThan(...\func_get_args());
}
/**
 * Asserts that an attribute is smaller than another value.
 *
 * @param object|string $actualClassOrObject
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertAttributeLessThan($expected, string $actualAttributeName, $actualClassOrObject, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertAttributeLessThan(...\func_get_args());
}
/**
 * Asserts that a value is smaller than or equal to another value.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertLessThanOrEqual($expected, $actual, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertLessThanOrEqual(...\func_get_args());
}
/**
 * Asserts that an attribute is smaller than or equal to another value.
 *
 * @param object|string $actualClassOrObject
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertAttributeLessThanOrEqual($expected, string $actualAttributeName, $actualClassOrObject, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertAttributeLessThanOrEqual(...\func_get_args());
}
/**
 * Asserts that the contents of one file is equal to the contents of another
 * file.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertFileEquals(string $expected, string $actual, string $message = '', bool $canonicalize = \false, bool $ignoreCase = \false) : void
{
    \PHPUnit\Framework\Assert::assertFileEquals(...\func_get_args());
}
/**
 * Asserts that the contents of one file is not equal to the contents of
 * another file.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertFileNotEquals(string $expected, string $actual, string $message = '', bool $canonicalize = \false, bool $ignoreCase = \false) : void
{
    \PHPUnit\Framework\Assert::assertFileNotEquals(...\func_get_args());
}
/**
 * Asserts that the contents of a string is equal
 * to the contents of a file.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertStringEqualsFile(string $expectedFile, string $actualString, string $message = '', bool $canonicalize = \false, bool $ignoreCase = \false) : void
{
    \PHPUnit\Framework\Assert::assertStringEqualsFile(...\func_get_args());
}
/**
 * Asserts that the contents of a string is not equal
 * to the contents of a file.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertStringNotEqualsFile(string $expectedFile, string $actualString, string $message = '', bool $canonicalize = \false, bool $ignoreCase = \false) : void
{
    \PHPUnit\Framework\Assert::assertStringNotEqualsFile(...\func_get_args());
}
/**
 * Asserts that a file/dir is readable.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertIsReadable(string $filename, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertIsReadable(...\func_get_args());
}
/**
 * Asserts that a file/dir exists and is not readable.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertNotIsReadable(string $filename, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertNotIsReadable(...\func_get_args());
}
/**
 * Asserts that a file/dir exists and is writable.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertIsWritable(string $filename, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertIsWritable(...\func_get_args());
}
/**
 * Asserts that a file/dir exists and is not writable.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertNotIsWritable(string $filename, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertNotIsWritable(...\func_get_args());
}
/**
 * Asserts that a directory exists.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertDirectoryExists(string $directory, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertDirectoryExists(...\func_get_args());
}
/**
 * Asserts that a directory does not exist.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertDirectoryNotExists(string $directory, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertDirectoryNotExists(...\func_get_args());
}
/**
 * Asserts that a directory exists and is readable.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertDirectoryIsReadable(string $directory, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertDirectoryIsReadable(...\func_get_args());
}
/**
 * Asserts that a directory exists and is not readable.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertDirectoryNotIsReadable(string $directory, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertDirectoryNotIsReadable(...\func_get_args());
}
/**
 * Asserts that a directory exists and is writable.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertDirectoryIsWritable(string $directory, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertDirectoryIsWritable(...\func_get_args());
}
/**
 * Asserts that a directory exists and is not writable.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertDirectoryNotIsWritable(string $directory, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertDirectoryNotIsWritable(...\func_get_args());
}
/**
 * Asserts that a file exists.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertFileExists(string $filename, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertFileExists(...\func_get_args());
}
/**
 * Asserts that a file does not exist.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertFileNotExists(string $filename, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertFileNotExists(...\func_get_args());
}
/**
 * Asserts that a file exists and is readable.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertFileIsReadable(string $file, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertFileIsReadable(...\func_get_args());
}
/**
 * Asserts that a file exists and is not readable.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertFileNotIsReadable(string $file, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertFileNotIsReadable(...\func_get_args());
}
/**
 * Asserts that a file exists and is writable.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertFileIsWritable(string $file, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertFileIsWritable(...\func_get_args());
}
/**
 * Asserts that a file exists and is not writable.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertFileNotIsWritable(string $file, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertFileNotIsWritable(...\func_get_args());
}
/**
 * Asserts that a condition is true.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertTrue($condition, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertTrue(...\func_get_args());
}
/**
 * Asserts that a condition is not true.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertNotTrue($condition, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertNotTrue(...\func_get_args());
}
/**
 * Asserts that a condition is false.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertFalse($condition, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertFalse(...\func_get_args());
}
/**
 * Asserts that a condition is not false.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertNotFalse($condition, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertNotFalse(...\func_get_args());
}
/**
 * Asserts that a variable is null.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertNull($actual, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertNull(...\func_get_args());
}
/**
 * Asserts that a variable is not null.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertNotNull($actual, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertNotNull(...\func_get_args());
}
/**
 * Asserts that a variable is finite.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertFinite($actual, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertFinite(...\func_get_args());
}
/**
 * Asserts that a variable is infinite.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertInfinite($actual, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertInfinite(...\func_get_args());
}
/**
 * Asserts that a variable is nan.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertNan($actual, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertNan(...\func_get_args());
}
/**
 * Asserts that a class has a specified attribute.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertClassHasAttribute(string $attributeName, string $className, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertClassHasAttribute(...\func_get_args());
}
/**
 * Asserts that a class does not have a specified attribute.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertClassNotHasAttribute(string $attributeName, string $className, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertClassNotHasAttribute(...\func_get_args());
}
/**
 * Asserts that a class has a specified static attribute.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertClassHasStaticAttribute(string $attributeName, string $className, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertClassHasStaticAttribute(...\func_get_args());
}
/**
 * Asserts that a class does not have a specified static attribute.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertClassNotHasStaticAttribute(string $attributeName, string $className, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertClassNotHasStaticAttribute(...\func_get_args());
}
/**
 * Asserts that an object has a specified attribute.
 *
 * @param object $object
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertObjectHasAttribute(string $attributeName, $object, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertObjectHasAttribute(...\func_get_args());
}
/**
 * Asserts that an object does not have a specified attribute.
 *
 * @param object $object
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertObjectNotHasAttribute(string $attributeName, $object, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertObjectNotHasAttribute(...\func_get_args());
}
/**
 * Asserts that two variables have the same type and value.
 * Used on objects, it asserts that two variables reference
 * the same object.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertSame($expected, $actual, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertSame(...\func_get_args());
}
/**
 * Asserts that a variable and an attribute of an object have the same type
 * and value.
 *
 * @param object|string $actualClassOrObject
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertAttributeSame($expected, string $actualAttributeName, $actualClassOrObject, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertAttributeSame(...\func_get_args());
}
/**
 * Asserts that two variables do not have the same type and value.
 * Used on objects, it asserts that two variables do not reference
 * the same object.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertNotSame($expected, $actual, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertNotSame(...\func_get_args());
}
/**
 * Asserts that a variable and an attribute of an object do not have the
 * same type and value.
 *
 * @param object|string $actualClassOrObject
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertAttributeNotSame($expected, string $actualAttributeName, $actualClassOrObject, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertAttributeNotSame(...\func_get_args());
}
/**
 * Asserts that a variable is of a given type.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertInstanceOf(string $expected, $actual, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertInstanceOf(...\func_get_args());
}
/**
 * Asserts that an attribute is of a given type.
 *
 * @param object|string $classOrObject
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertAttributeInstanceOf(string $expected, string $attributeName, $classOrObject, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertAttributeInstanceOf(...\func_get_args());
}
/**
 * Asserts that a variable is not of a given type.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertNotInstanceOf(string $expected, $actual, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertNotInstanceOf(...\func_get_args());
}
/**
 * Asserts that an attribute is of a given type.
 *
 * @param object|string $classOrObject
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertAttributeNotInstanceOf(string $expected, string $attributeName, $classOrObject, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertAttributeNotInstanceOf(...\func_get_args());
}
/**
 * Asserts that a variable is of a given type.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertInternalType(string $expected, $actual, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertInternalType(...\func_get_args());
}
/**
 * Asserts that an attribute is of a given type.
 *
 * @param object|string $classOrObject
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertAttributeInternalType(string $expected, string $attributeName, $classOrObject, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertAttributeInternalType(...\func_get_args());
}
/**
 * Asserts that a variable is not of a given type.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertNotInternalType(string $expected, $actual, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertNotInternalType(...\func_get_args());
}
/**
 * Asserts that an attribute is of a given type.
 *
 * @param object|string $classOrObject
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertAttributeNotInternalType(string $expected, string $attributeName, $classOrObject, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertAttributeNotInternalType(...\func_get_args());
}
/**
 * Asserts that a string matches a given regular expression.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertRegExp(string $pattern, string $string, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertRegExp(...\func_get_args());
}
/**
 * Asserts that a string does not match a given regular expression.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertNotRegExp(string $pattern, string $string, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertNotRegExp(...\func_get_args());
}
/**
 * Assert that the size of two arrays (or `Countable` or `Traversable` objects)
 * is the same.
 *
 * @param Countable|iterable $expected
 * @param Countable|iterable $actual
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertSameSize($expected, $actual, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertSameSize(...\func_get_args());
}
/**
 * Assert that the size of two arrays (or `Countable` or `Traversable` objects)
 * is not the same.
 *
 * @param Countable|iterable $expected
 * @param Countable|iterable $actual
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertNotSameSize($expected, $actual, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertNotSameSize(...\func_get_args());
}
/**
 * Asserts that a string matches a given format string.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertStringMatchesFormat(string $format, string $string, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertStringMatchesFormat(...\func_get_args());
}
/**
 * Asserts that a string does not match a given format string.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertStringNotMatchesFormat(string $format, string $string, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertStringNotMatchesFormat(...\func_get_args());
}
/**
 * Asserts that a string matches a given format file.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertStringMatchesFormatFile(string $formatFile, string $string, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertStringMatchesFormatFile(...\func_get_args());
}
/**
 * Asserts that a string does not match a given format string.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertStringNotMatchesFormatFile(string $formatFile, string $string, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertStringNotMatchesFormatFile(...\func_get_args());
}
/**
 * Asserts that a string starts with a given prefix.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertStringStartsWith(string $prefix, string $string, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertStringStartsWith(...\func_get_args());
}
/**
 * Asserts that a string starts not with a given prefix.
 *
 * @param string $prefix
 * @param string $string
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertStringStartsNotWith($prefix, $string, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertStringStartsNotWith(...\func_get_args());
}
/**
 * Asserts that a string ends with a given suffix.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertStringEndsWith(string $suffix, string $string, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertStringEndsWith(...\func_get_args());
}
/**
 * Asserts that a string ends not with a given suffix.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertStringEndsNotWith(string $suffix, string $string, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertStringEndsNotWith(...\func_get_args());
}
/**
 * Asserts that two XML files are equal.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertXmlFileEqualsXmlFile(string $expectedFile, string $actualFile, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertXmlFileEqualsXmlFile(...\func_get_args());
}
/**
 * Asserts that two XML files are not equal.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertXmlFileNotEqualsXmlFile(string $expectedFile, string $actualFile, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertXmlFileNotEqualsXmlFile(...\func_get_args());
}
/**
 * Asserts that two XML documents are equal.
 *
 * @param DOMDocument|string $actualXml
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertXmlStringEqualsXmlFile(string $expectedFile, $actualXml, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertXmlStringEqualsXmlFile(...\func_get_args());
}
/**
 * Asserts that two XML documents are not equal.
 *
 * @param DOMDocument|string $actualXml
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertXmlStringNotEqualsXmlFile(string $expectedFile, $actualXml, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertXmlStringNotEqualsXmlFile(...\func_get_args());
}
/**
 * Asserts that two XML documents are equal.
 *
 * @param DOMDocument|string $expectedXml
 * @param DOMDocument|string $actualXml
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertXmlStringEqualsXmlString($expectedXml, $actualXml, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertXmlStringEqualsXmlString(...\func_get_args());
}
/**
 * Asserts that two XML documents are not equal.
 *
 * @param DOMDocument|string $expectedXml
 * @param DOMDocument|string $actualXml
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertXmlStringNotEqualsXmlString($expectedXml, $actualXml, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertXmlStringNotEqualsXmlString(...\func_get_args());
}
/**
 * Asserts that a hierarchy of DOMElements matches.
 *
 * @throws AssertionFailedError
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertEqualXMLStructure(\DOMElement $expectedElement, \DOMElement $actualElement, bool $checkAttributes = \false, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertEqualXMLStructure(...\func_get_args());
}
/**
 * Evaluates a PHPUnit\Framework\Constraint matcher object.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertThat($value, \PHPUnit\Framework\Constraint\Constraint $constraint, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertThat(...\func_get_args());
}
/**
 * Asserts that a string is a valid JSON string.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertJson(string $actualJson, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertJson(...\func_get_args());
}
/**
 * Asserts that two given JSON encoded objects or arrays are equal.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertJsonStringEqualsJsonString(string $expectedJson, string $actualJson, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertJsonStringEqualsJsonString(...\func_get_args());
}
/**
 * Asserts that two given JSON encoded objects or arrays are not equal.
 *
 * @param string $expectedJson
 * @param string $actualJson
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertJsonStringNotEqualsJsonString($expectedJson, $actualJson, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertJsonStringNotEqualsJsonString(...\func_get_args());
}
/**
 * Asserts that the generated JSON encoded object and the content of the given file are equal.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertJsonStringEqualsJsonFile(string $expectedFile, string $actualJson, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertJsonStringEqualsJsonFile(...\func_get_args());
}
/**
 * Asserts that the generated JSON encoded object and the content of the given file are not equal.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertJsonStringNotEqualsJsonFile(string $expectedFile, string $actualJson, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertJsonStringNotEqualsJsonFile(...\func_get_args());
}
/**
 * Asserts that two JSON files are equal.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertJsonFileEqualsJsonFile(string $expectedFile, string $actualFile, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertJsonFileEqualsJsonFile(...\func_get_args());
}
/**
 * Asserts that two JSON files are not equal.
 *
 * @throws ExpectationFailedException
 * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
 */
function assertJsonFileNotEqualsJsonFile(string $expectedFile, string $actualFile, string $message = '') : void
{
    \PHPUnit\Framework\Assert::assertJsonFileNotEqualsJsonFile(...\func_get_args());
}
function logicalAnd() : \PHPUnit\Framework\Constraint\LogicalAnd
{
    return \PHPUnit\Framework\Assert::logicalAnd(...\func_get_args());
}
function logicalOr() : \PHPUnit\Framework\Constraint\LogicalOr
{
    return \PHPUnit\Framework\Assert::logicalOr(...\func_get_args());
}
function logicalNot(\PHPUnit\Framework\Constraint\Constraint $constraint) : \PHPUnit\Framework\Constraint\LogicalNot
{
    return \PHPUnit\Framework\Assert::logicalNot(...\func_get_args());
}
function logicalXor() : \PHPUnit\Framework\Constraint\LogicalXor
{
    return \PHPUnit\Framework\Assert::logicalXor(...\func_get_args());
}
function anything() : \PHPUnit\Framework\Constraint\IsAnything
{
    return \PHPUnit\Framework\Assert::anything();
}
function isTrue() : \PHPUnit\Framework\Constraint\IsTrue
{
    return \PHPUnit\Framework\Assert::isTrue();
}
function callback(callable $callback) : \PHPUnit\Framework\Constraint\Callback
{
    return \PHPUnit\Framework\Assert::callback(...\func_get_args());
}
function isFalse() : \PHPUnit\Framework\Constraint\IsFalse
{
    return \PHPUnit\Framework\Assert::isFalse();
}
function isJson() : \PHPUnit\Framework\Constraint\IsJson
{
    return \PHPUnit\Framework\Assert::isJson();
}
function isNull() : \PHPUnit\Framework\Constraint\IsNull
{
    return \PHPUnit\Framework\Assert::isNull();
}
function isFinite() : \PHPUnit\Framework\Constraint\IsFinite
{
    return \PHPUnit\Framework\Assert::isFinite();
}
function isInfinite() : \PHPUnit\Framework\Constraint\IsInfinite
{
    return \PHPUnit\Framework\Assert::isInfinite();
}
function isNan() : \PHPUnit\Framework\Constraint\IsNan
{
    return \PHPUnit\Framework\Assert::isNan();
}
function attribute(\PHPUnit\Framework\Constraint\Constraint $constraint, string $attributeName) : \PHPUnit\Framework\Constraint\Attribute
{
    return \PHPUnit\Framework\Assert::attribute(...\func_get_args());
}
function contains($value, bool $checkForObjectIdentity = \true, bool $checkForNonObjectIdentity = \false) : \PHPUnit\Framework\Constraint\TraversableContains
{
    return \PHPUnit\Framework\Assert::contains(...\func_get_args());
}
function containsOnly(string $type) : \PHPUnit\Framework\Constraint\TraversableContainsOnly
{
    return \PHPUnit\Framework\Assert::containsOnly(...\func_get_args());
}
function containsOnlyInstancesOf(string $className) : \PHPUnit\Framework\Constraint\TraversableContainsOnly
{
    return \PHPUnit\Framework\Assert::containsOnlyInstancesOf(...\func_get_args());
}
function arrayHasKey($key) : \PHPUnit\Framework\Constraint\ArrayHasKey
{
    return \PHPUnit\Framework\Assert::arrayHasKey(...\func_get_args());
}
function equalTo($value, float $delta = 0.0, int $maxDepth = 10, bool $canonicalize = \false, bool $ignoreCase = \false) : \PHPUnit\Framework\Constraint\IsEqual
{
    return \PHPUnit\Framework\Assert::equalTo(...\func_get_args());
}
function attributeEqualTo(string $attributeName, $value, float $delta = 0.0, int $maxDepth = 10, bool $canonicalize = \false, bool $ignoreCase = \false) : \PHPUnit\Framework\Constraint\Attribute
{
    return \PHPUnit\Framework\Assert::attributeEqualTo(...\func_get_args());
}
function isEmpty() : \PHPUnit\Framework\Constraint\IsEmpty
{
    return \PHPUnit\Framework\Assert::isEmpty();
}
function isWritable() : \PHPUnit\Framework\Constraint\IsWritable
{
    return \PHPUnit\Framework\Assert::isWritable();
}
function isReadable() : \PHPUnit\Framework\Constraint\IsReadable
{
    return \PHPUnit\Framework\Assert::isReadable();
}
function directoryExists() : \PHPUnit\Framework\Constraint\DirectoryExists
{
    return \PHPUnit\Framework\Assert::directoryExists();
}
function fileExists() : \PHPUnit\Framework\Constraint\FileExists
{
    return \PHPUnit\Framework\Assert::fileExists();
}
function greaterThan($value) : \PHPUnit\Framework\Constraint\GreaterThan
{
    return \PHPUnit\Framework\Assert::greaterThan(...\func_get_args());
}
function greaterThanOrEqual($value) : \PHPUnit\Framework\Constraint\LogicalOr
{
    return \PHPUnit\Framework\Assert::greaterThanOrEqual(...\func_get_args());
}
function classHasAttribute(string $attributeName) : \PHPUnit\Framework\Constraint\ClassHasAttribute
{
    return \PHPUnit\Framework\Assert::classHasAttribute(...\func_get_args());
}
function classHasStaticAttribute(string $attributeName) : \PHPUnit\Framework\Constraint\ClassHasStaticAttribute
{
    return \PHPUnit\Framework\Assert::classHasStaticAttribute(...\func_get_args());
}
function objectHasAttribute($attributeName) : \PHPUnit\Framework\Constraint\ObjectHasAttribute
{
    return \PHPUnit\Framework\Assert::objectHasAttribute(...\func_get_args());
}
function identicalTo($value) : \PHPUnit\Framework\Constraint\IsIdentical
{
    return \PHPUnit\Framework\Assert::identicalTo(...\func_get_args());
}
function isInstanceOf(string $className) : \PHPUnit\Framework\Constraint\IsInstanceOf
{
    return \PHPUnit\Framework\Assert::isInstanceOf(...\func_get_args());
}
function isType(string $type) : \PHPUnit\Framework\Constraint\IsType
{
    return \PHPUnit\Framework\Assert::isType(...\func_get_args());
}
function lessThan($value) : \PHPUnit\Framework\Constraint\LessThan
{
    return \PHPUnit\Framework\Assert::lessThan(...\func_get_args());
}
function lessThanOrEqual($value) : \PHPUnit\Framework\Constraint\LogicalOr
{
    return \PHPUnit\Framework\Assert::lessThanOrEqual(...\func_get_args());
}
function matchesRegularExpression(string $pattern) : \PHPUnit\Framework\Constraint\RegularExpression
{
    return \PHPUnit\Framework\Assert::matchesRegularExpression(...\func_get_args());
}
function matches(string $string) : \PHPUnit\Framework\Constraint\StringMatchesFormatDescription
{
    return \PHPUnit\Framework\Assert::matches(...\func_get_args());
}
function stringStartsWith($prefix) : \PHPUnit\Framework\Constraint\StringStartsWith
{
    return \PHPUnit\Framework\Assert::stringStartsWith(...\func_get_args());
}
function stringContains(string $string, bool $case = \true) : \PHPUnit\Framework\Constraint\StringContains
{
    return \PHPUnit\Framework\Assert::stringContains(...\func_get_args());
}
function stringEndsWith(string $suffix) : \PHPUnit\Framework\Constraint\StringEndsWith
{
    return \PHPUnit\Framework\Assert::stringEndsWith(...\func_get_args());
}
function countOf(int $count) : \PHPUnit\Framework\Constraint\Count
{
    return \PHPUnit\Framework\Assert::countOf(...\func_get_args());
}
/**
 * Returns a matcher that matches when the method is executed
 * zero or more times.
 */
function any() : \PHPUnit\Framework\MockObject\Matcher\AnyInvokedCount
{
    return new \PHPUnit\Framework\MockObject\Matcher\AnyInvokedCount();
}
/**
 * Returns a matcher that matches when the method is never executed.
 */
function never() : \PHPUnit\Framework\MockObject\Matcher\InvokedCount
{
    return new \PHPUnit\Framework\MockObject\Matcher\InvokedCount(0);
}
/**
 * Returns a matcher that matches when the method is executed
 * at least N times.
 *
 * @param int $requiredInvocations
 */
function atLeast($requiredInvocations) : \PHPUnit\Framework\MockObject\Matcher\InvokedAtLeastCount
{
    return new \PHPUnit\Framework\MockObject\Matcher\InvokedAtLeastCount($requiredInvocations);
}
/**
 * Returns a matcher that matches when the method is executed at least once.
 */
function atLeastOnce() : \PHPUnit\Framework\MockObject\Matcher\InvokedAtLeastOnce
{
    return new \PHPUnit\Framework\MockObject\Matcher\InvokedAtLeastOnce();
}
/**
 * Returns a matcher that matches when the method is executed exactly once.
 */
function once() : \PHPUnit\Framework\MockObject\Matcher\InvokedCount
{
    return new \PHPUnit\Framework\MockObject\Matcher\InvokedCount(1);
}
/**
 * Returns a matcher that matches when the method is executed
 * exactly $count times.
 *
 * @param int $count
 */
function exactly($count) : \PHPUnit\Framework\MockObject\Matcher\InvokedCount
{
    return new \PHPUnit\Framework\MockObject\Matcher\InvokedCount($count);
}
/**
 * Returns a matcher that matches when the method is executed
 * at most N times.
 *
 * @param int $allowedInvocations
 */
function atMost($allowedInvocations) : \PHPUnit\Framework\MockObject\Matcher\InvokedAtMostCount
{
    return new \PHPUnit\Framework\MockObject\Matcher\InvokedAtMostCount($allowedInvocations);
}
/**
 * Returns a matcher that matches when the method is executed
 * at the given index.
 *
 * @param int $index
 */
function at($index) : \PHPUnit\Framework\MockObject\Matcher\InvokedAtIndex
{
    return new \PHPUnit\Framework\MockObject\Matcher\InvokedAtIndex($index);
}
function returnValue($value) : \PHPUnit\Framework\MockObject\Stub\ReturnStub
{
    return new \PHPUnit\Framework\MockObject\Stub\ReturnStub($value);
}
function returnValueMap(array $valueMap) : \PHPUnit\Framework\MockObject\Stub\ReturnValueMap
{
    return new \PHPUnit\Framework\MockObject\Stub\ReturnValueMap($valueMap);
}
/**
 * @param int $argumentIndex
 */
function returnArgument($argumentIndex) : \PHPUnit\Framework\MockObject\Stub\ReturnArgument
{
    return new \PHPUnit\Framework\MockObject\Stub\ReturnArgument($argumentIndex);
}
function returnCallback($callback) : \PHPUnit\Framework\MockObject\Stub\ReturnCallback
{
    return new \PHPUnit\Framework\MockObject\Stub\ReturnCallback($callback);
}
/**
 * Returns the current object.
 *
 * This method is useful when mocking a fluent interface.
 */
function returnSelf() : \PHPUnit\Framework\MockObject\Stub\ReturnSelf
{
    return new \PHPUnit\Framework\MockObject\Stub\ReturnSelf();
}
function throwException(\Throwable $exception) : \PHPUnit\Framework\MockObject\Stub\Exception
{
    return new \PHPUnit\Framework\MockObject\Stub\Exception($exception);
}
function onConsecutiveCalls() : \PHPUnit\Framework\MockObject\Stub\ConsecutiveCalls
{
    $args = \func_get_args();
    return new \PHPUnit\Framework\MockObject\Stub\ConsecutiveCalls($args);
}
