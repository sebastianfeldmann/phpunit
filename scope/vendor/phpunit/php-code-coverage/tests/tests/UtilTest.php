<?php

/*
 * This file is part of the php-code-coverage package.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace SebastianBergmann\CodeCoverage;

use PHPUnit\Framework\TestCase;
/**
 * @covers SebastianBergmann\CodeCoverage\Util
 */
class UtilTest extends \PHPUnit\Framework\TestCase
{
    public function testPercent()
    {
        $this->assertEquals(100, \SebastianBergmann\CodeCoverage\Util::percent(100, 0));
        $this->assertEquals(100, \SebastianBergmann\CodeCoverage\Util::percent(100, 100));
        $this->assertEquals('100.00%', \SebastianBergmann\CodeCoverage\Util::percent(100, 100, \true));
    }
}
