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
/**
 * Disable constructor.
 * Makes all constructor arguments optional.
 *
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 */
class DisableConstructorPatch implements \_PhpScoper5bf3cbdac76b4\Prophecy\Doubler\ClassPatch\ClassPatchInterface
{
    /**
     * Checks if class has `__construct` method.
     *
     * @param ClassNode $node
     *
     * @return bool
     */
    public function supports(\_PhpScoper5bf3cbdac76b4\Prophecy\Doubler\Generator\Node\ClassNode $node)
    {
        return \true;
    }
    /**
     * Makes all class constructor arguments optional.
     *
     * @param ClassNode $node
     */
    public function apply(\_PhpScoper5bf3cbdac76b4\Prophecy\Doubler\Generator\Node\ClassNode $node)
    {
        if (!$node->hasMethod('__construct')) {
            $node->addMethod(new \_PhpScoper5bf3cbdac76b4\Prophecy\Doubler\Generator\Node\MethodNode('__construct', ''));
            return;
        }
        $constructor = $node->getMethod('__construct');
        foreach ($constructor->getArguments() as $argument) {
            $argument->setDefault(null);
        }
        $constructor->setCode(<<<PHP
if (0 < func_num_args()) {
    call_user_func_array(array('parent', '__construct'), func_get_args());
}
PHP
);
    }
    /**
     * Returns patch priority, which determines when patch will be applied.
     *
     * @return int Priority number (higher - earlier)
     */
    public function getPriority()
    {
        return 100;
    }
}
