<?php

namespace _PhpScoper5bf3cbdac76b4;

/**
 * Some comment
 */
class Foo
{
    function foo()
    {
    }
    /**
     * @param Baz $baz
     */
    public function bar(\_PhpScoper5bf3cbdac76b4\Baz $baz)
    {
    }
    /**
     * @param Foobar $foobar
     */
    public static function foobar(\_PhpScoper5bf3cbdac76b4\Foobar $foobar)
    {
    }
    public function barfoo(\_PhpScoper5bf3cbdac76b4\Barfoo $barfoo)
    {
    }
    /**
     * This docblock does not belong to the baz function
     */
    public function baz()
    {
    }
    public function blaz($x, $y)
    {
    }
    public function buzz($foo)
    {
        echo "{$foo}";
        return \true;
    }
}
