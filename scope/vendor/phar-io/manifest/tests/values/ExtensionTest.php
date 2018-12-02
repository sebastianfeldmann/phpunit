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

use PharIo\Version\AnyVersionConstraint;
use PharIo\Version\Version;
use PharIo\Version\VersionConstraint;
use PharIo\Version\VersionConstraintParser;
use PHPUnit\Framework\TestCase;
/**
 * @covers \PharIo\Manifest\Extension
 * @covers \PharIo\Manifest\Type
 *
 * @uses \PharIo\Version\VersionConstraint
 * @uses \PharIo\Manifest\ApplicationName
 */
class ExtensionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Extension
     */
    private $type;
    /**
     * @var ApplicationName|\PHPUnit_Framework_MockObject_MockObject
     */
    private $name;
    protected function setUp()
    {
        $this->name = $this->createMock(\PharIo\Manifest\ApplicationName::class);
        $this->type = \PharIo\Manifest\Type::extension($this->name, new \PharIo\Version\AnyVersionConstraint());
    }
    public function testCanBeCreated()
    {
        $this->assertInstanceOf(\PharIo\Manifest\Extension::class, $this->type);
    }
    public function testIsNotApplication()
    {
        $this->assertFalse($this->type->isApplication());
    }
    public function testIsNotLibrary()
    {
        $this->assertFalse($this->type->isLibrary());
    }
    public function testIsExtension()
    {
        $this->assertTrue($this->type->isExtension());
    }
    public function testApplicationCanBeRetrieved()
    {
        $this->assertInstanceOf(\PharIo\Manifest\ApplicationName::class, $this->type->getApplicationName());
    }
    public function testVersionConstraintCanBeRetrieved()
    {
        $this->assertInstanceOf(\PharIo\Version\VersionConstraint::class, $this->type->getVersionConstraint());
    }
    public function testApplicationCanBeQueried()
    {
        $this->name->method('isEqual')->willReturn(\true);
        $this->assertTrue($this->type->isExtensionFor($this->createMock(\PharIo\Manifest\ApplicationName::class)));
    }
    public function testCompatibleWithReturnsTrueForMatchingVersionConstraintAndApplicaiton()
    {
        $app = new \PharIo\Manifest\ApplicationName('foo/bar');
        $extension = \PharIo\Manifest\Type::extension($app, (new \PharIo\Version\VersionConstraintParser())->parse('^1.0'));
        $version = new \PharIo\Version\Version('1.0.0');
        $this->assertTrue($extension->isCompatibleWith($app, $version));
    }
    public function testCompatibleWithReturnsFalseForNotMatchingVersionConstraint()
    {
        $app = new \PharIo\Manifest\ApplicationName('foo/bar');
        $extension = \PharIo\Manifest\Type::extension($app, (new \PharIo\Version\VersionConstraintParser())->parse('^1.0'));
        $version = new \PharIo\Version\Version('2.0.0');
        $this->assertFalse($extension->isCompatibleWith($app, $version));
    }
    public function testCompatibleWithReturnsFalseForNotMatchingApplication()
    {
        $app1 = new \PharIo\Manifest\ApplicationName('foo/bar');
        $app2 = new \PharIo\Manifest\ApplicationName('foo/foo');
        $extension = \PharIo\Manifest\Type::extension($app1, (new \PharIo\Version\VersionConstraintParser())->parse('^1.0'));
        $version = new \PharIo\Version\Version('1.0.0');
        $this->assertFalse($extension->isCompatibleWith($app2, $version));
    }
}
