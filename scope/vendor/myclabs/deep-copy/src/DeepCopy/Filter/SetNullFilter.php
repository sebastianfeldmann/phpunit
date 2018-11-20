<?php

namespace _PhpScoper5bf3cbdac76b4\DeepCopy\Filter;

use _PhpScoper5bf3cbdac76b4\DeepCopy\Reflection\ReflectionHelper;
/**
 * @final
 */
class SetNullFilter implements \_PhpScoper5bf3cbdac76b4\DeepCopy\Filter\Filter
{
    /**
     * Sets the object property to null.
     *
     * {@inheritdoc}
     */
    public function apply($object, $property, $objectCopier)
    {
        $reflectionProperty = \_PhpScoper5bf3cbdac76b4\DeepCopy\Reflection\ReflectionHelper::getProperty($object, $property);
        $reflectionProperty->setAccessible(\true);
        $reflectionProperty->setValue($object, null);
    }
}
