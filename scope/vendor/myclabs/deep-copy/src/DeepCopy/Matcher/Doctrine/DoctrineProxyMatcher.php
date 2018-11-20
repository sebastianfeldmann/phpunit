<?php

namespace _PhpScoper5bf3cbdac76b4\DeepCopy\Matcher\Doctrine;

use _PhpScoper5bf3cbdac76b4\DeepCopy\Matcher\Matcher;
use _PhpScoper5bf3cbdac76b4\Doctrine\Common\Persistence\Proxy;
/**
 * @final
 */
class DoctrineProxyMatcher implements \_PhpScoper5bf3cbdac76b4\DeepCopy\Matcher\Matcher
{
    /**
     * Matches a Doctrine Proxy class.
     *
     * {@inheritdoc}
     */
    public function matches($object, $property)
    {
        return $object instanceof \_PhpScoper5bf3cbdac76b4\Doctrine\Common\Persistence\Proxy;
    }
}
