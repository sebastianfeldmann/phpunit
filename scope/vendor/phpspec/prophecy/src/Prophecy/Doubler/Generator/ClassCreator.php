<?php

/*
 * This file is part of the Prophecy.
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *     Marcello Duarte <marcello.duarte@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5bf3cbdac76b4\Prophecy\Doubler\Generator;

use _PhpScoper5bf3cbdac76b4\Prophecy\Exception\Doubler\ClassCreatorException;
/**
 * Class creator.
 * Creates specific class in current environment.
 *
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 */
class ClassCreator
{
    private $generator;
    /**
     * Initializes creator.
     *
     * @param ClassCodeGenerator $generator
     */
    public function __construct(\_PhpScoper5bf3cbdac76b4\Prophecy\Doubler\Generator\ClassCodeGenerator $generator = null)
    {
        $this->generator = $generator ?: new \_PhpScoper5bf3cbdac76b4\Prophecy\Doubler\Generator\ClassCodeGenerator();
    }
    /**
     * Creates class.
     *
     * @param string         $classname
     * @param Node\ClassNode $class
     *
     * @return mixed
     *
     * @throws \Prophecy\Exception\Doubler\ClassCreatorException
     */
    public function create($classname, \_PhpScoper5bf3cbdac76b4\Prophecy\Doubler\Generator\Node\ClassNode $class)
    {
        $code = $this->generator->generate($classname, $class);
        $return = eval($code);
        if (!\class_exists($classname, \false)) {
            if (\count($class->getInterfaces())) {
                throw new \_PhpScoper5bf3cbdac76b4\Prophecy\Exception\Doubler\ClassCreatorException(\sprintf('Could not double `%s` and implement interfaces: [%s].', $class->getParentClass(), \implode(', ', $class->getInterfaces())), $class);
            }
            throw new \_PhpScoper5bf3cbdac76b4\Prophecy\Exception\Doubler\ClassCreatorException(\sprintf('Could not double `%s`.', $class->getParentClass()), $class);
        }
        return $return;
    }
}
