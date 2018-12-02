<?php

namespace _PhpScoper5bf3cbdac76b4\DeepCopy\Filter\Doctrine;

use _PhpScoper5bf3cbdac76b4\DeepCopy\Filter\Filter;
use _PhpScoper5bf3cbdac76b4\DeepCopy\Reflection\ReflectionHelper;
/**
 * @final
 */
class DoctrineCollectionFilter implements \_PhpScoper5bf3cbdac76b4\DeepCopy\Filter\Filter
{
    /**
     * Copies the object property doctrine collection.
     *
     * {@inheritdoc}
     */
    public function apply($object, $property, $objectCopier)
    {
        $reflectionProperty = \_PhpScoper5bf3cbdac76b4\DeepCopy\Reflection\ReflectionHelper::getProperty($object, $property);
        $reflectionProperty->setAccessible(\true);
        $oldCollection = $reflectionProperty->getValue($object);
        $newCollection = $oldCollection->map(function ($item) use($objectCopier) {
            return $objectCopier($item);
        });
        $reflectionProperty->setValue($object, $newCollection);
    }
}
