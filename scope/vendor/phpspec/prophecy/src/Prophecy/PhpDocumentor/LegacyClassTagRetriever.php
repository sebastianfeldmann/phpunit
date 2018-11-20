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

use _PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\DocBlock;
use _PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\DocBlock\Tag\MethodTag as LegacyMethodTag;
/**
 * @author Théo FIDRY <theo.fidry@gmail.com>
 *
 * @internal
 */
final class LegacyClassTagRetriever implements \_PhpScoper5bf3cbdac76b4\Prophecy\PhpDocumentor\MethodTagRetrieverInterface
{
    /**
     * @param \ReflectionClass $reflectionClass
     *
     * @return LegacyMethodTag[]
     */
    public function getTagList(\ReflectionClass $reflectionClass)
    {
        $phpdoc = new \_PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\DocBlock($reflectionClass->getDocComment());
        return $phpdoc->getTagsByName('method');
    }
}
