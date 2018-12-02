<?php

namespace _PhpScoper5bf3cbdac76b4;

/**
 * Represents foo.
 */
class Foo
{
}
/**
 * @param mixed $bar
 */
function &foo($bar)
{
    $baz = function () {
    };
    $a = \true ? \true : \false;
    $b = "{$a}";
    $c = "{$b}";
}
