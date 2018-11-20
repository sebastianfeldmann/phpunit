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

use PharIo\Version\Version;
use PharIo\Version\AnyVersionConstraint;
use PHPUnit\Framework\TestCase;
/**
 * @covers \PharIo\Manifest\Manifest
 *
 * @uses \PharIo\Manifest\ApplicationName
 * @uses \PharIo\Manifest\Author
 * @uses \PharIo\Manifest\AuthorCollection
 * @uses \PharIo\Manifest\BundledComponent
 * @uses \PharIo\Manifest\BundledComponentCollection
 * @uses \PharIo\Manifest\CopyrightInformation
 * @uses \PharIo\Manifest\Email
 * @uses \PharIo\Manifest\License
 * @uses \PharIo\Manifest\RequirementCollection
 * @uses \PharIo\Manifest\PhpVersionRequirement
 * @uses \PharIo\Manifest\Type
 * @uses \PharIo\Manifest\Application
 * @uses \PharIo\Manifest\Url
 * @uses \PharIo\Version\Version
 * @uses \PharIo\Version\VersionConstraint
 */
class ManifestTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var ApplicationName
     */
    private $name;
    /**
     * @var Version
     */
    private $version;
    /**
     * @var Type
     */
    private $type;
    /**
     * @var CopyrightInformation
     */
    private $copyrightInformation;
    /**
     * @var RequirementCollection
     */
    private $requirements;
    /**
     * @var BundledComponentCollection
     */
    private $bundledComponents;
    /**
     * @var Manifest
     */
    private $manifest;
    protected function setUp()
    {
        $this->version = new \PharIo\Version\Version('5.6.5');
        $this->type = \PharIo\Manifest\Type::application();
        $author = new \PharIo\Manifest\Author('Joe Developer', new \PharIo\Manifest\Email('user@example.com'));
        $license = new \PharIo\Manifest\License('BSD-3-Clause', new \PharIo\Manifest\Url('https://github.com/sebastianbergmann/phpunit/blob/master/LICENSE'));
        $authors = new \PharIo\Manifest\AuthorCollection();
        $authors->add($author);
        $this->copyrightInformation = new \PharIo\Manifest\CopyrightInformation($authors, $license);
        $this->requirements = new \PharIo\Manifest\RequirementCollection();
        $this->requirements->add(new \PharIo\Manifest\PhpVersionRequirement(new \PharIo\Version\AnyVersionConstraint()));
        $this->bundledComponents = new \PharIo\Manifest\BundledComponentCollection();
        $this->bundledComponents->add(new \PharIo\Manifest\BundledComponent('phpunit/php-code-coverage', new \PharIo\Version\Version('4.0.2')));
        $this->name = new \PharIo\Manifest\ApplicationName('phpunit/phpunit');
        $this->manifest = new \PharIo\Manifest\Manifest($this->name, $this->version, $this->type, $this->copyrightInformation, $this->requirements, $this->bundledComponents);
    }
    public function testCanBeCreated()
    {
        $this->assertInstanceOf(\PharIo\Manifest\Manifest::class, $this->manifest);
    }
    public function testNameCanBeRetrieved()
    {
        $this->assertEquals($this->name, $this->manifest->getName());
    }
    public function testVersionCanBeRetrieved()
    {
        $this->assertEquals($this->version, $this->manifest->getVersion());
    }
    public function testTypeCanBeRetrieved()
    {
        $this->assertEquals($this->type, $this->manifest->getType());
    }
    public function testTypeCanBeQueried()
    {
        $this->assertTrue($this->manifest->isApplication());
        $this->assertFalse($this->manifest->isLibrary());
        $this->assertFalse($this->manifest->isExtension());
    }
    public function testCopyrightInformationCanBeRetrieved()
    {
        $this->assertEquals($this->copyrightInformation, $this->manifest->getCopyrightInformation());
    }
    public function testRequirementsCanBeRetrieved()
    {
        $this->assertEquals($this->requirements, $this->manifest->getRequirements());
    }
    public function testBundledComponentsCanBeRetrieved()
    {
        $this->assertEquals($this->bundledComponents, $this->manifest->getBundledComponents());
    }
    /**
     * @uses \PharIo\Manifest\Extension
     */
    public function testExtendedApplicationCanBeQueriedForExtension()
    {
        $appName = new \PharIo\Manifest\ApplicationName('foo/bar');
        $manifest = new \PharIo\Manifest\Manifest(new \PharIo\Manifest\ApplicationName('foo/foo'), new \PharIo\Version\Version('1.0.0'), \PharIo\Manifest\Type::extension($appName, new \PharIo\Version\AnyVersionConstraint()), $this->copyrightInformation, new \PharIo\Manifest\RequirementCollection(), new \PharIo\Manifest\BundledComponentCollection());
        $this->assertTrue($manifest->isExtensionFor($appName));
    }
    public function testNonExtensionReturnsFalseWhenQueriesForExtension()
    {
        $appName = new \PharIo\Manifest\ApplicationName('foo/bar');
        $manifest = new \PharIo\Manifest\Manifest(new \PharIo\Manifest\ApplicationName('foo/foo'), new \PharIo\Version\Version('1.0.0'), \PharIo\Manifest\Type::library(), $this->copyrightInformation, new \PharIo\Manifest\RequirementCollection(), new \PharIo\Manifest\BundledComponentCollection());
        $this->assertFalse($manifest->isExtensionFor($appName));
    }
    /**
     * @uses \PharIo\Manifest\Extension
     */
    public function testExtendedApplicationCanBeQueriedForExtensionWithVersion()
    {
        $appName = new \PharIo\Manifest\ApplicationName('foo/bar');
        $manifest = new \PharIo\Manifest\Manifest(new \PharIo\Manifest\ApplicationName('foo/foo'), new \PharIo\Version\Version('1.0.0'), \PharIo\Manifest\Type::extension($appName, new \PharIo\Version\AnyVersionConstraint()), $this->copyrightInformation, new \PharIo\Manifest\RequirementCollection(), new \PharIo\Manifest\BundledComponentCollection());
        $this->assertTrue($manifest->isExtensionFor($appName, new \PharIo\Version\Version('1.2.3')));
    }
}
