<?php

namespace PharIo\Manifest;

/**
 * @covers \PharIo\Manifest\ManifestLoader
 *
 * @uses \PharIo\Manifest\Author
 * @uses \PharIo\Manifest\AuthorCollection
 * @uses \PharIo\Manifest\AuthorCollectionIterator
 * @uses \PharIo\Manifest\AuthorElement
 * @uses \PharIo\Manifest\AuthorElementCollection
 * @uses \PharIo\Manifest\ApplicationName
 * @uses \PharIo\Manifest\BundledComponent
 * @uses \PharIo\Manifest\BundledComponentCollection
 * @uses \PharIo\Manifest\BundledComponentCollectionIterator
 * @uses \PharIo\Manifest\BundlesElement
 * @uses \PharIo\Manifest\ComponentElement
 * @uses \PharIo\Manifest\ComponentElementCollection
 * @uses \PharIo\Manifest\ContainsElement
 * @uses \PharIo\Manifest\CopyrightElement
 * @uses \PharIo\Manifest\CopyrightInformation
 * @uses \PharIo\Manifest\ElementCollection
 * @uses \PharIo\Manifest\Email
 * @uses \PharIo\Manifest\ExtElement
 * @uses \PharIo\Manifest\ExtElementCollection
 * @uses \PharIo\Manifest\License
 * @uses \PharIo\Manifest\LicenseElement
 * @uses \PharIo\Manifest\Manifest
 * @uses \PharIo\Manifest\ManifestDocument
 * @uses \PharIo\Manifest\ManifestDocumentMapper
 * @uses \PharIo\Manifest\ManifestElement
 * @uses \PharIo\Manifest\ManifestLoader
 * @uses \PharIo\Manifest\PhpElement
 * @uses \PharIo\Manifest\PhpExtensionRequirement
 * @uses \PharIo\Manifest\PhpVersionRequirement
 * @uses \PharIo\Manifest\RequirementCollection
 * @uses \PharIo\Manifest\RequirementCollectionIterator
 * @uses \PharIo\Manifest\RequiresElement
 * @uses \PharIo\Manifest\Type
 * @uses \PharIo\Manifest\Url
 * @uses \PharIo\Version\Version
 * @uses \PharIo\Version\VersionConstraint
 */
class ManifestLoaderTest extends \PHPUnit\Framework\TestCase
{
    public function testCanBeLoadedFromFile()
    {
        $this->assertInstanceOf(\PharIo\Manifest\Manifest::class, \PharIo\Manifest\ManifestLoader::fromFile(__DIR__ . '/_fixture/library.xml'));
    }
    public function testCanBeLoadedFromString()
    {
        $this->assertInstanceOf(\PharIo\Manifest\Manifest::class, \PharIo\Manifest\ManifestLoader::fromString(\file_get_contents(__DIR__ . '/_fixture/library.xml')));
    }
    public function testCanBeLoadedFromPhar()
    {
        $this->assertInstanceOf(\PharIo\Manifest\Manifest::class, \PharIo\Manifest\ManifestLoader::fromPhar(__DIR__ . '/_fixture/test.phar'));
    }
    public function testLoadingNonExistingFileThrowsException()
    {
        $this->expectException(\PharIo\Manifest\ManifestLoaderException::class);
        \PharIo\Manifest\ManifestLoader::fromFile('/not/existing');
    }
    /**
     * @uses \PharIo\Manifest\ManifestDocumentLoadingException
     */
    public function testLoadingInvalidXmlThrowsException()
    {
        $this->expectException(\PharIo\Manifest\ManifestLoaderException::class);
        \PharIo\Manifest\ManifestLoader::fromString('<?xml version="1.0" ?><broken>');
    }
}
