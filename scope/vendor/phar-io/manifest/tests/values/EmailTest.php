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
 * @covers PharIo\Manifest\Email
 */
class EmailTest extends \PHPUnit\Framework\TestCase
{
    public function testCanBeCreatedForValidEmail()
    {
        $this->assertInstanceOf(\PharIo\Manifest\Email::class, new \PharIo\Manifest\Email('user@example.com'));
    }
    public function testCanBeUsedAsString()
    {
        $this->assertEquals('user@example.com', new \PharIo\Manifest\Email('user@example.com'));
    }
    /**
     * @covers PharIo\Manifest\InvalidEmailException
     */
    public function testCannotBeCreatedForInvalidEmail()
    {
        $this->expectException(\PharIo\Manifest\InvalidEmailException::class);
        new \PharIo\Manifest\Email('invalid');
    }
}
