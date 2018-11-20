<?php

/*
 * This file is part of the Prophecy.
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *     Marcello Duarte <marcello.duarte@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5bf3cbdac76b4\Prophecy\Exception\Call;

use _PhpScoper5bf3cbdac76b4\Prophecy\Exception\Prophecy\ObjectProphecyException;
use _PhpScoper5bf3cbdac76b4\Prophecy\Prophecy\ObjectProphecy;
class UnexpectedCallException extends \_PhpScoper5bf3cbdac76b4\Prophecy\Exception\Prophecy\ObjectProphecyException
{
    private $methodName;
    private $arguments;
    public function __construct($message, \_PhpScoper5bf3cbdac76b4\Prophecy\Prophecy\ObjectProphecy $objectProphecy, $methodName, array $arguments)
    {
        parent::__construct($message, $objectProphecy);
        $this->methodName = $methodName;
        $this->arguments = $arguments;
    }
    public function getMethodName()
    {
        return $this->methodName;
    }
    public function getArguments()
    {
        return $this->arguments;
    }
}
