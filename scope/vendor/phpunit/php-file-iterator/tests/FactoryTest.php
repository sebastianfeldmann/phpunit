<?php

/*
 * This file is part of php-file-iterator.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5bf3cbdac76b4\SebastianBergmann\FileIterator;

use PHPUnit\Framework\TestCase;
/**
 * @covers \SebastianBergmann\FileIterator\Factory
 */
class FactoryTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var string
     */
    private $root;
    /**
     * @var Factory
     */
    private $factory;
    protected function setUp() : void
    {
        $this->root = __DIR__;
        $this->factory = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\FileIterator\Factory();
    }
    public function testFindFilesInTestDirectory() : void
    {
        $iterator = $this->factory->getFileIterator($this->root, 'Test.php');
        $files = \iterator_to_array($iterator);
        $this->assertGreaterThanOrEqual(1, \count($files));
    }
    public function testFindFilesWithExcludedNonExistingSubdirectory() : void
    {
        $iterator = $this->factory->getFileIterator($this->root, 'Test.php', '', [$this->root . '/nonExistingDir']);
        $files = \iterator_to_array($iterator);
        $this->assertGreaterThanOrEqual(1, \count($files));
    }
}
