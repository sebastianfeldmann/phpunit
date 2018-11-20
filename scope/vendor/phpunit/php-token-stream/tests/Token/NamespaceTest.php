<?php

namespace _PhpScoper5bf3cbdac76b4;

/*
 * This file is part of php-token-stream.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
use PHPUnit\Framework\TestCase;
class PHP_Token_NamespaceTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers PHP_Token_NAMESPACE::getName
     */
    public function testGetName()
    {
        $tokenStream = new \_PhpScoper5bf3cbdac76b4\PHP_Token_Stream(\TEST_FILES_PATH . 'classInNamespace.php');
        foreach ($tokenStream as $token) {
            if ($token instanceof \_PhpScoper5bf3cbdac76b4\PHP_Token_NAMESPACE) {
                $this->assertSame('_PhpScoper5bf3cbdac76b4\\Foo\\Bar', $token->getName());
            }
        }
    }
    public function testGetStartLineWithUnscopedNamespace()
    {
        $tokenStream = new \_PhpScoper5bf3cbdac76b4\PHP_Token_Stream(\TEST_FILES_PATH . 'classInNamespace.php');
        foreach ($tokenStream as $token) {
            if ($token instanceof \_PhpScoper5bf3cbdac76b4\PHP_Token_NAMESPACE) {
                $this->assertSame(2, $token->getLine());
            }
        }
    }
    public function testGetEndLineWithUnscopedNamespace()
    {
        $tokenStream = new \_PhpScoper5bf3cbdac76b4\PHP_Token_Stream(\TEST_FILES_PATH . 'classInNamespace.php');
        foreach ($tokenStream as $token) {
            if ($token instanceof \_PhpScoper5bf3cbdac76b4\PHP_Token_NAMESPACE) {
                $this->assertSame(2, $token->getEndLine());
            }
        }
    }
    public function testGetStartLineWithScopedNamespace()
    {
        $tokenStream = new \_PhpScoper5bf3cbdac76b4\PHP_Token_Stream(\TEST_FILES_PATH . 'classInScopedNamespace.php');
        foreach ($tokenStream as $token) {
            if ($token instanceof \_PhpScoper5bf3cbdac76b4\PHP_Token_NAMESPACE) {
                $this->assertSame(2, $token->getLine());
            }
        }
    }
    public function testGetEndLineWithScopedNamespace()
    {
        $tokenStream = new \_PhpScoper5bf3cbdac76b4\PHP_Token_Stream(\TEST_FILES_PATH . 'classInScopedNamespace.php');
        foreach ($tokenStream as $token) {
            if ($token instanceof \_PhpScoper5bf3cbdac76b4\PHP_Token_NAMESPACE) {
                $this->assertSame(8, $token->getEndLine());
            }
        }
    }
}
\class_alias('_PhpScoper5bf3cbdac76b4\\PHP_Token_NamespaceTest', 'PHP_Token_NamespaceTest', \false);
