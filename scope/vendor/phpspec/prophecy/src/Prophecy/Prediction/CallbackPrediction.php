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
use _PhpScoper5bf3cbdac76b4\Prophecy\Exception\InvalidArgumentException;
use Closure;
/**
 * Callback prediction.
 *
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 */
class CallbackPrediction implements \_PhpScoper5bf3cbdac76b4\Prophecy\Prediction\PredictionInterface
{
    private $callback;
    /**
     * Initializes callback prediction.
     *
     * @param callable $callback Custom callback
     *
     * @throws \Prophecy\Exception\InvalidArgumentException
     */
    public function __construct($callback)
    {
        if (!\is_callable($callback)) {
            throw new \_PhpScoper5bf3cbdac76b4\Prophecy\Exception\InvalidArgumentException(\sprintf('Callable expected as an argument to CallbackPrediction, but got %s.', \gettype($callback)));
        }
        $this->callback = $callback;
    }
    /**
     * Executes preset callback.
     *
     * @param Call[]         $calls
     * @param ObjectProphecy $object
     * @param MethodProphecy $method
     */
    public function check(array $calls, \_PhpScoper5bf3cbdac76b4\Prophecy\Prophecy\ObjectProphecy $object, \_PhpScoper5bf3cbdac76b4\Prophecy\Prophecy\MethodProphecy $method)
    {
        $callback = $this->callback;
        if ($callback instanceof \Closure && \method_exists('Closure', 'bind')) {
            $callback = \Closure::bind($callback, $object);
        }
        \call_user_func($callback, $calls, $object, $method);
    }
}
