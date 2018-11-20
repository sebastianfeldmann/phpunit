<?php

/*
 * This file is part of the Prophecy.
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *     Marcello Duarte <marcello.duarte@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5bf3cbdac76b4\Prophecy\Promise;

use _PhpScoper5bf3cbdac76b4\Prophecy\Exception\InvalidArgumentException;
use _PhpScoper5bf3cbdac76b4\Prophecy\Prophecy\ObjectProphecy;
use _PhpScoper5bf3cbdac76b4\Prophecy\Prophecy\MethodProphecy;
/**
 * Return argument promise.
 *
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 */
class ReturnArgumentPromise implements \_PhpScoper5bf3cbdac76b4\Prophecy\Promise\PromiseInterface
{
    /**
     * @var int
     */
    private $index;
    /**
     * Initializes callback promise.
     *
     * @param int $index The zero-indexed number of the argument to return
     *
     * @throws \Prophecy\Exception\InvalidArgumentException
     */
    public function __construct($index = 0)
    {
        if (!\is_int($index) || $index < 0) {
            throw new \_PhpScoper5bf3cbdac76b4\Prophecy\Exception\InvalidArgumentException(\sprintf('Zero-based index expected as argument to ReturnArgumentPromise, but got %s.', $index));
        }
        $this->index = $index;
    }
    /**
     * Returns nth argument if has one, null otherwise.
     *
     * @param array          $args
     * @param ObjectProphecy $object
     * @param MethodProphecy $method
     *
     * @return null|mixed
     */
    public function execute(array $args, \_PhpScoper5bf3cbdac76b4\Prophecy\Prophecy\ObjectProphecy $object, \_PhpScoper5bf3cbdac76b4\Prophecy\Prophecy\MethodProphecy $method)
    {
        return \count($args) > $this->index ? $args[$this->index] : null;
    }
}
