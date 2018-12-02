<?php

/*
 * This file is part of the Prophecy.
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *     Marcello Duarte <marcello.duarte@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5bf3cbdac76b4\Prophecy\Doubler;

use ReflectionClass;
/**
 * Cached class doubler.
 * Prevents mirroring/creation of the same structure twice.
 *
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 */
class CachedDoubler extends \_PhpScoper5bf3cbdac76b4\Prophecy\Doubler\Doubler
{
    private $classes = array();
    /**
     * {@inheritdoc}
     */
    public function registerClassPatch(\_PhpScoper5bf3cbdac76b4\Prophecy\Doubler\ClassPatch\ClassPatchInterface $patch)
    {
        $this->classes[] = array();
        parent::registerClassPatch($patch);
    }
    /**
     * {@inheritdoc}
     */
    protected function createDoubleClass(\ReflectionClass $class = null, array $interfaces)
    {
        $classId = $this->generateClassId($class, $interfaces);
        if (isset($this->classes[$classId])) {
            return $this->classes[$classId];
        }
        return $this->classes[$classId] = parent::createDoubleClass($class, $interfaces);
    }
    /**
     * @param ReflectionClass   $class
     * @param ReflectionClass[] $interfaces
     *
     * @return string
     */
    private function generateClassId(\ReflectionClass $class = null, array $interfaces)
    {
        $parts = array();
        if (null !== $class) {
            $parts[] = $class->getName();
        }
        foreach ($interfaces as $interface) {
            $parts[] = $interface->getName();
        }
        \sort($parts);
        return \md5(\implode('', $parts));
    }
}
