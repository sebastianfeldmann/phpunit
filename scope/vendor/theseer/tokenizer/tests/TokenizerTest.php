<?php

declare (strict_types=1);
namespace _PhpScoper5bf3cbdac76b4\TheSeer\Tokenizer;

use PHPUnit\Framework\TestCase;
/**
 * @covers \TheSeer\Tokenizer\Tokenizer
 */
class TokenizerTest extends \PHPUnit\Framework\TestCase
{
    public function testValidSourceGetsParsed()
    {
        $tokenizer = new \_PhpScoper5bf3cbdac76b4\TheSeer\Tokenizer\Tokenizer();
        $result = $tokenizer->parse(\file_get_contents(__DIR__ . '/_files/test.php'));
        $expected = \unserialize(\file_get_contents(__DIR__ . '/_files/test.php.tokens'), [\_PhpScoper5bf3cbdac76b4\TheSeer\Tokenizer\TokenCollection::class]);
        $this->assertEquals($expected, $result);
    }
}
