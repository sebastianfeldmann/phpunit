<?php

/*
 * This file is part of object-reflector.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare (strict_types=1);
namespace _PhpScoper5bf3cbdac76b4\SebastianBergmann\ObjectReflector;

use PHPUnit\Framework\TestCase;
use _PhpScoper5bf3cbdac76b4\SebastianBergmann\ObjectReflector\TestFixture\ChildClass;
use _PhpScoper5bf3cbdac76b4\SebastianBergmann\ObjectReflector\TestFixture\ClassWithIntegerAttributeName;
/**
 * @covers SebastianBergmann\ObjectReflector\ObjectReflector
 */
class ObjectReflectorTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var ObjectReflector
     */
    private $objectReflector;
    protected function setUp()
    {
        $this->objectReflector = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\ObjectReflector\ObjectReflector();
    }
    public function testReflectsAttributesOfObject()
    {
        $o = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\ObjectReflector\TestFixture\ChildClass();
        $this->assertEquals(['privateInChild' => 'private', 'protectedInChild' => 'protected', 'publicInChild' => 'public', 'undeclared' => 'undeclared', 'SebastianBergmann\\ObjectReflector\\TestFixture\\ParentClass::privateInParent' => 'private', 'SebastianBergmann\\ObjectReflector\\TestFixture\\ParentClass::protectedInParent' => 'protected', 'SebastianBergmann\\ObjectReflector\\TestFixture\\ParentClass::publicInParent' => 'public'], $this->objectReflector->getAttributes($o));
    }
    public function testReflectsAttributeWithIntegerName()
    {
        $o = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\ObjectReflector\TestFixture\ClassWithIntegerAttributeName();
        $this->assertEquals([1 => 2], $this->objectReflector->getAttributes($o));
    }
    public function testRaisesExceptionWhenPassedArgumentIsNotAnObject()
    {
        $this->expectException(\_PhpScoper5bf3cbdac76b4\SebastianBergmann\ObjectReflector\InvalidArgumentException::class);
        $this->objectReflector->getAttributes(null);
    }
}
