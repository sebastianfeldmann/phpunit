<?php

declare (strict_types=1);
/*
 * This file is part of resource-operations.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5bf3cbdac76b4\SebastianBergmann\ResourceOperations;

use PHPUnit\Framework\TestCase;
/**
 * @covers \SebastianBergmann\ResourceOperations\ResourceOperations
 */
final class ResourceOperationsTest extends \PHPUnit\Framework\TestCase
{
    public function testGetFunctions() : void
    {
        $functions = \_PhpScoper5bf3cbdac76b4\SebastianBergmann\ResourceOperations\ResourceOperations::getFunctions();
        $this->assertInternalType('array', $functions);
        $this->assertContains('fopen', $functions);
    }
}
