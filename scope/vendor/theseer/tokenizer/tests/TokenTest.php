<?php

declare (strict_types=1);
namespace _PhpScoper5bf3cbdac76b4\TheSeer\Tokenizer;

use PHPUnit\Framework\TestCase;
class TokenTest extends \PHPUnit\Framework\TestCase
{
    /** @var  Token */
    private $token;
    protected function setUp()
    {
        $this->token = new \_PhpScoper5bf3cbdac76b4\TheSeer\Tokenizer\Token(1, 'test-dummy', 'blank');
    }
    public function testTokenCanBeCreated()
    {
        $this->assertInstanceOf(\_PhpScoper5bf3cbdac76b4\TheSeer\Tokenizer\Token::class, $this->token);
    }
    public function testTokenLineCanBeRetrieved()
    {
        $this->assertEquals(1, $this->token->getLine());
    }
    public function testTokenNameCanBeRetrieved()
    {
        $this->assertEquals('test-dummy', $this->token->getName());
    }
    public function testTokenValueCanBeRetrieved()
    {
        $this->assertEquals('blank', $this->token->getValue());
    }
}
