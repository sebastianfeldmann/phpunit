<?php

/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework;

use ArrayAccess;
use Countable;
use DOMDocument;
use DOMElement;
use PHPUnit\Framework\Constraint\ArrayHasKey;
use PHPUnit\Framework\Constraint\ArraySubset;
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
use PHPUnit\Framework\Constraint\JsonMatches;
use PHPUnit\Framework\Constraint\LessThan;
use PHPUnit\Framework\Constraint\LogicalAnd;
use PHPUnit\Framework\Constraint\LogicalNot;
use PHPUnit\Framework\Constraint\LogicalOr;
use PHPUnit\Framework\Constraint\LogicalXor;
use PHPUnit\Framework\Constraint\ObjectHasAttribute;
use PHPUnit\Framework\Constraint\RegularExpression;
use PHPUnit\Framework\Constraint\SameSize;
use PHPUnit\Framework\Constraint\StringContains;
use PHPUnit\Framework\Constraint\StringEndsWith;
use PHPUnit\Framework\Constraint\StringMatchesFormatDescription;
use PHPUnit\Framework\Constraint\StringStartsWith;
use PHPUnit\Framework\Constraint\TraversableContains;
use PHPUnit\Framework\Constraint\TraversableContainsOnly;
use PHPUnit\Util\InvalidArgumentHelper;
use PHPUnit\Util\Type;
use PHPUnit\Util\Xml;
use ReflectionClass;
use ReflectionException;
use ReflectionObject;
use Traversable;
/**
 * A set of assertion methods.
 */
