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

class CopyrightElement extends \PharIo\Manifest\ManifestElement
{
    public function getAuthorElements()
    {
        return new \PharIo\Manifest\AuthorElementCollection($this->getChildrenByName('author'));
    }
    public function getLicenseElement()
    {
        return new \PharIo\Manifest\LicenseElement($this->getChildByName('license'));
    }
}
