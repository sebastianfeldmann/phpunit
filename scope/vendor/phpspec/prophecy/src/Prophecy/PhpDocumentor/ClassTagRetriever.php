<?php

/*
 * This file is part of the Prophecy.
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *     Marcello Duarte <marcello.duarte@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5bf3cbdac76b4\Prophecy\PhpDocumentor;

use _PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\DocBlock\Tags\Method;
use _PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\DocBlockFactory;
use _PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\Types\ContextFactory;
/**
 * @author Théo FIDRY <theo.fidry@gmail.com>
 *
 * @internal
 */
final class ClassTagRetriever implements \_PhpScoper5bf3cbdac76b4\Prophecy\PhpDocumentor\MethodTagRetrieverInterface
{
    private $docBlockFactory;
    private $contextFactory;
    public function __construct()
    {
        $this->docBlockFactory = \_PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\DocBlockFactory::createInstance();
        $this->contextFactory = new \_PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\Types\ContextFactory();
    }
    /**
     * @param \ReflectionClass $reflectionClass
     *
     * @return Method[]
     */
    public function getTagList(\ReflectionClass $reflectionClass)
    {
        try {
            $phpdoc = $this->docBlockFactory->create($reflectionClass, $this->contextFactory->createFromReflector($reflectionClass));
            return $phpdoc->getTagsByName('method');
        } catch (\InvalidArgumentException $e) {
            return array();
        }
    }
}
