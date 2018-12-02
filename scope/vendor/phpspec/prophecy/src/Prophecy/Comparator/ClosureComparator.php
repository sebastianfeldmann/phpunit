<?php

/*
 * This file is part of the Prophecy.
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *     Marcello Duarte <marcello.duarte@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5bf3cbdac76b4\Prophecy\Comparator;

use _PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\Comparator;
use _PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\ComparisonFailure;
/**
 * Closure comparator.
 *
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 */
final class ClosureComparator extends \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\Comparator
{
    public function accepts($expected, $actual)
    {
        return \is_object($expected) && $expected instanceof \Closure && \is_object($actual) && $actual instanceof \Closure;
    }
    public function assertEquals($expected, $actual, $delta = 0.0, $canonicalize = \false, $ignoreCase = \false)
    {
        throw new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\ComparisonFailure(
            $expected,
            $actual,
            // we don't need a diff
            '',
            '',
            \false,
            'all closures are born different'
        );
    }
}
