<?php

namespace _PhpScoper5bf3cbdac76b4\DeepCopy;

use function function_exists;
if (\false === \function_exists('_PhpScoper5bf3cbdac76b4\\DeepCopy\\deep_copy')) {
    /**
     * Deep copies the given value.
     *
     * @param mixed $value
     * @param bool  $useCloneMethod
     *
     * @return mixed
     */
    function deep_copy($value, $useCloneMethod = \false)
    {
        return (new \_PhpScoper5bf3cbdac76b4\DeepCopy\DeepCopy($useCloneMethod))->copy($value);
    }
}
