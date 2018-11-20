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

use PHPUnit\Framework\TestCase;
/**
 * @covers \PharIo\Manifest\AuthorCollection
 * @covers \PharIo\Manifest\AuthorCollectionIterator
 *
 * @uses \PharIo\Manifest\Author
 * @uses \PharIo\Manifest\Email
 */
class AuthorCollectionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var AuthorCollection
     */
    private $collection;
    /**
     * @var Author
     */
    private $item;
    protected function setUp()
    {
        $this->collection = new \PharIo\Manifest\AuthorCollection();
        $this->item = new \PharIo\Manifest\Author('Joe Developer', new \PharIo\Manifest\Email('user@example.com'));
    }
    public function testCanBeCreated()
    {
        $this->assertInstanceOf(\PharIo\Manifest\AuthorCollection::class, $this->collection);
    }
    public function testCanBeCounted()
    {
        $this->collection->add($this->item);
        $this->assertCount(1, $this->collection);
    }
    public function testCanBeIterated()
    {
        $this->collection->add(new \PharIo\Manifest\Author('Dummy First', new \PharIo\Manifest\Email('dummy@example.com')));
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
