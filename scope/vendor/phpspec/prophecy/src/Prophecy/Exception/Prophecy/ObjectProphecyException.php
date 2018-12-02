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

use _PhpScoper5bf3cbdac76b4\Prophecy\Prophecy\ObjectProphecy;
class ObjectProphecyException extends \RuntimeException implements \_PhpScoper5bf3cbdac76b4\Prophecy\Exception\Prophecy\ProphecyException
{
    private $objectProphecy;
    public function __construct($message, \_PhpScoper5bf3cbdac76b4\Prophecy\Prophecy\ObjectProphecy $objectProphecy)
    {
        parent::__construct($message);
        $this->objectProphecy = $objectProphecy;
    }
    /**
     * @return ObjectProphecy
     */
    public function getObjectProphecy()
    {
        return $this->objectProphecy;
    }
}
