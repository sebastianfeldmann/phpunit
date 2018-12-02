<?php

namespace _PhpScoper5bf3cbdac76b4\DeepCopy\Filter\Doctrine;

use _PhpScoper5bf3cbdac76b4\DeepCopy\Filter\Filter;
use _PhpScoper5bf3cbdac76b4\DeepCopy\Reflection\ReflectionHelper;
use _PhpScoper5bf3cbdac76b4\Doctrine\Common\Collections\ArrayCollection;
/**
 * @final
 */
class DoctrineEmptyCollectionFilter implements \_PhpScoper5bf3cbdac76b4\DeepCopy\Filter\Filter
{
    /**
     * Sets the object property to an empty doctrine collection.
     *
     * @param object   $object
     * @param string   $property
     * @param callable $objectCopier
     */
    public function apply($object, $property, $objectCopier)
    {
        $reflectionProperty = \_PhpScoper5bf3cbdac76b4\DeepCopy\Reflection\ReflectionHelper::getProperty($object, $property);
        $reflectionProperty->setAccessible(\true);
        $reflectionProperty->setValue($object, new \_PhpScoper5bf3cbdac76b4\Doctrine\Common\Collections\ArrayCollection());
    }
}
