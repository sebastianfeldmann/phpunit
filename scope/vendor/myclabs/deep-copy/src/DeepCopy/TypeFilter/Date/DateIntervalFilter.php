<?php

namespace _PhpScoper5bf3cbdac76b4\DeepCopy\TypeFilter\Date;

use DateInterval;
use _PhpScoper5bf3cbdac76b4\DeepCopy\TypeFilter\TypeFilter;
/**
 * @final
 *
 * @deprecated Will be removed in 2.0. This filter will no longer be necessary in PHP 7.1+.
 */
class DateIntervalFilter implements \_PhpScoper5bf3cbdac76b4\DeepCopy\TypeFilter\TypeFilter
{
    /**
     * {@inheritdoc}
     *
     * @param DateInterval $element
     *
     * @see http://news.php.net/php.bugs/205076
     */
    public function apply($element)
    {
        $copy = new \DateInterval('P0D');
        foreach ($element as $propertyName => $propertyValue) {
            $copy->{$propertyName} = $propertyValue;
        }
        return $copy;
    }
}
