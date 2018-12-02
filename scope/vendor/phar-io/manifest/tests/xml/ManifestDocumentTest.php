<?php

namespace PharIo\Manifest;

class ManifestDocumentTest extends \PHPUnit\Framework\TestCase
{
    public function testThrowsExceptionWhenFileDoesNotExist()
    {
        $this->expectException(\PharIo\Manifest\ManifestDocumentException::class);
        \PharIo\Manifest\ManifestDocument::fromFile('/does/not/exist');
    }
    public function testCanBeCreatedFromFile()
    {
        $this->assertInstanceOf(\PharIo\Manifest\ManifestDocument::class, \PharIo\Manifest\ManifestDocument::fromFile(__DIR__ . '/../_fixture/phpunit-5.6.5.xml'));
    }
    public function testCaneBeConstructedFromString()
    {
        $content = \file_get_contents(__DIR__ . '/../_fixture/phpunit-5.6.5.xml');
        $this->assertInstanceOf(\PharIo\Manifest\ManifestDocument::class, \PharIo\Manifest\ManifestDocument::fromString($content));
    }
    public function testThrowsExceptionOnInvalidXML()
    {
        $this->expectException(\PharIo\Manifest\ManifestDocumentLoadingException::class);
        \PharIo\Manifest\ManifestDocument::fromString('<?xml version="1.0" ?><root>');
    }
    public function testLoadingDocumentWithWrongRootNameThrowsException()
    {
        $this->expectException(\PharIo\Manifest\ManifestDocumentException::class);
        \PharIo\Manifest\ManifestDocument::fromString('<?xml version="1.0" ?><root />');
    }
    public function testLoadingDocumentWithWrongNamespaceThrowsException()
    {
        $this->expectException(\PharIo\Manifest\ManifestDocumentException::class);
        \PharIo\Manifest\ManifestDocument::fromString('<?xml version="1.0" ?><phar xmlns="foo:bar" />');
    }
    public function testContainsElementCanBeRetrieved()
    {
        $this->assertInstanceOf(\PharIo\Manifest\ContainsElement::class, $this->loadFixture()->getContainsElement());
    }
    public function testRequiresElementCanBeRetrieved()
    {
        $this->assertInstanceOf(\PharIo\Manifest\RequiresElement::class, $this->loadFixture()->getRequiresElement());
    }
    public function testCopyrightElementCanBeRetrieved()
    {
        $this->assertInstanceOf(\PharIo\Manifest\CopyrightElement::class, $this->loadFixture()->getCopyrightElement());
    }
    public function testBundlesElementCanBeRetrieved()
    {
        $this->assertInstanceOf(\PharIo\Manifest\BundlesElement::class, $this->loadFixture()->getBundlesElement());
    }
    public function testThrowsExceptionWhenContainsIsMissing()
    {
        $this->expectException(\PharIo\Manifest\ManifestDocumentException::class);
        $this->loadEmptyFixture()->getContainsElement();
    }
    public function testThrowsExceptionWhenCopyirhgtIsMissing()
    {
        $this->expectException(\PharIo\Manifest\ManifestDocumentException::class);
        $this->loadEmptyFixture()->getCopyrightElement();
    }
    public function testThrowsExceptionWhenRequiresIsMissing()
    {
        $this->expectException(\PharIo\Manifest\ManifestDocumentException::class);
        $this->loadEmptyFixture()->getRequiresElement();
    }
    public function testThrowsExceptionWhenBundlesIsMissing()
    {
        $this->expectException(\PharIo\Manifest\ManifestDocumentException::class);
        $this->loadEmptyFixture()->getBundlesElement();
    }
    public function testHasBundlesReturnsTrueWhenBundlesNodeIsPresent()
    {
        $this->assertTrue($this->loadFixture()->hasBundlesElement());
    }
    public function testHasBundlesReturnsFalseWhenBundlesNoNodeIsPresent()
    {
        $this->assertFalse($this->loadEmptyFixture()->hasBundlesElement());
    }
    private function loadFixture()
    {
        return \PharIo\Manifest\ManifestDocument::fromFile(__DIR__ . '/../_fixture/phpunit-5.6.5.xml');
    }
    private function loadEmptyFixture()
    {
        return \PharIo\Manifest\ManifestDocument::fromString('<?xml version="1.0" ?><phar xmlns="https://phar.io/xml/manifest/1.0" />');
    }
}
