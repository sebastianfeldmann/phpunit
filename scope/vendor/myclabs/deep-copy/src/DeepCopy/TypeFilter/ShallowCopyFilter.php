<?php

namespace _PhpScoper5bf3cbdac76b4\DeepCopy\TypeFilter;

/**
 * @final
 */
class ShallowCopyFilter implements \_PhpScoper5bf3cbdac76b4\DeepCopy\TypeFilter\TypeFilter
{
    /**
     * {@inheritdoc}
     */
    public function apply($element)
    {
        return clone $element;
    }
}
