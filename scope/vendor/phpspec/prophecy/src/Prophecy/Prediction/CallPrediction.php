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
use _PhpScoper5bf3cbdac76b4\Prophecy\Argument\ArgumentsWildcard;
use _PhpScoper5bf3cbdac76b4\Prophecy\Argument\Token\AnyValuesToken;
use _PhpScoper5bf3cbdac76b4\Prophecy\Util\StringUtil;
use _PhpScoper5bf3cbdac76b4\Prophecy\Exception\Prediction\NoCallsException;
/**
 * Call prediction.
 *
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 */
class CallPrediction implements \_PhpScoper5bf3cbdac76b4\Prophecy\Prediction\PredictionInterface
{
    private $util;
    /**
     * Initializes prediction.
     *
     * @param StringUtil $util
     */
    public function __construct(\_PhpScoper5bf3cbdac76b4\Prophecy\Util\StringUtil $util = null)
    {
        $this->util = $util ?: new \_PhpScoper5bf3cbdac76b4\Prophecy\Util\StringUtil();
    }
    /**
     * Tests that there was at least one call.
     *
     * @param Call[]         $calls
     * @param ObjectProphecy $object
     * @param MethodProphecy $method
     *
     * @throws \Prophecy\Exception\Prediction\NoCallsException
     */
    public function check(array $calls, \_PhpScoper5bf3cbdac76b4\Prophecy\Prophecy\ObjectProphecy $object, \_PhpScoper5bf3cbdac76b4\Prophecy\Prophecy\MethodProphecy $method)
    {
        if (\count($calls)) {
            return;
        }
        $methodCalls = $object->findProphecyMethodCalls($method->getMethodName(), new \_PhpScoper5bf3cbdac76b4\Prophecy\Argument\ArgumentsWildcard(array(new \_PhpScoper5bf3cbdac76b4\Prophecy\Argument\Token\AnyValuesToken())));
        if (\count($methodCalls)) {
            throw new \_PhpScoper5bf3cbdac76b4\Prophecy\Exception\Prediction\NoCallsException(\sprintf("No calls have been made that match:\n" . "  %s->%s(%s)\n" . "but expected at least one.\n" . "Recorded `%s(...)` calls:\n%s", \get_class($object->reveal()), $method->getMethodName(), $method->getArgumentsWildcard(), $method->getMethodName(), $this->util->stringifyCalls($methodCalls)), $method);
        }
        throw new \_PhpScoper5bf3cbdac76b4\Prophecy\Exception\Prediction\NoCallsException(\sprintf("No calls have been made that match:\n" . "  %s->%s(%s)\n" . "but expected at least one.", \get_class($object->reveal()), $method->getMethodName(), $method->getArgumentsWildcard()), $method);
    }
}
