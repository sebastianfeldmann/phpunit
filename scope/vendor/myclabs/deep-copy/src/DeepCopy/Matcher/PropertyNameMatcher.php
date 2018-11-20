<?php

namespace _PhpScoper5bf3cbdac76b4\DeepCopy\Matcher;

/**
 * @final
 */
class PropertyNameMatcher implements \_PhpScoper5bf3cbdac76b4\DeepCopy\Matcher\Matcher
{
    /**
     * @var string
     */
    private $property;
    /**
     * @param string $property Property name
     */
    public function __construct($property)
    {
        $this->property = $property;
    }
    /**
     * Matches a property by its name.
     *
     * {@inheritdoc}
     */
    public function matches($object, $property)
    {
        return $property == $this->property;
    }
}
