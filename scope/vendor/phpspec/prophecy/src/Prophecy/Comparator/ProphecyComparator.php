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

use _PhpScoper5bf3cbdac76b4\Prophecy\Prophecy\ProphecyInterface;
use _PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\ObjectComparator;
class ProphecyComparator extends \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\ObjectComparator
{
    public function accepts($expected, $actual)
    {
        return \is_object($expected) && \is_object($actual) && $actual instanceof \_PhpScoper5bf3cbdac76b4\Prophecy\Prophecy\ProphecyInterface;
    }
    public function assertEquals($expected, $actual, $delta = 0.0, $canonicalize = \false, $ignoreCase = \false, array &$processed = array())
    {
        parent::assertEquals($expected, $actual->reveal(), $delta, $canonicalize, $ignoreCase, $processed);
    }
}
