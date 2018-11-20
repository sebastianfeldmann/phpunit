<?php

/*
 * This file is part of the Prophecy.
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *     Marcello Duarte <marcello.duarte@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5bf3cbdac76b4\Prophecy\Exception\Prediction;

use _PhpScoper5bf3cbdac76b4\Prophecy\Prophecy\MethodProphecy;
use _PhpScoper5bf3cbdac76b4\Prophecy\Exception\Prophecy\MethodProphecyException;
class UnexpectedCallsException extends \_PhpScoper5bf3cbdac76b4\Prophecy\Exception\Prophecy\MethodProphecyException implements \_PhpScoper5bf3cbdac76b4\Prophecy\Exception\Prediction\PredictionException
{
    private $calls = array();
    public function __construct($message, \_PhpScoper5bf3cbdac76b4\Prophecy\Prophecy\MethodProphecy $methodProphecy, array $calls)
    {
        parent::__construct($message, $methodProphecy);
        $this->calls = $calls;
    }
    public function getCalls()
    {
        return $this->calls;
    }
}
