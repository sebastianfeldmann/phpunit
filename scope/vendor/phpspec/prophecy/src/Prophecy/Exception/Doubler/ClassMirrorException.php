<?php

/*
 * This file is part of the Prophecy.
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *     Marcello Duarte <marcello.duarte@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5bf3cbdac76b4\Prophecy\Exception\Doubler;

use ReflectionClass;
class ClassMirrorException extends \RuntimeException implements \_PhpScoper5bf3cbdac76b4\Prophecy\Exception\Doubler\DoublerException
{
    private $class;
    public function __construct($message, \ReflectionClass $class)
    {
        parent::__construct($message);
        $this->class = $class;
    }
    public function getReflectedClass()
    {
        return $this->class;
    }
}
