<?php

namespace _PhpScoper5bf3cbdac76b4\DeepCopy\Filter;

use _PhpScoper5bf3cbdac76b4\DeepCopy\Reflection\ReflectionHelper;
/**
 * @final
 */
class ReplaceFilter implements \_PhpScoper5bf3cbdac76b4\DeepCopy\Filter\Filter
{
    /**
     * @var callable
     */
    protected $callback;
    /**
     * @param callable $callable Will be called to get the new value for each property to replace
     */
    public function __construct(callable $callable)
    {
        $this->callback = $callable;
    }
    /**
     * Replaces the object property by the result of the callback called with the object property.
     *
     * {@inheritdoc}
     */
    public function apply($object, $property, $objectCopier)
    {
        $reflectionProperty = \_PhpScoper5bf3cbdac76b4\DeepCopy\Reflection\ReflectionHelper::getProperty($object, $property);
        $reflectionProperty->setAccessible(\true);
        $value = \call_user_func($this->callback, $reflectionProperty->getValue($object));
        $reflectionProperty->setValue($object, $value);
    }
}
