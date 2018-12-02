<?php

declare (strict_types=1);
namespace _PhpScoper5bf3cbdac76b4\TheSeer\Tokenizer;

use PHPUnit\Framework\TestCase;
/**
 * @covers \TheSeer\Tokenizer\XMLSerializer
 */
class XMLSerializerTest extends \PHPUnit\Framework\TestCase
{
    /** @var TokenCollection $tokens */
    private $tokens;
    protected function setUp()
    {
        $this->tokens = \unserialize(\file_get_contents(__DIR__ . '/_files/test.php.tokens'), [\_PhpScoper5bf3cbdac76b4\TheSeer\Tokenizer\TokenCollection::class]);
    }
    public function testCanBeSerializedToXml()
    {
        $expected = \file_get_contents(__DIR__ . '/_files/test.php.xml');
        $serializer = new \_PhpScoper5bf3cbdac76b4\TheSeer\Tokenizer\XMLSerializer();
        $this->assertEquals($expected, $serializer->toXML($this->tokens));
    }
    public function testCanBeSerializedToDomDocument()
    {
        $serializer = new \_PhpScoper5bf3cbdac76b4\TheSeer\Tokenizer\XMLSerializer();
        $result = $serializer->toDom($this->tokens);
        $this->assertInstanceOf(\DOMDocument::class, $result);
        $this->assertEquals('source', $result->documentElement->localName);
    }
    public function testCanBeSerializedToXmlWithCustomNamespace()
    {
        $expected = \file_get_contents(__DIR__ . '/_files/customns.xml');
        $serializer = new \_PhpScoper5bf3cbdac76b4\TheSeer\Tokenizer\XMLSerializer(new \_PhpScoper5bf3cbdac76b4\TheSeer\Tokenizer\NamespaceUri('custom:xml:namespace'));
        $this->assertEquals($expected, $serializer->toXML($this->tokens));
    }
}
