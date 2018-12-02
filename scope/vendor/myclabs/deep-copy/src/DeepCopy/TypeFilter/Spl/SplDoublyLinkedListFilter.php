<?php

namespace _PhpScoper5bf3cbdac76b4\DeepCopy\TypeFilter\Spl;

use Closure;
use _PhpScoper5bf3cbdac76b4\DeepCopy\DeepCopy;
use _PhpScoper5bf3cbdac76b4\DeepCopy\TypeFilter\TypeFilter;
use SplDoublyLinkedList;
/**
 * @final
 */
class SplDoublyLinkedListFilter implements \_PhpScoper5bf3cbdac76b4\DeepCopy\TypeFilter\TypeFilter
{
    private $copier;
    public function __construct(\_PhpScoper5bf3cbdac76b4\DeepCopy\DeepCopy $copier)
    {
        $this->copier = $copier;
    }
    /**
     * {@inheritdoc}
     */
    public function apply($element)
    {
        $newElement = clone $element;
        $copy = $this->createCopyClosure();
        return $copy($newElement);
    }
    private function createCopyClosure()
    {
        $copier = $this->copier;
        $copy = function (\SplDoublyLinkedList $list) use($copier) {
            // Replace each element in the list with a deep copy of itself
            for ($i = 1; $i <= $list->count(); $i++) {
                $copy = $copier->recursiveCopy($list->shift());
                $list->push($copy);
            }
            return $list;
        };
        return \Closure::bind($copy, null, \_PhpScoper5bf3cbdac76b4\DeepCopy\DeepCopy::class);
    }
}
