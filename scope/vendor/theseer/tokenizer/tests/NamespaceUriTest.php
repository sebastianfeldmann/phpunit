<?php

declare (strict_types=1);
namespace _PhpScoper5bf3cbdac76b4\TheSeer\Tokenizer;

use PHPUnit\Framework\TestCase;
/**
 * @covers \TheSeer\Tokenizer\NamespaceUri
 */
class NamespaceUriTest extends \PHPUnit\Framework\TestCase
{
    public function testCanBeConstructedWithValidNamespace()
    {
        $this->assertInstanceOf(\_PhpScoper5bf3cbdac76b4\TheSeer\Tokenizer\NamespaceUri::class, new \_PhpScoper5bf3cbdac76b4\TheSeer\Tokenizer\NamespaceUri('a:b'));
    }
    public function testInvalidNamespaceThrowsException()
    {
        $this->expectException(\_PhpScoper5bf3cbdac76b4\TheSeer\Tokenizer\NamespaceUriException::class);
        new \_PhpScoper5bf3cbdac76b4\TheSeer\Tokenizer\NamespaceUri('invalid-no-colon');
    }
    public function testStringRepresentationCanBeRetrieved()
    {
        $this->assertEquals('a:b', (new \_PhpScoper5bf3cbdac76b4\TheSeer\Tokenizer\NamespaceUri('a:b'))->asString());
    }
}
