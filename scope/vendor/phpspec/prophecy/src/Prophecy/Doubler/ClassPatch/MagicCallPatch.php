<?php

/*
 * This file is part of the Prophecy.
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *     Marcello Duarte <marcello.duarte@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5bf3cbdac76b4\Prophecy\Doubler\ClassPatch;

use _PhpScoper5bf3cbdac76b4\Prophecy\Doubler\Generator\Node\ClassNode;
use _PhpScoper5bf3cbdac76b4\Prophecy\Doubler\Generator\Node\MethodNode;
use _PhpScoper5bf3cbdac76b4\Prophecy\PhpDocumentor\ClassAndInterfaceTagRetriever;
use _PhpScoper5bf3cbdac76b4\Prophecy\PhpDocumentor\MethodTagRetrieverInterface;
/**
 * Discover Magical API using "@method" PHPDoc format.
 *
 * @author Thomas Tourlourat <thomas@tourlourat.com>
 * @author Kévin Dunglas <dunglas@gmail.com>
 * @author Théo FIDRY <theo.fidry@gmail.com>
 */
class MagicCallPatch implements \_PhpScoper5bf3cbdac76b4\Prophecy\Doubler\ClassPatch\ClassPatchInterface
{
    private $tagRetriever;
    public function __construct(\_PhpScoper5bf3cbdac76b4\Prophecy\PhpDocumentor\MethodTagRetrieverInterface $tagRetriever = null)
    {
        $this->tagRetriever = null === $tagRetriever ? new \_PhpScoper5bf3cbdac76b4\Prophecy\PhpDocumentor\ClassAndInterfaceTagRetriever() : $tagRetriever;
    }
    /**
     * Support any class
     *
     * @param ClassNode $node
     *
     * @return boolean
     */
    public function supports(\_PhpScoper5bf3cbdac76b4\Prophecy\Doubler\Generator\Node\ClassNode $node)
    {
        return \true;
    }
    /**
     * Discover Magical API
     *
     * @param ClassNode $node
     */
    public function apply(\_PhpScoper5bf3cbdac76b4\Prophecy\Doubler\Generator\Node\ClassNode $node)
    {
        $types = \array_filter($node->getInterfaces(), function ($interface) {
            return 0 !== \strpos($interface, 'Prophecy\\');
        });
        $types[] = $node->getParentClass();
        foreach ($types as $type) {
            $reflectionClass = new \ReflectionClass($type);
            while ($reflectionClass) {
                $tagList = $this->tagRetriever->getTagList($reflectionClass);
                foreach ($tagList as $tag) {
                    $methodName = $tag->getMethodName();
                    if (empty($methodName)) {
                        continue;
                    }
                    if (!$reflectionClass->hasMethod($methodName)) {
                        $methodNode = new \_PhpScoper5bf3cbdac76b4\Prophecy\Doubler\Generator\Node\MethodNode($methodName);
                        $methodNode->setStatic($tag->isStatic());
                        $node->addMethod($methodNode);
                    }
                }
                $reflectionClass = $reflectionClass->getParentClass();
            }
        }
    }
    /**
     * Returns patch priority, which determines when patch will be applied.
     *
     * @return integer Priority number (higher - earlier)
     */
    public function getPriority()
    {
        return 50;
    }
}
