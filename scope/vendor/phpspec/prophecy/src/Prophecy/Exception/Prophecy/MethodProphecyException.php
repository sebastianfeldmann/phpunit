<?php

/*
 * This file is part of the Prophecy.
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *     Marcello Duarte <marcello.duarte@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5bf3cbdac76b4\Prophecy\Exception\Prophecy;

use _PhpScoper5bf3cbdac76b4\Prophecy\Prophecy\MethodProphecy;
class MethodProphecyException extends \_PhpScoper5bf3cbdac76b4\Prophecy\Exception\Prophecy\ObjectProphecyException
{
    private $methodProphecy;
    public function __construct($message, \_PhpScoper5bf3cbdac76b4\Prophecy\Prophecy\MethodProphecy $methodProphecy)
    {
        parent::__construct($message, $methodProphecy->getObjectProphecy());
        $this->methodProphecy = $methodProphecy;
    }
    /**
     * @return MethodProphecy
     */
    public function getMethodProphecy()
    {
        return $this->methodProphecy;
    }
}
