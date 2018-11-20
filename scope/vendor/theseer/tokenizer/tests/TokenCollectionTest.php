<?php

declare (strict_types=1);
namespace _PhpScoper5bf3cbdac76b4\TheSeer\Tokenizer;

use PHPUnit\Framework\TestCase;
/**
 * @covers \TheSeer\Tokenizer\TokenCollection
 */
class TokenCollectionTest extends \PHPUnit\Framework\TestCase
{
    /** @var  TokenCollection */
    private $collection;
    protected function setUp()
    {
        $this->collection = new \_PhpScoper5bf3cbdac76b4\TheSeer\Tokenizer\TokenCollection();
    }
    public function testCollectionIsInitiallyEmpty()
    {
        $this->assertCount(0, $this->collection);
    }
    public function testTokenCanBeAddedToCollection()
    {
        $token = $this->createMock(\_PhpScoper5bf3cbdac76b4\TheSeer\Tokenizer\Token::class);
        $this->collection->addToken($token);
        $this->assertCount(1, $this->collection);
        $this->assertSame($token, $this->collection[0]);
    }
    public function testCanIterateOverTokens()
    {
        $token = $this->createMock(\_PhpScoper5bf3cbdac76b4\TheSeer\Tokenizer\Token::class);
        $this->collection->addToken($token);
        $this->collection->addToken($token);
        foreach ($this->collection as $position => $current) {
            $this->assertInternalType('integer', $position);
            $this->assertSame($token, $current);
        }
    }
    public function testOffsetCanBeUnset()
    {
        $token = $this->createMock(\_PhpScoper5bf3cbdac76b4\TheSeer\Tokenizer\Token::class);
        $this->collection->addToken($token);
        $this->assertCount(1, $this->collection);
        unset($this->collection[0]);
        $this->assertCount(0, $this->collection);
    }
    public function testTokenCanBeSetViaOffsetPosition()
    {
        $token = $this->createMock(\_PhpScoper5bf3cbdac76b4\TheSeer\Tokenizer\Token::class);
        $this->collection[0] = $token;
        $this->assertCount(1, $this->collection);
        $this->assertSame($token, $this->collection[0]);
    }
    public function testTryingToUseNonIntegerOffsetThrowsException()
    {
        $this->expectException(\_PhpScoper5bf3cbdac76b4\TheSeer\Tokenizer\TokenCollectionException::class);
        $this->collection['foo'] = $this->createMock(\_PhpScoper5bf3cbdac76b4\TheSeer\Tokenizer\Token::class);
    }
    public function testTryingToSetNonTokenAtOffsetThrowsException()
    {
        $this->expectException(\_PhpScoper5bf3cbdac76b4\TheSeer\Tokenizer\TokenCollectionException::class);
        $this->collection[0] = 'abc';
    }
    public function testTryingToGetTokenAtNonExistingOffsetThrowsException()
    {
        $this->expectException(\_PhpScoper5bf3cbdac76b4\TheSeer\Tokenizer\TokenCollectionException::class);
        $x = $this->collection[3];
    }
}