abstract class Assert
{
    /**
     * @var int
     */
    private static $count = 0;
    /**
     * Asserts that an array has a specified key.
     *
     * @param int|string        $key
     * @param array|ArrayAccess $array
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertArrayHasKey($key, $array, string $message = '') : void
    {
        if (!(\is_int($key) || \is_string($key))) {
            throw \PHPUnit\Util\InvalidArgumentHelper::factory(1, 'integer or string');
        }
        if (!(\is_array($array) || $array instanceof \ArrayAccess)) {
            throw \PHPUnit\Util\InvalidArgumentHelper::factory(2, 'array or ArrayAccess');
        }
        $constraint = new \PHPUnit\Framework\Constraint\ArrayHasKey($key);
        static::assertThat($array, $constraint, $message);
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
    public static function assertArraySubset($subset, $array, bool $checkForObjectIdentity = \false, string $message = '') : void
    {
        if (!(\is_array($subset) || $subset instanceof \ArrayAccess)) {
            throw \PHPUnit\Util\InvalidArgumentHelper::factory(1, 'array or ArrayAccess');
        }
        if (!(\is_array($array) || $array instanceof \ArrayAccess)) {
            throw \PHPUnit\Util\InvalidArgumentHelper::factory(2, 'array or ArrayAccess');
        }
        $constraint = new \PHPUnit\Framework\Constraint\ArraySubset($subset, $checkForObjectIdentity);
        static::assertThat($array, $constraint, $message);
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
    public static function assertArrayNotHasKey($key, $array, string $message = '') : void
    {
        if (!(\is_int($key) || \is_string($key))) {
            throw \PHPUnit\Util\InvalidArgumentHelper::factory(1, 'integer or string');
        }
        if (!(\is_array($array) || $array instanceof \ArrayAccess)) {
            throw \PHPUnit\Util\InvalidArgumentHelper::factory(2, 'array or ArrayAccess');
        }
        $constraint = new \PHPUnit\Framework\Constraint\LogicalNot(new \PHPUnit\Framework\Constraint\ArrayHasKey($key));
        static::assertThat($array, $constraint, $message);
    }
    /**
     * Asserts that a haystack contains a needle.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertContains($needle, $haystack, string $message = '', bool $ignoreCase = \false, bool $checkForObjectIdentity = \true, bool $checkForNonObjectIdentity = \false) : void
    {
        if (\is_array($haystack) || \is_object($haystack) && $haystack instanceof \Traversable) {
            $constraint = new \PHPUnit\Framework\Constraint\TraversableContains($needle, $checkForObjectIdentity, $checkForNonObjectIdentity);
        } elseif (\is_string($haystack)) {
            if (!\is_string($needle)) {
                throw \PHPUnit\Util\InvalidArgumentHelper::factory(1, 'string');
            }
            $constraint = new \PHPUnit\Framework\Constraint\StringContains($needle, $ignoreCase);
        } else {
            throw \PHPUnit\Util\InvalidArgumentHelper::factory(2, 'array, traversable or string');
        }
        static::assertThat($haystack, $constraint, $message);
    }
    /**
     * Asserts that a haystack that is stored in a static attribute of a class
     * or an attribute of an object contains a needle.
     *
     * @param object|string $haystackClassOrObject
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/3338
     */
    public static function assertAttributeContains($needle, string $haystackAttributeName, $haystackClassOrObject, string $message = '', bool $ignoreCase = \false, bool $checkForObjectIdentity = \true, bool $checkForNonObjectIdentity = \false) : void
    {
        static::assertContains($needle, static::readAttribute($haystackClassOrObject, $haystackAttributeName), $message, $ignoreCase, $checkForObjectIdentity, $checkForNonObjectIdentity);
    }
    /**
     * Asserts that a haystack does not contain a needle.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertNotContains($needle, $haystack, string $message = '', bool $ignoreCase = \false, bool $checkForObjectIdentity = \true, bool $checkForNonObjectIdentity = \false) : void
    {
        if (\is_array($haystack) || \is_object($haystack) && $haystack instanceof \Traversable) {
            $constraint = new \PHPUnit\Framework\Constraint\LogicalNot(new \PHPUnit\Framework\Constraint\TraversableContains($needle, $checkForObjectIdentity, $checkForNonObjectIdentity));
        } elseif (\is_string($haystack)) {
            if (!\is_string($needle)) {
                throw \PHPUnit\Util\InvalidArgumentHelper::factory(1, 'string');
            }
            $constraint = new \PHPUnit\Framework\Constraint\LogicalNot(new \PHPUnit\Framework\Constraint\StringContains($needle, $ignoreCase));
        } else {
            throw \PHPUnit\Util\InvalidArgumentHelper::factory(2, 'array, traversable or string');
        }
        static::assertThat($haystack, $constraint, $message);
    }
    /**
     * Asserts that a haystack that is stored in a static attribute of a class
     * or an attribute of an object does not contain a needle.
     *
     * @param object|string $haystackClassOrObject
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/3338
     */
    public static function assertAttributeNotContains($needle, string $haystackAttributeName, $haystackClassOrObject, string $message = '', bool $ignoreCase = \false, bool $checkForObjectIdentity = \true, bool $checkForNonObjectIdentity = \false) : void
    {
        static::assertNotContains($needle, static::readAttribute($haystackClassOrObject, $haystackAttributeName), $message, $ignoreCase, $checkForObjectIdentity, $checkForNonObjectIdentity);
    }
    /**
     * Asserts that a haystack contains only values of a given type.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertContainsOnly(string $type, iterable $haystack, ?bool $isNativeType = null, string $message = '') : void
    {
        if ($isNativeType === null) {
            $isNativeType = \PHPUnit\Util\Type::isType($type);
        }
        static::assertThat($haystack, new \PHPUnit\Framework\Constraint\TraversableContainsOnly($type, $isNativeType), $message);
    }
    /**
     * Asserts that a haystack contains only instances of a given class name.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertContainsOnlyInstancesOf(string $className, iterable $haystack, string $message = '') : void
    {
        static::assertThat($haystack, new \PHPUnit\Framework\Constraint\TraversableContainsOnly($className, \false), $message);
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
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/3338
     */
    public static function assertAttributeContainsOnly(string $type, string $haystackAttributeName, $haystackClassOrObject, ?bool $isNativeType = null, string $message = '') : void
    {
        static::assertContainsOnly($type, static::readAttribute($haystackClassOrObject, $haystackAttributeName), $isNativeType, $message);
    }
    /**
     * Asserts that a haystack does not contain only values of a given type.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertNotContainsOnly(string $type, iterable $haystack, ?bool $isNativeType = null, string $message = '') : void
    {
        if ($isNativeType === null) {
            $isNativeType = \PHPUnit\Util\Type::isType($type);
        }
        static::assertThat($haystack, new \PHPUnit\Framework\Constraint\LogicalNot(new \PHPUnit\Framework\Constraint\TraversableContainsOnly($type, $isNativeType)), $message);
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
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/3338
     */
    public static function assertAttributeNotContainsOnly(string $type, string $haystackAttributeName, $haystackClassOrObject, ?bool $isNativeType = null, string $message = '') : void
    {
        static::assertNotContainsOnly($type, static::readAttribute($haystackClassOrObject, $haystackAttributeName), $isNativeType, $message);
    }
    /**
     * Asserts the number of elements of an array, Countable or Traversable.
     *
     * @param Countable|iterable $haystack
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertCount(int $expectedCount, $haystack, string $message = '') : void
    {
        if (!$haystack instanceof \Countable && !\is_iterable($haystack)) {
            throw \PHPUnit\Util\InvalidArgumentHelper::factory(2, 'countable or iterable');
        }
        static::assertThat($haystack, new \PHPUnit\Framework\Constraint\Count($expectedCount), $message);
    }
    /**
     * Asserts the number of elements of an array, Countable or Traversable
     * that is stored in an attribute.
     *
     * @param object|string $haystackClassOrObject
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/3338
     */
    public static function assertAttributeCount(int $expectedCount, string $haystackAttributeName, $haystackClassOrObject, string $message = '') : void
    {
        static::assertCount($expectedCount, static::readAttribute($haystackClassOrObject, $haystackAttributeName), $message);
    }
    /**
     * Asserts the number of elements of an array, Countable or Traversable.
     *
     * @param Countable|iterable $haystack
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertNotCount(int $expectedCount, $haystack, string $message = '') : void
    {
        if (!$haystack instanceof \Countable && !\is_iterable($haystack)) {
            throw \PHPUnit\Util\InvalidArgumentHelper::factory(2, 'countable or iterable');
        }
        $constraint = new \PHPUnit\Framework\Constraint\LogicalNot(new \PHPUnit\Framework\Constraint\Count($expectedCount));
        static::assertThat($haystack, $constraint, $message);
    }
    /**
     * Asserts the number of elements of an array, Countable or Traversable
     * that is stored in an attribute.
     *
     * @param object|string $haystackClassOrObject
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/3338
     */
    public static function assertAttributeNotCount(int $expectedCount, string $haystackAttributeName, $haystackClassOrObject, string $message = '') : void
    {
        static::assertNotCount($expectedCount, static::readAttribute($haystackClassOrObject, $haystackAttributeName), $message);
    }
    /**
     * Asserts that two variables are equal.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertEquals($expected, $actual, string $message = '', float $delta = 0.0, int $maxDepth = 10, bool $canonicalize = \false, bool $ignoreCase = \false) : void
    {
        $constraint = new \PHPUnit\Framework\Constraint\IsEqual($expected, $delta, $maxDepth, $canonicalize, $ignoreCase);
        static::assertThat($actual, $constraint, $message);
    }
    /**
     * Asserts that two variables are equal (canonicalizing).
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertEqualsCanonicalizing($expected, $actual, string $message = '') : void
    {
        $constraint = new \PHPUnit\Framework\Constraint\IsEqual($expected, 0.0, 10, \true, \false);
        static::assertThat($actual, $constraint, $message);
    }
    /**
     * Asserts that two variables are equal (ignoring case).
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertEqualsIgnoringCase($expected, $actual, string $message = '') : void
    {
        $constraint = new \PHPUnit\Framework\Constraint\IsEqual($expected, 0.0, 10, \false, \true);
        static::assertThat($actual, $constraint, $message);
    }
    /**
     * Asserts that two variables are equal (with delta).
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertEqualsWithDelta($expected, $actual, float $delta, string $message = '') : void
    {
        $constraint = new \PHPUnit\Framework\Constraint\IsEqual($expected, $delta);
        static::assertThat($actual, $constraint, $message);
    }
    /**
     * Asserts that a variable is equal to an attribute of an object.
     *
     * @param object|string $actualClassOrObject
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/3338
     */
    public static function assertAttributeEquals($expected, string $actualAttributeName, $actualClassOrObject, string $message = '', float $delta = 0.0, int $maxDepth = 10, bool $canonicalize = \false, bool $ignoreCase = \false) : void
    {
        static::assertEquals($expected, static::readAttribute($actualClassOrObject, $actualAttributeName), $message, $delta, $maxDepth, $canonicalize, $ignoreCase);
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
    public static function assertNotEquals($expected, $actual, string $message = '', $delta = 0.0, $maxDepth = 10, $canonicalize = \false, $ignoreCase = \false) : void
    {
        $constraint = new \PHPUnit\Framework\Constraint\LogicalNot(new \PHPUnit\Framework\Constraint\IsEqual($expected, $delta, $maxDepth, $canonicalize, $ignoreCase));
        static::assertThat($actual, $constraint, $message);
    }
    /**
     * Asserts that two variables are not equal (canonicalizing).
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertNotEqualsCanonicalizing($expected, $actual, string $message = '') : void
    {
        $constraint = new \PHPUnit\Framework\Constraint\LogicalNot(new \PHPUnit\Framework\Constraint\IsEqual($expected, 0.0, 10, \true, \false));
        static::assertThat($actual, $constraint, $message);
    }
    /**
     * Asserts that two variables are not equal (ignoring case).
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertNotEqualsIgnoringCase($expected, $actual, string $message = '') : void
    {
        $constraint = new \PHPUnit\Framework\Constraint\LogicalNot(new \PHPUnit\Framework\Constraint\IsEqual($expected, 0.0, 10, \false, \true));
        static::assertThat($actual, $constraint, $message);
    }
    /**
     * Asserts that two variables are not equal (with delta).
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertNotEqualsWithDelta($expected, $actual, float $delta, string $message = '') : void
    {
        $constraint = new \PHPUnit\Framework\Constraint\LogicalNot(new \PHPUnit\Framework\Constraint\IsEqual($expected, $delta));
        static::assertThat($actual, $constraint, $message);
    }
    /**
     * Asserts that a variable is not equal to an attribute of an object.
     *
     * @param object|string $actualClassOrObject
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/3338
     */
    public static function assertAttributeNotEquals($expected, string $actualAttributeName, $actualClassOrObject, string $message = '', float $delta = 0.0, int $maxDepth = 10, bool $canonicalize = \false, bool $ignoreCase = \false) : void
    {
        static::assertNotEquals($expected, static::readAttribute($actualClassOrObject, $actualAttributeName), $message, $delta, $maxDepth, $canonicalize, $ignoreCase);
    }
    /**
     * Asserts that a variable is empty.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertEmpty($actual, string $message = '') : void
    {
        static::assertThat($actual, static::isEmpty(), $message);
    }
    /**
     * Asserts that a static attribute of a class or an attribute of an object
     * is empty.
     *
     * @param object|string $haystackClassOrObject
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/3338
     */
    public static function assertAttributeEmpty(string $haystackAttributeName, $haystackClassOrObject, string $message = '') : void
    {
        static::assertEmpty(static::readAttribute($haystackClassOrObject, $haystackAttributeName), $message);
    }
    /**
     * Asserts that a variable is not empty.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertNotEmpty($actual, string $message = '') : void
    {
        static::assertThat($actual, static::logicalNot(static::isEmpty()), $message);
    }
    /**
     * Asserts that a static attribute of a class or an attribute of an object
     * is not empty.
     *
     * @param object|string $haystackClassOrObject
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/3338
     */
    public static function assertAttributeNotEmpty(string $haystackAttributeName, $haystackClassOrObject, string $message = '') : void
    {
        static::assertNotEmpty(static::readAttribute($haystackClassOrObject, $haystackAttributeName), $message);
    }
    /**
     * Asserts that a value is greater than another value.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertGreaterThan($expected, $actual, string $message = '') : void
    {
        static::assertThat($actual, static::greaterThan($expected), $message);
    }
    /**
     * Asserts that an attribute is greater than another value.
     *
     * @param object|string $actualClassOrObject
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/3338
     */
    public static function assertAttributeGreaterThan($expected, string $actualAttributeName, $actualClassOrObject, string $message = '') : void
    {
        static::assertGreaterThan($expected, static::readAttribute($actualClassOrObject, $actualAttributeName), $message);
    }
    /**
     * Asserts that a value is greater than or equal to another value.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertGreaterThanOrEqual($expected, $actual, string $message = '') : void
    {
        static::assertThat($actual, static::greaterThanOrEqual($expected), $message);
    }
    /**
     * Asserts that an attribute is greater than or equal to another value.
     *
     * @param object|string $actualClassOrObject
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/3338
     */
    public static function assertAttributeGreaterThanOrEqual($expected, string $actualAttributeName, $actualClassOrObject, string $message = '') : void
    {
        static::assertGreaterThanOrEqual($expected, static::readAttribute($actualClassOrObject, $actualAttributeName), $message);
    }
    /**
     * Asserts that a value is smaller than another value.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertLessThan($expected, $actual, string $message = '') : void
    {
        static::assertThat($actual, static::lessThan($expected), $message);
    }
    /**
     * Asserts that an attribute is smaller than another value.
     *
     * @param object|string $actualClassOrObject
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/3338
     */
    public static function assertAttributeLessThan($expected, string $actualAttributeName, $actualClassOrObject, string $message = '') : void
    {
        static::assertLessThan($expected, static::readAttribute($actualClassOrObject, $actualAttributeName), $message);
    }
    /**
     * Asserts that a value is smaller than or equal to another value.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertLessThanOrEqual($expected, $actual, string $message = '') : void
    {
        static::assertThat($actual, static::lessThanOrEqual($expected), $message);
    }
    /**
     * Asserts that an attribute is smaller than or equal to another value.
     *
     * @param object|string $actualClassOrObject
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/3338
     */
    public static function assertAttributeLessThanOrEqual($expected, string $actualAttributeName, $actualClassOrObject, string $message = '') : void
    {
        static::assertLessThanOrEqual($expected, static::readAttribute($actualClassOrObject, $actualAttributeName), $message);
    }
    /**
     * Asserts that the contents of one file is equal to the contents of another
     * file.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertFileEquals(string $expected, string $actual, string $message = '', bool $canonicalize = \false, bool $ignoreCase = \false) : void
    {
        static::assertFileExists($expected, $message);
        static::assertFileExists($actual, $message);
        static::assertEquals(\file_get_contents($expected), \file_get_contents($actual), $message, 0, 10, $canonicalize, $ignoreCase);
    }
    /**
     * Asserts that the contents of one file is not equal to the contents of
     * another file.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertFileNotEquals(string $expected, string $actual, string $message = '', bool $canonicalize = \false, bool $ignoreCase = \false) : void
    {
        static::assertFileExists($expected, $message);
        static::assertFileExists($actual, $message);
        static::assertNotEquals(\file_get_contents($expected), \file_get_contents($actual), $message, 0, 10, $canonicalize, $ignoreCase);
    }
    /**
     * Asserts that the contents of a string is equal
     * to the contents of a file.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertStringEqualsFile(string $expectedFile, string $actualString, string $message = '', bool $canonicalize = \false, bool $ignoreCase = \false) : void
    {
        static::assertFileExists($expectedFile, $message);
        /** @noinspection PhpUnitTestsInspection */
        static::assertEquals(\file_get_contents($expectedFile), $actualString, $message, 0, 10, $canonicalize, $ignoreCase);
    }
    /**
     * Asserts that the contents of a string is not equal
     * to the contents of a file.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertStringNotEqualsFile(string $expectedFile, string $actualString, string $message = '', bool $canonicalize = \false, bool $ignoreCase = \false) : void
    {
        static::assertFileExists($expectedFile, $message);
        static::assertNotEquals(\file_get_contents($expectedFile), $actualString, $message, 0, 10, $canonicalize, $ignoreCase);
    }
    /**
     * Asserts that a file/dir is readable.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertIsReadable(string $filename, string $message = '') : void
    {
        static::assertThat($filename, new \PHPUnit\Framework\Constraint\IsReadable(), $message);
    }
    /**
     * Asserts that a file/dir exists and is not readable.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertNotIsReadable(string $filename, string $message = '') : void
    {
        static::assertThat($filename, new \PHPUnit\Framework\Constraint\LogicalNot(new \PHPUnit\Framework\Constraint\IsReadable()), $message);
    }
    /**
     * Asserts that a file/dir exists and is writable.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertIsWritable(string $filename, string $message = '') : void
    {
        static::assertThat($filename, new \PHPUnit\Framework\Constraint\IsWritable(), $message);
    }
    /**
     * Asserts that a file/dir exists and is not writable.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertNotIsWritable(string $filename, string $message = '') : void
    {
        static::assertThat($filename, new \PHPUnit\Framework\Constraint\LogicalNot(new \PHPUnit\Framework\Constraint\IsWritable()), $message);
    }
    /**
     * Asserts that a directory exists.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertDirectoryExists(string $directory, string $message = '') : void
    {
        static::assertThat($directory, new \PHPUnit\Framework\Constraint\DirectoryExists(), $message);
    }
    /**
     * Asserts that a directory does not exist.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertDirectoryNotExists(string $directory, string $message = '') : void
    {
        static::assertThat($directory, new \PHPUnit\Framework\Constraint\LogicalNot(new \PHPUnit\Framework\Constraint\DirectoryExists()), $message);
    }
    /**
     * Asserts that a directory exists and is readable.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertDirectoryIsReadable(string $directory, string $message = '') : void
    {
        self::assertDirectoryExists($directory, $message);
        self::assertIsReadable($directory, $message);
    }
    /**
     * Asserts that a directory exists and is not readable.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertDirectoryNotIsReadable(string $directory, string $message = '') : void
    {
        self::assertDirectoryExists($directory, $message);
        self::assertNotIsReadable($directory, $message);
    }
    /**
     * Asserts that a directory exists and is writable.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertDirectoryIsWritable(string $directory, string $message = '') : void
    {
        self::assertDirectoryExists($directory, $message);
        self::assertIsWritable($directory, $message);
    }
    /**
     * Asserts that a directory exists and is not writable.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertDirectoryNotIsWritable(string $directory, string $message = '') : void
    {
        self::assertDirectoryExists($directory, $message);
        self::assertNotIsWritable($directory, $message);
    }
    /**
     * Asserts that a file exists.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertFileExists(string $filename, string $message = '') : void
    {
        static::assertThat($filename, new \PHPUnit\Framework\Constraint\FileExists(), $message);
    }
    /**
     * Asserts that a file does not exist.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertFileNotExists(string $filename, string $message = '') : void
    {
        static::assertThat($filename, new \PHPUnit\Framework\Constraint\LogicalNot(new \PHPUnit\Framework\Constraint\FileExists()), $message);
    }
    /**
     * Asserts that a file exists and is readable.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertFileIsReadable(string $file, string $message = '') : void
    {
        self::assertFileExists($file, $message);
        self::assertIsReadable($file, $message);
    }
    /**
     * Asserts that a file exists and is not readable.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertFileNotIsReadable(string $file, string $message = '') : void
    {
        self::assertFileExists($file, $message);
        self::assertNotIsReadable($file, $message);
    }
    /**
     * Asserts that a file exists and is writable.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertFileIsWritable(string $file, string $message = '') : void
    {
        self::assertFileExists($file, $message);
        self::assertIsWritable($file, $message);
    }
    /**
     * Asserts that a file exists and is not writable.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertFileNotIsWritable(string $file, string $message = '') : void
    {
        self::assertFileExists($file, $message);
        self::assertNotIsWritable($file, $message);
    }
    /**
     * Asserts that a condition is true.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertTrue($condition, string $message = '') : void
    {
        static::assertThat($condition, static::isTrue(), $message);
    }
    /**
     * Asserts that a condition is not true.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertNotTrue($condition, string $message = '') : void
    {
        static::assertThat($condition, static::logicalNot(static::isTrue()), $message);
    }
    /**
     * Asserts that a condition is false.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertFalse($condition, string $message = '') : void
    {
        static::assertThat($condition, static::isFalse(), $message);
    }
    /**
     * Asserts that a condition is not false.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertNotFalse($condition, string $message = '') : void
    {
        static::assertThat($condition, static::logicalNot(static::isFalse()), $message);
    }
    /**
     * Asserts that a variable is null.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertNull($actual, string $message = '') : void
    {
        static::assertThat($actual, static::isNull(), $message);
    }
    /**
     * Asserts that a variable is not null.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertNotNull($actual, string $message = '') : void
    {
        static::assertThat($actual, static::logicalNot(static::isNull()), $message);
    }
    /**
     * Asserts that a variable is finite.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertFinite($actual, string $message = '') : void
    {
        static::assertThat($actual, static::isFinite(), $message);
    }
    /**
     * Asserts that a variable is infinite.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertInfinite($actual, string $message = '') : void
    {
        static::assertThat($actual, static::isInfinite(), $message);
    }
    /**
     * Asserts that a variable is nan.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertNan($actual, string $message = '') : void
    {
        static::assertThat($actual, static::isNan(), $message);
    }
    /**
     * Asserts that a class has a specified attribute.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertClassHasAttribute(string $attributeName, string $className, string $message = '') : void
    {
        if (!self::isValidAttributeName($attributeName)) {
            throw \PHPUnit\Util\InvalidArgumentHelper::factory(1, 'valid attribute name');
        }
        if (!\class_exists($className)) {
            throw \PHPUnit\Util\InvalidArgumentHelper::factory(2, 'class name', $className);
        }
        static::assertThat($className, new \PHPUnit\Framework\Constraint\ClassHasAttribute($attributeName), $message);
    }
    /**
     * Asserts that a class does not have a specified attribute.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertClassNotHasAttribute(string $attributeName, string $className, string $message = '') : void
    {
        if (!self::isValidAttributeName($attributeName)) {
            throw \PHPUnit\Util\InvalidArgumentHelper::factory(1, 'valid attribute name');
        }
        if (!\class_exists($className)) {
            throw \PHPUnit\Util\InvalidArgumentHelper::factory(2, 'class name', $className);
        }
        static::assertThat($className, new \PHPUnit\Framework\Constraint\LogicalNot(new \PHPUnit\Framework\Constraint\ClassHasAttribute($attributeName)), $message);
    }
    /**
     * Asserts that a class has a specified static attribute.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertClassHasStaticAttribute(string $attributeName, string $className, string $message = '') : void
    {
        if (!self::isValidAttributeName($attributeName)) {
            throw \PHPUnit\Util\InvalidArgumentHelper::factory(1, 'valid attribute name');
        }
        if (!\class_exists($className)) {
            throw \PHPUnit\Util\InvalidArgumentHelper::factory(2, 'class name', $className);
        }
        static::assertThat($className, new \PHPUnit\Framework\Constraint\ClassHasStaticAttribute($attributeName), $message);
    }
    /**
     * Asserts that a class does not have a specified static attribute.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertClassNotHasStaticAttribute(string $attributeName, string $className, string $message = '') : void
    {
        if (!self::isValidAttributeName($attributeName)) {
            throw \PHPUnit\Util\InvalidArgumentHelper::factory(1, 'valid attribute name');
        }
        if (!\class_exists($className)) {
            throw \PHPUnit\Util\InvalidArgumentHelper::factory(2, 'class name', $className);
        }
        static::assertThat($className, new \PHPUnit\Framework\Constraint\LogicalNot(new \PHPUnit\Framework\Constraint\ClassHasStaticAttribute($attributeName)), $message);
    }
    /**
     * Asserts that an object has a specified attribute.
     *
     * @param object $object
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertObjectHasAttribute(string $attributeName, $object, string $message = '') : void
    {
        if (!self::isValidAttributeName($attributeName)) {
            throw \PHPUnit\Util\InvalidArgumentHelper::factory(1, 'valid attribute name');
        }
        if (!\is_object($object)) {
            throw \PHPUnit\Util\InvalidArgumentHelper::factory(2, 'object');
        }
        static::assertThat($object, new \PHPUnit\Framework\Constraint\ObjectHasAttribute($attributeName), $message);
    }
    /**
     * Asserts that an object does not have a specified attribute.
     *
     * @param object $object
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertObjectNotHasAttribute(string $attributeName, $object, string $message = '') : void
    {
        if (!self::isValidAttributeName($attributeName)) {
            throw \PHPUnit\Util\InvalidArgumentHelper::factory(1, 'valid attribute name');
        }
        if (!\is_object($object)) {
            throw \PHPUnit\Util\InvalidArgumentHelper::factory(2, 'object');
        }
        static::assertThat($object, new \PHPUnit\Framework\Constraint\LogicalNot(new \PHPUnit\Framework\Constraint\ObjectHasAttribute($attributeName)), $message);
    }
    /**
     * Asserts that two variables have the same type and value.
     * Used on objects, it asserts that two variables reference
     * the same object.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertSame($expected, $actual, string $message = '') : void
    {
        static::assertThat($actual, new \PHPUnit\Framework\Constraint\IsIdentical($expected), $message);
    }
    /**
     * Asserts that a variable and an attribute of an object have the same type
     * and value.
     *
     * @param object|string $actualClassOrObject
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/3338
     */
    public static function assertAttributeSame($expected, string $actualAttributeName, $actualClassOrObject, string $message = '') : void
    {
        static::assertSame($expected, static::readAttribute($actualClassOrObject, $actualAttributeName), $message);
    }
    /**
     * Asserts that two variables do not have the same type and value.
     * Used on objects, it asserts that two variables do not reference
     * the same object.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertNotSame($expected, $actual, string $message = '') : void
    {
        if (\is_bool($expected) && \is_bool($actual)) {
            static::assertNotEquals($expected, $actual, $message);
        }
        static::assertThat($actual, new \PHPUnit\Framework\Constraint\LogicalNot(new \PHPUnit\Framework\Constraint\IsIdentical($expected)), $message);
    }
    /**
     * Asserts that a variable and an attribute of an object do not have the
     * same type and value.
     *
     * @param object|string $actualClassOrObject
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/3338
     */
    public static function assertAttributeNotSame($expected, string $actualAttributeName, $actualClassOrObject, string $message = '') : void
    {
        static::assertNotSame($expected, static::readAttribute($actualClassOrObject, $actualAttributeName), $message);
    }
    /**
     * Asserts that a variable is of a given type.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertInstanceOf(string $expected, $actual, string $message = '') : void
    {
        if (!\class_exists($expected) && !\interface_exists($expected)) {
            throw \PHPUnit\Util\InvalidArgumentHelper::factory(1, 'class or interface name');
        }
        static::assertThat($actual, new \PHPUnit\Framework\Constraint\IsInstanceOf($expected), $message);
    }
    /**
     * Asserts that an attribute is of a given type.
     *
     * @param object|string $classOrObject
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/3338
     */
    public static function assertAttributeInstanceOf(string $expected, string $attributeName, $classOrObject, string $message = '') : void
    {
        static::assertInstanceOf($expected, static::readAttribute($classOrObject, $attributeName), $message);
    }
    /**
     * Asserts that a variable is not of a given type.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertNotInstanceOf(string $expected, $actual, string $message = '') : void
    {
        if (!\class_exists($expected) && !\interface_exists($expected)) {
            throw \PHPUnit\Util\InvalidArgumentHelper::factory(1, 'class or interface name');
        }
        static::assertThat($actual, new \PHPUnit\Framework\Constraint\LogicalNot(new \PHPUnit\Framework\Constraint\IsInstanceOf($expected)), $message);
    }
    /**
     * Asserts that an attribute is of a given type.
     *
     * @param object|string $classOrObject
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/3338
     */
    public static function assertAttributeNotInstanceOf(string $expected, string $attributeName, $classOrObject, string $message = '') : void
    {
        static::assertNotInstanceOf($expected, static::readAttribute($classOrObject, $attributeName), $message);
    }
    /**
     * Asserts that a variable is of a given type.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/3369
     */
    public static function assertInternalType(string $expected, $actual, string $message = '') : void
    {
        static::assertThat($actual, new \PHPUnit\Framework\Constraint\IsType($expected), $message);
    }
    /**
     * Asserts that an attribute is of a given type.
     *
     * @param object|string $classOrObject
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/3338
     */
    public static function assertAttributeInternalType(string $expected, string $attributeName, $classOrObject, string $message = '') : void
    {
        static::assertInternalType($expected, static::readAttribute($classOrObject, $attributeName), $message);
    }
    /**
     * Asserts that a variable is of type array.
     */
    public static function assertIsArray($actual, string $message = '') : void
    {
        static::assertThat($actual, new \PHPUnit\Framework\Constraint\IsType(\PHPUnit\Framework\Constraint\IsType::TYPE_ARRAY), $message);
    }
    /**
     * Asserts that a variable is of type bool.
     */
    public static function assertIsBool($actual, string $message = '') : void
    {
        static::assertThat($actual, new \PHPUnit\Framework\Constraint\IsType(\PHPUnit\Framework\Constraint\IsType::TYPE_BOOL), $message);
    }
    /**
     * Asserts that a variable is of type float.
     */
    public static function assertIsFloat($actual, string $message = '') : void
    {
        static::assertThat($actual, new \PHPUnit\Framework\Constraint\IsType(\PHPUnit\Framework\Constraint\IsType::TYPE_FLOAT), $message);
    }
    /**
     * Asserts that a variable is of type int.
     */
    public static function assertIsInt($actual, string $message = '') : void
    {
        static::assertThat($actual, new \PHPUnit\Framework\Constraint\IsType(\PHPUnit\Framework\Constraint\IsType::TYPE_INT), $message);
    }
    /**
     * Asserts that a variable is of type numeric.
     */
    public static function assertIsNumeric($actual, string $message = '') : void
    {
        static::assertThat($actual, new \PHPUnit\Framework\Constraint\IsType(\PHPUnit\Framework\Constraint\IsType::TYPE_NUMERIC), $message);
    }
    /**
     * Asserts that a variable is of type object.
     */
    public static function assertIsObject($actual, string $message = '') : void
    {
        static::assertThat($actual, new \PHPUnit\Framework\Constraint\IsType(\PHPUnit\Framework\Constraint\IsType::TYPE_OBJECT), $message);
    }
    /**
     * Asserts that a variable is of type resource.
     */
    public static function assertIsResource($actual, string $message = '') : void
    {
        static::assertThat($actual, new \PHPUnit\Framework\Constraint\IsType(\PHPUnit\Framework\Constraint\IsType::TYPE_RESOURCE), $message);
    }
    /**
     * Asserts that a variable is of type string.
     */
    public static function assertIsString($actual, string $message = '') : void
    {
        static::assertThat($actual, new \PHPUnit\Framework\Constraint\IsType(\PHPUnit\Framework\Constraint\IsType::TYPE_STRING), $message);
    }
    /**
     * Asserts that a variable is of type scalar.
     */
    public static function assertIsScalar($actual, string $message = '') : void
    {
        static::assertThat($actual, new \PHPUnit\Framework\Constraint\IsType(\PHPUnit\Framework\Constraint\IsType::TYPE_SCALAR), $message);
    }
    /**
     * Asserts that a variable is of type callable.
     */
    public static function assertIsCallable($actual, string $message = '') : void
    {
        static::assertThat($actual, new \PHPUnit\Framework\Constraint\IsType(\PHPUnit\Framework\Constraint\IsType::TYPE_CALLABLE), $message);
    }
    /**
     * Asserts that a variable is of type iterable.
     */
    public static function assertIsIterable($actual, string $message = '') : void
    {
        static::assertThat($actual, new \PHPUnit\Framework\Constraint\IsType(\PHPUnit\Framework\Constraint\IsType::TYPE_ITERABLE), $message);
    }
    /**
     * Asserts that a variable is not of a given type.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/3369
     */
    public static function assertNotInternalType(string $expected, $actual, string $message = '') : void
    {
        static::assertThat($actual, new \PHPUnit\Framework\Constraint\LogicalNot(new \PHPUnit\Framework\Constraint\IsType($expected)), $message);
    }
    /**
     * Asserts that a variable is not of type array.
     */
    public static function assertIsNotArray($actual, string $message = '') : void
    {
        static::assertThat($actual, new \PHPUnit\Framework\Constraint\LogicalNot(new \PHPUnit\Framework\Constraint\IsType(\PHPUnit\Framework\Constraint\IsType::TYPE_ARRAY)), $message);
    }
    /**
     * Asserts that a variable is not of type bool.
     */
    public static function assertIsNotBool($actual, string $message = '') : void
    {
        static::assertThat($actual, new \PHPUnit\Framework\Constraint\LogicalNot(new \PHPUnit\Framework\Constraint\IsType(\PHPUnit\Framework\Constraint\IsType::TYPE_BOOL)), $message);
    }
    /**
     * Asserts that a variable is not of type float.
     */
    public static function assertIsNotFloat($actual, string $message = '') : void
    {
        static::assertThat($actual, new \PHPUnit\Framework\Constraint\LogicalNot(new \PHPUnit\Framework\Constraint\IsType(\PHPUnit\Framework\Constraint\IsType::TYPE_FLOAT)), $message);
    }
    /**
     * Asserts that a variable is not of type int.
     */
    public static function assertIsNotInt($actual, string $message = '') : void
    {
        static::assertThat($actual, new \PHPUnit\Framework\Constraint\LogicalNot(new \PHPUnit\Framework\Constraint\IsType(\PHPUnit\Framework\Constraint\IsType::TYPE_INT)), $message);
    }
    /**
     * Asserts that a variable is not of type numeric.
     */
    public static function assertIsNotNumeric($actual, string $message = '') : void
    {
        static::assertThat($actual, new \PHPUnit\Framework\Constraint\LogicalNot(new \PHPUnit\Framework\Constraint\IsType(\PHPUnit\Framework\Constraint\IsType::TYPE_NUMERIC)), $message);
    }
    /**
     * Asserts that a variable is not of type object.
     */
    public static function assertIsNotObject($actual, string $message = '') : void
    {
        static::assertThat($actual, new \PHPUnit\Framework\Constraint\LogicalNot(new \PHPUnit\Framework\Constraint\IsType(\PHPUnit\Framework\Constraint\IsType::TYPE_OBJECT)), $message);
    }
    /**
     * Asserts that a variable is not of type resource.
     */
    public static function assertIsNotResource($actual, string $message = '') : void
    {
        static::assertThat($actual, new \PHPUnit\Framework\Constraint\LogicalNot(new \PHPUnit\Framework\Constraint\IsType(\PHPUnit\Framework\Constraint\IsType::TYPE_RESOURCE)), $message);
    }
    /**
     * Asserts that a variable is not of type string.
     */
    public static function assertIsNotString($actual, string $message = '') : void
    {
        static::assertThat($actual, new \PHPUnit\Framework\Constraint\LogicalNot(new \PHPUnit\Framework\Constraint\IsType(\PHPUnit\Framework\Constraint\IsType::TYPE_STRING)), $message);
    }
    /**
     * Asserts that a variable is not of type scalar.
     */
    public static function assertIsNotScalar($actual, string $message = '') : void
    {
        static::assertThat($actual, new \PHPUnit\Framework\Constraint\LogicalNot(new \PHPUnit\Framework\Constraint\IsType(\PHPUnit\Framework\Constraint\IsType::TYPE_SCALAR)), $message);
    }
    /**
     * Asserts that a variable is not of type callable.
     */
    public static function assertIsNotCallable($actual, string $message = '') : void
    {
        static::assertThat($actual, new \PHPUnit\Framework\Constraint\LogicalNot(new \PHPUnit\Framework\Constraint\IsType(\PHPUnit\Framework\Constraint\IsType::TYPE_CALLABLE)), $message);
    }
    /**
     * Asserts that a variable is not of type iterable.
     */
    public static function assertIsNotIterable($actual, string $message = '') : void
    {
        static::assertThat($actual, new \PHPUnit\Framework\Constraint\LogicalNot(new \PHPUnit\Framework\Constraint\IsType(\PHPUnit\Framework\Constraint\IsType::TYPE_ITERABLE)), $message);
    }
    /**
     * Asserts that an attribute is of a given type.
     *
     * @param object|string $classOrObject
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/3338
     */
    public static function assertAttributeNotInternalType(string $expected, string $attributeName, $classOrObject, string $message = '') : void
    {
        static::assertNotInternalType($expected, static::readAttribute($classOrObject, $attributeName), $message);
    }
    /**
     * Asserts that a string matches a given regular expression.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertRegExp(string $pattern, string $string, string $message = '') : void
    {
        static::assertThat($string, new \PHPUnit\Framework\Constraint\RegularExpression($pattern), $message);
    }
    /**
     * Asserts that a string does not match a given regular expression.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertNotRegExp(string $pattern, string $string, string $message = '') : void
    {
        static::assertThat($string, new \PHPUnit\Framework\Constraint\LogicalNot(new \PHPUnit\Framework\Constraint\RegularExpression($pattern)), $message);
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
    public static function assertSameSize($expected, $actual, string $message = '') : void
    {
        if (!$expected instanceof \Countable && !\is_iterable($expected)) {
            throw \PHPUnit\Util\InvalidArgumentHelper::factory(1, 'countable or iterable');
        }
        if (!$actual instanceof \Countable && !\is_iterable($actual)) {
            throw \PHPUnit\Util\InvalidArgumentHelper::factory(2, 'countable or iterable');
        }
        static::assertThat($actual, new \PHPUnit\Framework\Constraint\SameSize($expected), $message);
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
    public static function assertNotSameSize($expected, $actual, string $message = '') : void
    {
        if (!$expected instanceof \Countable && !\is_iterable($expected)) {
            throw \PHPUnit\Util\InvalidArgumentHelper::factory(1, 'countable or iterable');
        }
        if (!$actual instanceof \Countable && !\is_iterable($actual)) {
            throw \PHPUnit\Util\InvalidArgumentHelper::factory(2, 'countable or iterable');
        }
        static::assertThat($actual, new \PHPUnit\Framework\Constraint\LogicalNot(new \PHPUnit\Framework\Constraint\SameSize($expected)), $message);
    }
    /**
     * Asserts that a string matches a given format string.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertStringMatchesFormat(string $format, string $string, string $message = '') : void
    {
        static::assertThat($string, new \PHPUnit\Framework\Constraint\StringMatchesFormatDescription($format), $message);
    }
    /**
     * Asserts that a string does not match a given format string.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertStringNotMatchesFormat(string $format, string $string, string $message = '') : void
    {
        static::assertThat($string, new \PHPUnit\Framework\Constraint\LogicalNot(new \PHPUnit\Framework\Constraint\StringMatchesFormatDescription($format)), $message);
    }
    /**
     * Asserts that a string matches a given format file.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertStringMatchesFormatFile(string $formatFile, string $string, string $message = '') : void
    {
        static::assertFileExists($formatFile, $message);
        static::assertThat($string, new \PHPUnit\Framework\Constraint\StringMatchesFormatDescription(\file_get_contents($formatFile)), $message);
    }
    /**
     * Asserts that a string does not match a given format string.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertStringNotMatchesFormatFile(string $formatFile, string $string, string $message = '') : void
    {
        static::assertFileExists($formatFile, $message);
        static::assertThat($string, new \PHPUnit\Framework\Constraint\LogicalNot(new \PHPUnit\Framework\Constraint\StringMatchesFormatDescription(\file_get_contents($formatFile))), $message);
    }
    /**
     * Asserts that a string starts with a given prefix.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertStringStartsWith(string $prefix, string $string, string $message = '') : void
    {
        static::assertThat($string, new \PHPUnit\Framework\Constraint\StringStartsWith($prefix), $message);
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
    public static function assertStringStartsNotWith($prefix, $string, string $message = '') : void
    {
        static::assertThat($string, new \PHPUnit\Framework\Constraint\LogicalNot(new \PHPUnit\Framework\Constraint\StringStartsWith($prefix)), $message);
    }
    /**
     * Asserts that a string ends with a given suffix.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertStringEndsWith(string $suffix, string $string, string $message = '') : void
    {
        static::assertThat($string, new \PHPUnit\Framework\Constraint\StringEndsWith($suffix), $message);
    }
    /**
     * Asserts that a string ends not with a given suffix.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertStringEndsNotWith(string $suffix, string $string, string $message = '') : void
    {
        static::assertThat($string, new \PHPUnit\Framework\Constraint\LogicalNot(new \PHPUnit\Framework\Constraint\StringEndsWith($suffix)), $message);
    }
    /**
     * Asserts that two XML files are equal.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertXmlFileEqualsXmlFile(string $expectedFile, string $actualFile, string $message = '') : void
    {
        $expected = \PHPUnit\Util\Xml::loadFile($expectedFile);
        $actual = \PHPUnit\Util\Xml::loadFile($actualFile);
        static::assertEquals($expected, $actual, $message);
    }
    /**
     * Asserts that two XML files are not equal.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertXmlFileNotEqualsXmlFile(string $expectedFile, string $actualFile, string $message = '') : void
    {
        $expected = \PHPUnit\Util\Xml::loadFile($expectedFile);
        $actual = \PHPUnit\Util\Xml::loadFile($actualFile);
        static::assertNotEquals($expected, $actual, $message);
    }
    /**
     * Asserts that two XML documents are equal.
     *
     * @param DOMDocument|string $actualXml
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertXmlStringEqualsXmlFile(string $expectedFile, $actualXml, string $message = '') : void
    {
        $expected = \PHPUnit\Util\Xml::loadFile($expectedFile);
        $actual = \PHPUnit\Util\Xml::load($actualXml);
        static::assertEquals($expected, $actual, $message);
    }
    /**
     * Asserts that two XML documents are not equal.
     *
     * @param DOMDocument|string $actualXml
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertXmlStringNotEqualsXmlFile(string $expectedFile, $actualXml, string $message = '') : void
    {
        $expected = \PHPUnit\Util\Xml::loadFile($expectedFile);
        $actual = \PHPUnit\Util\Xml::load($actualXml);
        static::assertNotEquals($expected, $actual, $message);
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
    public static function assertXmlStringEqualsXmlString($expectedXml, $actualXml, string $message = '') : void
    {
        $expected = \PHPUnit\Util\Xml::load($expectedXml);
        $actual = \PHPUnit\Util\Xml::load($actualXml);
        static::assertEquals($expected, $actual, $message);
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
    public static function assertXmlStringNotEqualsXmlString($expectedXml, $actualXml, string $message = '') : void
    {
        $expected = \PHPUnit\Util\Xml::load($expectedXml);
        $actual = \PHPUnit\Util\Xml::load($actualXml);
        static::assertNotEquals($expected, $actual, $message);
    }
    /**
     * Asserts that a hierarchy of DOMElements matches.
     *
     * @throws AssertionFailedError
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertEqualXMLStructure(\DOMElement $expectedElement, \DOMElement $actualElement, bool $checkAttributes = \false, string $message = '') : void
    {
        $expectedElement = \PHPUnit\Util\Xml::import($expectedElement);
        $actualElement = \PHPUnit\Util\Xml::import($actualElement);
        static::assertSame($expectedElement->tagName, $actualElement->tagName, $message);
        if ($checkAttributes) {
            static::assertSame($expectedElement->attributes->length, $actualElement->attributes->length, \sprintf('%s%sNumber of attributes on node "%s" does not match', $message, !empty($message) ? "\n" : '', $expectedElement->tagName));
            for ($i = 0; $i < $expectedElement->attributes->length; $i++) {
                /** @var \DOMAttr $expectedAttribute */
                $expectedAttribute = $expectedElement->attributes->item($i);
                /** @var \DOMAttr $actualAttribute */
                $actualAttribute = $actualElement->attributes->getNamedItem($expectedAttribute->name);
                if (!$actualAttribute) {
                    static::fail(\sprintf('%s%sCould not find attribute "%s" on node "%s"', $message, !empty($message) ? "\n" : '', $expectedAttribute->name, $expectedElement->tagName));
                }
            }
        }
        \PHPUnit\Util\Xml::removeCharacterDataNodes($expectedElement);
        \PHPUnit\Util\Xml::removeCharacterDataNodes($actualElement);
        static::assertSame($expectedElement->childNodes->length, $actualElement->childNodes->length, \sprintf('%s%sNumber of child nodes of "%s" differs', $message, !empty($message) ? "\n" : '', $expectedElement->tagName));
        for ($i = 0; $i < $expectedElement->childNodes->length; $i++) {
            static::assertEqualXMLStructure($expectedElement->childNodes->item($i), $actualElement->childNodes->item($i), $checkAttributes, $message);
        }
    }
    /**
     * Evaluates a PHPUnit\Framework\Constraint matcher object.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertThat($value, \PHPUnit\Framework\Constraint\Constraint $constraint, string $message = '') : void
    {
        self::$count += \count($constraint);
        $constraint->evaluate($value, $message);
    }
    /**
     * Asserts that a string is a valid JSON string.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertJson(string $actualJson, string $message = '') : void
    {
        static::assertThat($actualJson, static::isJson(), $message);
    }
    /**
     * Asserts that two given JSON encoded objects or arrays are equal.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertJsonStringEqualsJsonString(string $expectedJson, string $actualJson, string $message = '') : void
    {
        static::assertJson($expectedJson, $message);
        static::assertJson($actualJson, $message);
        static::assertThat($actualJson, new \PHPUnit\Framework\Constraint\JsonMatches($expectedJson), $message);
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
    public static function assertJsonStringNotEqualsJsonString($expectedJson, $actualJson, string $message = '') : void
    {
        static::assertJson($expectedJson, $message);
        static::assertJson($actualJson, $message);
        static::assertThat($actualJson, new \PHPUnit\Framework\Constraint\LogicalNot(new \PHPUnit\Framework\Constraint\JsonMatches($expectedJson)), $message);
    }
    /**
     * Asserts that the generated JSON encoded object and the content of the given file are equal.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertJsonStringEqualsJsonFile(string $expectedFile, string $actualJson, string $message = '') : void
    {
        static::assertFileExists($expectedFile, $message);
        $expectedJson = \file_get_contents($expectedFile);
        static::assertJson($expectedJson, $message);
        static::assertJson($actualJson, $message);
        static::assertThat($actualJson, new \PHPUnit\Framework\Constraint\JsonMatches($expectedJson), $message);
    }
    /**
     * Asserts that the generated JSON encoded object and the content of the given file are not equal.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertJsonStringNotEqualsJsonFile(string $expectedFile, string $actualJson, string $message = '') : void
    {
        static::assertFileExists($expectedFile, $message);
        $expectedJson = \file_get_contents($expectedFile);
        static::assertJson($expectedJson, $message);
        static::assertJson($actualJson, $message);
        static::assertThat($actualJson, new \PHPUnit\Framework\Constraint\LogicalNot(new \PHPUnit\Framework\Constraint\JsonMatches($expectedJson)), $message);
    }
    /**
     * Asserts that two JSON files are equal.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertJsonFileEqualsJsonFile(string $expectedFile, string $actualFile, string $message = '') : void
    {
        static::assertFileExists($expectedFile, $message);
        static::assertFileExists($actualFile, $message);
        $actualJson = \file_get_contents($actualFile);
        $expectedJson = \file_get_contents($expectedFile);
        static::assertJson($expectedJson, $message);
        static::assertJson($actualJson, $message);
        $constraintExpected = new \PHPUnit\Framework\Constraint\JsonMatches($expectedJson);
        $constraintActual = new \PHPUnit\Framework\Constraint\JsonMatches($actualJson);
        static::assertThat($expectedJson, $constraintActual, $message);
        static::assertThat($actualJson, $constraintExpected, $message);
    }
    /**
     * Asserts that two JSON files are not equal.
     *
     * @throws ExpectationFailedException
     * @throws \SebastianBergmann\RecursionContext\InvalidArgumentException
     */
    public static function assertJsonFileNotEqualsJsonFile(string $expectedFile, string $actualFile, string $message = '') : void
    {
        static::assertFileExists($expectedFile, $message);
        static::assertFileExists($actualFile, $message);
        $actualJson = \file_get_contents($actualFile);
        $expectedJson = \file_get_contents($expectedFile);
        static::assertJson($expectedJson, $message);
        static::assertJson($actualJson, $message);
        $constraintExpected = new \PHPUnit\Framework\Constraint\JsonMatches($expectedJson);
        $constraintActual = new \PHPUnit\Framework\Constraint\JsonMatches($actualJson);
        static::assertThat($expectedJson, new \PHPUnit\Framework\Constraint\LogicalNot($constraintActual), $message);
        static::assertThat($actualJson, new \PHPUnit\Framework\Constraint\LogicalNot($constraintExpected), $message);
    }
    public static function logicalAnd() : \PHPUnit\Framework\Constraint\LogicalAnd
    {
        $constraints = \func_get_args();
        $constraint = new \PHPUnit\Framework\Constraint\LogicalAnd();
        $constraint->setConstraints($constraints);
        return $constraint;
    }
    public static function logicalOr() : \PHPUnit\Framework\Constraint\LogicalOr
    {
        $constraints = \func_get_args();
        $constraint = new \PHPUnit\Framework\Constraint\LogicalOr();
        $constraint->setConstraints($constraints);
        return $constraint;
    }
    public static function logicalNot(\PHPUnit\Framework\Constraint\Constraint $constraint) : \PHPUnit\Framework\Constraint\LogicalNot
    {
        return new \PHPUnit\Framework\Constraint\LogicalNot($constraint);
    }
    public static function logicalXor() : \PHPUnit\Framework\Constraint\LogicalXor
    {
        $constraints = \func_get_args();
        $constraint = new \PHPUnit\Framework\Constraint\LogicalXor();
        $constraint->setConstraints($constraints);
        return $constraint;
    }
    public static function anything() : \PHPUnit\Framework\Constraint\IsAnything
    {
        return new \PHPUnit\Framework\Constraint\IsAnything();
    }
    public static function isTrue() : \PHPUnit\Framework\Constraint\IsTrue
    {
        return new \PHPUnit\Framework\Constraint\IsTrue();
    }
    public static function callback(callable $callback) : \PHPUnit\Framework\Constraint\Callback
    {
        return new \PHPUnit\Framework\Constraint\Callback($callback);
    }
    public static function isFalse() : \PHPUnit\Framework\Constraint\IsFalse
    {
        return new \PHPUnit\Framework\Constraint\IsFalse();
    }
    public static function isJson() : \PHPUnit\Framework\Constraint\IsJson
    {
        return new \PHPUnit\Framework\Constraint\IsJson();
    }
    public static function isNull() : \PHPUnit\Framework\Constraint\IsNull
    {
        return new \PHPUnit\Framework\Constraint\IsNull();
    }
    public static function isFinite() : \PHPUnit\Framework\Constraint\IsFinite
    {
        return new \PHPUnit\Framework\Constraint\IsFinite();
    }
    public static function isInfinite() : \PHPUnit\Framework\Constraint\IsInfinite
    {
        return new \PHPUnit\Framework\Constraint\IsInfinite();
    }
    public static function isNan() : \PHPUnit\Framework\Constraint\IsNan
    {
        return new \PHPUnit\Framework\Constraint\IsNan();
    }
    /**
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/3338
     */
    public static function attribute(\PHPUnit\Framework\Constraint\Constraint $constraint, string $attributeName) : \PHPUnit\Framework\Constraint\Attribute
    {
        return new \PHPUnit\Framework\Constraint\Attribute($constraint, $attributeName);
    }
    public static function contains($value, bool $checkForObjectIdentity = \true, bool $checkForNonObjectIdentity = \false) : \PHPUnit\Framework\Constraint\TraversableContains
    {
        return new \PHPUnit\Framework\Constraint\TraversableContains($value, $checkForObjectIdentity, $checkForNonObjectIdentity);
    }
    public static function containsOnly(string $type) : \PHPUnit\Framework\Constraint\TraversableContainsOnly
    {
        return new \PHPUnit\Framework\Constraint\TraversableContainsOnly($type);
    }
    public static function containsOnlyInstancesOf(string $className) : \PHPUnit\Framework\Constraint\TraversableContainsOnly
    {
        return new \PHPUnit\Framework\Constraint\TraversableContainsOnly($className, \false);
    }
    /**
     * @param int|string $key
     */
    public static function arrayHasKey($key) : \PHPUnit\Framework\Constraint\ArrayHasKey
    {
        return new \PHPUnit\Framework\Constraint\ArrayHasKey($key);
    }
    public static function equalTo($value, float $delta = 0.0, int $maxDepth = 10, bool $canonicalize = \false, bool $ignoreCase = \false) : \PHPUnit\Framework\Constraint\IsEqual
    {
        return new \PHPUnit\Framework\Constraint\IsEqual($value, $delta, $maxDepth, $canonicalize, $ignoreCase);
    }
    /**
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/3338
     */
    public static function attributeEqualTo(string $attributeName, $value, float $delta = 0.0, int $maxDepth = 10, bool $canonicalize = \false, bool $ignoreCase = \false) : \PHPUnit\Framework\Constraint\Attribute
    {
        return static::attribute(static::equalTo($value, $delta, $maxDepth, $canonicalize, $ignoreCase), $attributeName);
    }
    public static function isEmpty() : \PHPUnit\Framework\Constraint\IsEmpty
    {
        return new \PHPUnit\Framework\Constraint\IsEmpty();
    }
    public static function isWritable() : \PHPUnit\Framework\Constraint\IsWritable
    {
        return new \PHPUnit\Framework\Constraint\IsWritable();
    }
    public static function isReadable() : \PHPUnit\Framework\Constraint\IsReadable
    {
        return new \PHPUnit\Framework\Constraint\IsReadable();
    }
    public static function directoryExists() : \PHPUnit\Framework\Constraint\DirectoryExists
    {
        return new \PHPUnit\Framework\Constraint\DirectoryExists();
    }
    public static function fileExists() : \PHPUnit\Framework\Constraint\FileExists
    {
        return new \PHPUnit\Framework\Constraint\FileExists();
    }
    public static function greaterThan($value) : \PHPUnit\Framework\Constraint\GreaterThan
    {
        return new \PHPUnit\Framework\Constraint\GreaterThan($value);
    }
    public static function greaterThanOrEqual($value) : \PHPUnit\Framework\Constraint\LogicalOr
    {
        return static::logicalOr(new \PHPUnit\Framework\Constraint\IsEqual($value), new \PHPUnit\Framework\Constraint\GreaterThan($value));
    }
    public static function classHasAttribute(string $attributeName) : \PHPUnit\Framework\Constraint\ClassHasAttribute
    {
        return new \PHPUnit\Framework\Constraint\ClassHasAttribute($attributeName);
    }
    public static function classHasStaticAttribute(string $attributeName) : \PHPUnit\Framework\Constraint\ClassHasStaticAttribute
    {
        return new \PHPUnit\Framework\Constraint\ClassHasStaticAttribute($attributeName);
    }
    public static function objectHasAttribute($attributeName) : \PHPUnit\Framework\Constraint\ObjectHasAttribute
    {
        return new \PHPUnit\Framework\Constraint\ObjectHasAttribute($attributeName);
    }
    public static function identicalTo($value) : \PHPUnit\Framework\Constraint\IsIdentical
    {
        return new \PHPUnit\Framework\Constraint\IsIdentical($value);
    }
    public static function isInstanceOf(string $className) : \PHPUnit\Framework\Constraint\IsInstanceOf
    {
        return new \PHPUnit\Framework\Constraint\IsInstanceOf($className);
    }
    public static function isType(string $type) : \PHPUnit\Framework\Constraint\IsType
    {
        return new \PHPUnit\Framework\Constraint\IsType($type);
    }
    public static function lessThan($value) : \PHPUnit\Framework\Constraint\LessThan
    {
        return new \PHPUnit\Framework\Constraint\LessThan($value);
    }
    public static function lessThanOrEqual($value) : \PHPUnit\Framework\Constraint\LogicalOr
    {
        return static::logicalOr(new \PHPUnit\Framework\Constraint\IsEqual($value), new \PHPUnit\Framework\Constraint\LessThan($value));
    }
    public static function matchesRegularExpression(string $pattern) : \PHPUnit\Framework\Constraint\RegularExpression
    {
        return new \PHPUnit\Framework\Constraint\RegularExpression($pattern);
    }
    public static function matches(string $string) : \PHPUnit\Framework\Constraint\StringMatchesFormatDescription
    {
        return new \PHPUnit\Framework\Constraint\StringMatchesFormatDescription($string);
    }
    public static function stringStartsWith($prefix) : \PHPUnit\Framework\Constraint\StringStartsWith
    {
        return new \PHPUnit\Framework\Constraint\StringStartsWith($prefix);
    }
    public static function stringContains(string $string, bool $case = \true) : \PHPUnit\Framework\Constraint\StringContains
    {
        return new \PHPUnit\Framework\Constraint\StringContains($string, $case);
    }
    public static function stringEndsWith(string $suffix) : \PHPUnit\Framework\Constraint\StringEndsWith
    {
        return new \PHPUnit\Framework\Constraint\StringEndsWith($suffix);
    }
    public static function countOf(int $count) : \PHPUnit\Framework\Constraint\Count
    {
        return new \PHPUnit\Framework\Constraint\Count($count);
    }
    /**
     * Fails a test with the given message.
     *
     * @throws AssertionFailedError
     */
    public static function fail(string $message = '') : void
    {
        self::$count++;
        throw new \PHPUnit\Framework\AssertionFailedError($message);
    }
    /**
     * Returns the value of an attribute of a class or an object.
     * This also works for attributes that are declared protected or private.
     *
     * @param object|string $classOrObject
     *
     * @throws Exception
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/3338
     */
    public static function readAttribute($classOrObject, string $attributeName)
    {
        if (!self::isValidAttributeName($attributeName)) {
            throw \PHPUnit\Util\InvalidArgumentHelper::factory(2, 'valid attribute name');
        }
        if (\is_string($classOrObject)) {
            if (!\class_exists($classOrObject)) {
                throw \PHPUnit\Util\InvalidArgumentHelper::factory(1, 'class name');
            }
            return static::getStaticAttribute($classOrObject, $attributeName);
        }
        if (\is_object($classOrObject)) {
            return static::getObjectAttribute($classOrObject, $attributeName);
        }
        throw \PHPUnit\Util\InvalidArgumentHelper::factory(1, 'class name or object');
    }
    /**
     * Returns the value of a static attribute.
     * This also works for attributes that are declared protected or private.
     *
     * @throws Exception
     * @throws ReflectionException
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/3338
     */
    public static function getStaticAttribute(string $className, string $attributeName)
    {
        if (!\class_exists($className)) {
            throw \PHPUnit\Util\InvalidArgumentHelper::factory(1, 'class name');
        }
        if (!self::isValidAttributeName($attributeName)) {
            throw \PHPUnit\Util\InvalidArgumentHelper::factory(2, 'valid attribute name');
        }
        $class = new \ReflectionClass($className);
        while ($class) {
            $attributes = $class->getStaticProperties();
            if (\array_key_exists($attributeName, $attributes)) {
                return $attributes[$attributeName];
            }
            $class = $class->getParentClass();
        }
        throw new \PHPUnit\Framework\Exception(\sprintf('Attribute "%s" not found in class.', $attributeName));
    }
    /**
     * Returns the value of an object's attribute.
     * This also works for attributes that are declared protected or private.
     *
     * @param object $object
     *
     * @throws Exception
     *
     * @deprecated https://github.com/sebastianbergmann/phpunit/issues/3338
     */
    public static function getObjectAttribute($object, string $attributeName)
    {
        if (!\is_object($object)) {
            throw \PHPUnit\Util\InvalidArgumentHelper::factory(1, 'object');
        }
        if (!self::isValidAttributeName($attributeName)) {
            throw \PHPUnit\Util\InvalidArgumentHelper::factory(2, 'valid attribute name');
        }
        try {
            $reflector = new \ReflectionObject($object);
            do {
                try {
                    $attribute = $reflector->getProperty($attributeName);
                    if (!$attribute || $attribute->isPublic()) {
                        return $object->{$attributeName};
                    }
                    $attribute->setAccessible(\true);
                    $value = $attribute->getValue($object);
                    $attribute->setAccessible(\false);
                    return $value;
                } catch (\ReflectionException $e) {
                }
            } while ($reflector = $reflector->getParentClass());
        } catch (\ReflectionException $e) {
        }
        throw new \PHPUnit\Framework\Exception(\sprintf('Attribute "%s" not found in object.', $attributeName));
    }
    /**
     * Mark the test as incomplete.
     *
     * @throws IncompleteTestError
     */
    public static function markTestIncomplete(string $message = '') : void
    {
        throw new \PHPUnit\Framework\IncompleteTestError($message);
    }
    /**
     * Mark the test as skipped.
     *
     * @throws SkippedTestError
     */
    public static function markTestSkipped(string $message = '') : void
    {
        throw new \PHPUnit\Framework\SkippedTestError($message);
    }
    /**
     * Return the current assertion count.
     */
    public static function getCount() : int
    {
        return self::$count;
    }
    /**
     * Reset the assertion counter.
     */
    public static function resetCount() : void
    {
        self::$count = 0;
    }
    private static function isValidAttributeName(string $attributeName) : bool
    {
        return \preg_match('/[a-zA-Z_\\x7f-\\xff][a-zA-Z0-9_\\x7f-\\xff]*/', $attributeName);
    }
    private static function createWarning(string $warning) : void
    {
        foreach (\debug_backtrace() as $step) {
            if (isset($step['object']) && $step['object'] instanceof \PHPUnit\Framework\TestCase) {
                $step['object']->addWarning($warning);
                break;
            }
        }
    }
}
