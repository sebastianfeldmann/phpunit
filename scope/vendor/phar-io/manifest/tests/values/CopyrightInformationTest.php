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
 * @covers PharIo\Manifest\CopyrightInformation
 *
 * @uses PharIo\Manifest\AuthorCollection
 * @uses PharIo\Manifest\AuthorCollectionIterator
 * @uses PharIo\Manifest\Author
 * @uses PharIo\Manifest\Email
 * @uses PharIo\Manifest\License
 * @uses PharIo\Manifest\Url
 */
class CopyrightInformationTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var CopyrightInformation
     */
    private $copyrightInformation;
    /**
     * @var Author
     */
    private $author;
    /**
     * @var License
     */
    private $license;
    protected function setUp()
    {
        $this->author = new \PharIo\Manifest\Author('Joe Developer', new \PharIo\Manifest\Email('user@example.com'));
        $this->license = new \PharIo\Manifest\License('BSD-3-Clause', new \PharIo\Manifest\Url('https://github.com/sebastianbergmann/phpunit/blob/master/LICENSE'));
        $authors = new \PharIo\Manifest\AuthorCollection();
        $authors->add($this->author);
        $this->copyrightInformation = new \PharIo\Manifest\CopyrightInformation($authors, $this->license);
    }
    public function testCanBeCreated()
    {
        $this->assertInstanceOf(\PharIo\Manifest\CopyrightInformation::class, $this->copyrightInformation);
    }
    public function testAuthorsCanBeRetrieved()
    {
        $this->assertContains($this->author, $this->copyrightInformation->getAuthors());
    }
    public function testLicenseCanBeRetrieved()
    {
        $this->assertEquals($this->license, $this->copyrightInformation->getLicense());
    }
}
