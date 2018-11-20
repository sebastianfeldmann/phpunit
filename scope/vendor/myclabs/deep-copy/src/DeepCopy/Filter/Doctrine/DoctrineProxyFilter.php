<?php

namespace _PhpScoper5bf3cbdac76b4\DeepCopy\Filter\Doctrine;

use _PhpScoper5bf3cbdac76b4\DeepCopy\Filter\Filter;
/**
 * @final
 */
class DoctrineProxyFilter implements \_PhpScoper5bf3cbdac76b4\DeepCopy\Filter\Filter
{
    /**
     * Triggers the magic method __load() on a Doctrine Proxy class to load the
     * actual entity from the database.
     *
     * {@inheritdoc}
     */
    public function apply($object, $property, $objectCopier)
    {
        $object->__load();
    }
}
