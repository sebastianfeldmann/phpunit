<?php

/*
 * This file is part of PharIo\Manifest.
 *
 * (c) Arne Blankerts <arne@blankerts.de>, Sebastian Heuer <sebastian@phpeople.de>, Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PharIo\Manifest;

use PHPUnit\Framework\TestCase;
class ApplicationNameTest extends \PHPUnit\Framework\TestCase
{
    public function testCanBeCreatedWithValidName()
    {
        $this->assertInstanceOf(\PharIo\Manifest\ApplicationName::class, new \PharIo\Manifest\ApplicationName('foo/bar'));
    }
    public function testUsingInvalidFormatForNameThrowsException()
    {
        $this->expectException(\PharIo\Manifest\InvalidApplicationNameException::class);
        $this->expectExceptionCode(\PharIo\Manifest\InvalidApplicationNameException::InvalidFormat);
        new \PharIo\Manifest\ApplicationName('foo');
    }
    public function testUsingWrongTypeForNameThrowsException()
    {
        $this->expectException(\PharIo\Manifest\InvalidApplicationNameException::class);
        $this->expectExceptionCode(\PharIo\Manifest\InvalidApplicationNameException::NotAString);
        new \PharIo\Manifest\ApplicationName(123);
    }
    public function testReturnsTrueForEqualNamesWhenCompared()
    {
        $app = new \PharIo\Manifest\ApplicationName('foo/bar');
        $this->assertTrue($app->isEqual($app));
    }
    public function testReturnsFalseForNonEqualNamesWhenCompared()
    {
        $app1 = new \PharIo\Manifest\ApplicationName('foo/bar');
        $app2 = new \PharIo\Manifest\ApplicationName('foo/foo');
        $this->assertFalse($app1->isEqual($app2));
    }
    public function testCanBeConvertedToString()
    {
        $this->assertEquals('foo/bar', new \PharIo\Manifest\ApplicationName('foo/bar'));
    }
}
