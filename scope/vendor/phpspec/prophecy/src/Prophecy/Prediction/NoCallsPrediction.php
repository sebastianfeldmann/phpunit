<?php

/*
 * This file is part of the Prophecy.
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *     Marcello Duarte <marcello.duarte@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5bf3cbdac76b4\Prophecy\Prediction;

use _PhpScoper5bf3cbdac76b4\Prophecy\Call\Call;
use _PhpScoper5bf3cbdac76b4\Prophecy\Prophecy\ObjectProphecy;
use _PhpScoper5bf3cbdac76b4\Prophecy\Prophecy\MethodProphecy;
use _PhpScoper5bf3cbdac76b4\Prophecy\Util\StringUtil;
use _PhpScoper5bf3cbdac76b4\Prophecy\Exception\Prediction\UnexpectedCallsException;
/**
 * No calls prediction.
 *
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 */
class NoCallsPrediction implements \_PhpScoper5bf3cbdac76b4\Prophecy\Prediction\PredictionInterface
{
    private $util;
    /**
     * Initializes prediction.
     *
     * @param null|StringUtil $util
     */
    public function __construct(\_PhpScoper5bf3cbdac76b4\Prophecy\Util\StringUtil $util = null)
    {
        $this->util = $util ?: new \_PhpScoper5bf3cbdac76b4\Prophecy\Util\StringUtil();
    }
    /**
     * Tests that there were no calls made.
     *
     * @param Call[]         $calls
     * @param ObjectProphecy $object
     * @param MethodProphecy $method
     *
     * @throws \Prophecy\Exception\Prediction\UnexpectedCallsException
     */
    public function check(array $calls, \_PhpScoper5bf3cbdac76b4\Prophecy\Prophecy\ObjectProphecy $object, \_PhpScoper5bf3cbdac76b4\Prophecy\Prophecy\MethodProphecy $method)
    {
        if (!\count($calls)) {
            return;
        }
        $verb = \count($calls) === 1 ? 'was' : 'were';
        throw new \_PhpScoper5bf3cbdac76b4\Prophecy\Exception\Prediction\UnexpectedCallsException(\sprintf("No calls expected that match:\n" . "  %s->%s(%s)\n" . "but %d %s made:\n%s", \get_class($object->reveal()), $method->getMethodName(), $method->getArgumentsWildcard(), \count($calls), $verb, $this->util->stringifyCalls($calls)), $method, $calls);
    }
}
