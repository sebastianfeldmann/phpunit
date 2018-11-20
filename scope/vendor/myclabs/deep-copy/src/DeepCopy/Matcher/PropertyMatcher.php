<?php

namespace _PhpScoper5bf3cbdac76b4\DeepCopy\Matcher;

/**
 * @final
 */
class PropertyMatcher implements \_PhpScoper5bf3cbdac76b4\DeepCopy\Matcher\Matcher
{
    /**
     * @var string
     */
    private $class;
    /**
     * @var string
     */
    private $property;
    /**
     * @param string $class    Class name
     * @param string $property Property name
     */
    public function __construct($class, $property)
    {
        $this->class = $class;
        $this->property = $property;
    }
    /**
     * Matches a specific property of a specific class.
     *
     * {@inheritdoc}
     */
    public function matches($object, $property)
    {
        return $object instanceof $this->class && $property == $this->property;
    }
}
