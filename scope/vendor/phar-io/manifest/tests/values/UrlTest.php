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
 * @covers PharIo\Manifest\Url
 */
class UrlTest extends \PHPUnit\Framework\TestCase
{
    public function testCanBeCreatedForValidUrl()
    {
        $this->assertInstanceOf(\PharIo\Manifest\Url::class, new \PharIo\Manifest\Url('https://phar.io/'));
    }
    public function testCanBeUsedAsString()
    {
        $this->assertEquals('https://phar.io/', new \PharIo\Manifest\Url('https://phar.io/'));
    }
    /**
     * @covers PharIo\Manifest\InvalidUrlException
     */
    public function testCannotBeCreatedForInvalidUrl()
    {
        $this->expectException(\PharIo\Manifest\InvalidUrlException::class);
        new \PharIo\Manifest\Url('invalid');
    }
}
