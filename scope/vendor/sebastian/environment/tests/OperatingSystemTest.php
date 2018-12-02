<?php

/*
 * This file is part of sebastian/environment.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare (strict_types=1);
namespace _PhpScoper5bf3cbdac76b4\SebastianBergmann\Environment;

use PHPUnit\Framework\TestCase;
/**
 * @covers \SebastianBergmann\Environment\OperatingSystem
 */
final class OperatingSystemTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \SebastianBergmann\Environment\OperatingSystem
     */
    private $os;
    protected function setUp()
    {
        $this->os = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Environment\OperatingSystem();
    }
    /**
     * @requires OS Linux
     */
    public function testFamilyCanBeRetrieved()
    {
        $this->assertEquals('Linux', $this->os->getFamily());
    }
}
