<?php

declare (strict_types=1);
/*
 * This file is part of sebastian/diff.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff;

use PHPUnit\Framework\TestCase;
/**
 * @covers SebastianBergmann\Diff\Chunk
 */
final class ChunkTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Chunk
     */
    private $chunk;
    protected function setUp() : void
    {
        $this->chunk = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Chunk();
    }
    public function testCanBeCreatedWithoutArguments() : void
    {
        $this->assertInstanceOf(\_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Chunk::class, $this->chunk);
    }
    public function testStartCanBeRetrieved() : void
    {
        $this->assertSame(0, $this->chunk->getStart());
    }
    public function testStartRangeCanBeRetrieved() : void
    {
        $this->assertSame(1, $this->chunk->getStartRange());
    }
    public function testEndCanBeRetrieved() : void
    {
        $this->assertSame(0, $this->chunk->getEnd());
    }
    public function testEndRangeCanBeRetrieved() : void
    {
        $this->assertSame(1, $this->chunk->getEndRange());
    }
    public function testLinesCanBeRetrieved() : void
    {
        $this->assertSame([], $this->chunk->getLines());
    }
    public function testLinesCanBeSet() : void
    {
        $this->assertSame([], $this->chunk->getLines());
        $testValue = ['line0', 'line1'];
        $this->chunk->setLines($testValue);
        $this->assertSame($testValue, $this->chunk->getLines());
    }
}
