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
/**
 * Class patch interface.
 * Class patches extend doubles functionality or help
 * Prophecy to avoid some internal PHP bugs.
 *
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 */
interface ClassPatchInterface
{
    /**
     * Checks if patch supports specific class node.
     *
     * @param ClassNode $node
     *
     * @return bool
     */
    public function supports(\_PhpScoper5bf3cbdac76b4\Prophecy\Doubler\Generator\Node\ClassNode $node);
    /**
     * Applies patch to the specific class node.
     *
     * @param ClassNode $node
     * @return void
     */
    public function apply(\_PhpScoper5bf3cbdac76b4\Prophecy\Doubler\Generator\Node\ClassNode $node);
    /**
     * Returns patch priority, which determines when patch will be applied.
     *
     * @return int Priority number (higher - earlier)
     */
    public function getPriority();
}
