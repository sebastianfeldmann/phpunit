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
 * @covers PharIo\Manifest\Library
 * @covers PharIo\Manifest\Type
 */
class LibraryTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Library
     */
    private $type;
    protected function setUp()
    {
        $this->type = \PharIo\Manifest\Type::library();
    }
    public function testCanBeCreated()
    {
        $this->assertInstanceOf(\PharIo\Manifest\Library::class, $this->type);
    }
    public function testIsNotApplication()
    {
        $this->assertFalse($this->type->isApplication());
    }
    public function testIsLibrary()
    {
        $this->assertTrue($this->type->isLibrary());
    }
    public function testIsNotExtension()
    {
        $this->assertFalse($this->type->isExtension());
    }
}
