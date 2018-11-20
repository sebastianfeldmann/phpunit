<?php

/*
 * This file is part of PharIo\Manifest.
 *
 * (c) Arne Blankerts <arne@blankerts.de>, Sebastian Heuer <sebastian@phpeople.de>, Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PharIo\Manifest;

use PharIo\Version\Version;
use PHPUnit\Framework\TestCase;
/**
 * @covers \PharIo\Manifest\BundledComponentCollection
 * @covers \PharIo\Manifest\BundledComponentCollectionIterator
 *
 * @uses \PharIo\Manifest\BundledComponent
 * @uses \PharIo\Version\Version
 */
class BundledComponentCollectionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var BundledComponentCollection
     */
    private $collection;
    /**
     * @var BundledComponent
     */
    private $item;
    protected function setUp()
    {
        $this->collection = new \PharIo\Manifest\BundledComponentCollection();
        $this->item = new \PharIo\Manifest\BundledComponent('phpunit/php-code-coverage', new \PharIo\Version\Version('4.0.2'));
    }
    public function testCanBeCreated()
    {
        $this->assertInstanceOf(\PharIo\Manifest\BundledComponentCollection::class, $this->collection);
    }
    public function testCanBeCounted()
    {
        $this->collection->add($this->item);
        $this->assertCount(1, $this->collection);
    }
    public function testCanBeIterated()
    {
        $this->collection->add($this->createMock(\PharIo\Manifest\BundledComponent::class));
        $this->collection->add($this->item);
        $this->assertContains($this->item, $this->collection);
    }
    public function testKeyPositionCanBeRetreived()
    {
        $this->collection->add($this->item);
        foreach ($this->collection as $key => $item) {
            $this->assertEquals(0, $key);
        }
    }
}
