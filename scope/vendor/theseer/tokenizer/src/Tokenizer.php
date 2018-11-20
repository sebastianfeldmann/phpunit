<?php

declare (strict_types=1);
namespace _PhpScoper5bf3cbdac76b4\TheSeer\Tokenizer;

class Tokenizer
{
    /**
     * Token Map for "non-tokens"
     *
     * @var array
     */
    private $map = ['(' => 'T_OPEN_BRACKET', ')' => 'T_CLOSE_BRACKET', '[' => 'T_OPEN_SQUARE', ']' => 'T_CLOSE_SQUARE', '{' => 'T_OPEN_CURLY', '}' => 'T_CLOSE_CURLY', ';' => 'T_SEMICOLON', '.' => 'T_DOT', ',' => 'T_COMMA', '=' => 'T_EQUAL', '<' => 'T_LT', '>' => 'T_GT', '+' => 'T_PLUS', '-' => 'T_MINUS', '*' => 'T_MULT', '/' => 'T_DIV', '?' => 'T_QUESTION_MARK', '!' => 'T_EXCLAMATION_MARK', ':' => 'T_COLON', '"' => 'T_DOUBLE_QUOTES', '@' => 'T_AT', '&' => 'T_AMPERSAND', '%' => 'T_PERCENT', '|' => 'T_PIPE', '$' => 'T_DOLLAR', '^' => 'T_CARET', '~' => 'T_TILDE', '`' => 'T_BACKTICK'];
    public function parse(string $source) : \_PhpScoper5bf3cbdac76b4\TheSeer\Tokenizer\TokenCollection
    {
        $result = new \_PhpScoper5bf3cbdac76b4\TheSeer\Tokenizer\TokenCollection();
        $tokens = \token_get_all($source);
        $lastToken = new \_PhpScoper5bf3cbdac76b4\TheSeer\Tokenizer\Token($tokens[0][2], 'Placeholder', '');
        foreach ($tokens as $pos => $tok) {
            if (\is_string($tok)) {
                $token = new \_PhpScoper5bf3cbdac76b4\TheSeer\Tokenizer\Token($lastToken->getLine(), $this->map[$tok], $tok);
                $result->addToken($token);
                $lastToken = $token;
                continue;
            }
            $line = $tok[2];
            $values = \preg_split('/\\R+/Uu', $tok[1]);
            foreach ($values as $v) {
                $token = new \_PhpScoper5bf3cbdac76b4\TheSeer\Tokenizer\Token($line, \token_name($tok[0]), $v);
                $result->addToken($token);
                $line++;
                $lastToken = $token;
            }
        }
        return $result;
    }
}
