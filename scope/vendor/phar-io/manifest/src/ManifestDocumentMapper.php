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
use PharIo\Version\Exception as VersionException;
use PharIo\Version\VersionConstraintParser;
class ManifestDocumentMapper
{
    /**
     * @param ManifestDocument $document
     *
     * @returns Manifest
     *
     * @throws ManifestDocumentMapperException
     */
    public function map(\PharIo\Manifest\ManifestDocument $document)
    {
        try {
            $contains = $document->getContainsElement();
            $type = $this->mapType($contains);
            $copyright = $this->mapCopyright($document->getCopyrightElement());
            $requirements = $this->mapRequirements($document->getRequiresElement());
            $bundledComponents = $this->mapBundledComponents($document);
            return new \PharIo\Manifest\Manifest(new \PharIo\Manifest\ApplicationName($contains->getName()), new \PharIo\Version\Version($contains->getVersion()), $type, $copyright, $requirements, $bundledComponents);
        } catch (\PharIo\Version\Exception $e) {
            throw new \PharIo\Manifest\ManifestDocumentMapperException($e->getMessage(), $e->getCode(), $e);
        } catch (\PharIo\Manifest\Exception $e) {
            throw new \PharIo\Manifest\ManifestDocumentMapperException($e->getMessage(), $e->getCode(), $e);
        }
    }
    /**
     * @param ContainsElement $contains
     *
     * @return Type
     *
     * @throws ManifestDocumentMapperException
     */
    private function mapType(\PharIo\Manifest\ContainsElement $contains)
    {
        switch ($contains->getType()) {
            case 'application':
                return \PharIo\Manifest\Type::application();
            case 'library':
                return \PharIo\Manifest\Type::library();
            case 'extension':
                return $this->mapExtension($contains->getExtensionElement());
        }
        throw new \PharIo\Manifest\ManifestDocumentMapperException(\sprintf('Unsupported type %s', $contains->getType()));
    }
    /**
     * @param CopyrightElement $copyright
     *
     * @return CopyrightInformation
     *
     * @throws InvalidUrlException
     * @throws InvalidEmailException
     */
    private function mapCopyright(\PharIo\Manifest\CopyrightElement $copyright)
    {
        $authors = new \PharIo\Manifest\AuthorCollection();
        foreach ($copyright->getAuthorElements() as $authorElement) {
            $authors->add(new \PharIo\Manifest\Author($authorElement->getName(), new \PharIo\Manifest\Email($authorElement->getEmail())));
        }
        $licenseElement = $copyright->getLicenseElement();
        $license = new \PharIo\Manifest\License($licenseElement->getType(), new \PharIo\Manifest\Url($licenseElement->getUrl()));
        return new \PharIo\Manifest\CopyrightInformation($authors, $license);
    }
    /**
     * @param RequiresElement $requires
     *
     * @return RequirementCollection
     *
     * @throws ManifestDocumentMapperException
     */
    private function mapRequirements(\PharIo\Manifest\RequiresElement $requires)
    {
        $collection = new \PharIo\Manifest\RequirementCollection();
        $phpElement = $requires->getPHPElement();
        $parser = new \PharIo\Version\VersionConstraintParser();
        try {
            $versionConstraint = $parser->parse($phpElement->getVersion());
        } catch (\PharIo\Version\Exception $e) {
            throw new \PharIo\Manifest\ManifestDocumentMapperException(\sprintf('Unsupported version constraint - %s', $e->getMessage()), $e->getCode(), $e);
        }
        $collection->add(new \PharIo\Manifest\PhpVersionRequirement($versionConstraint));
        if (!$phpElement->hasExtElements()) {
            return $collection;
        }
        foreach ($phpElement->getExtElements() as $extElement) {
            $collection->add(new \PharIo\Manifest\PhpExtensionRequirement($extElement->getName()));
        }
        return $collection;
    }
    /**
     * @param ManifestDocument $document
     *
     * @return BundledComponentCollection
     */
    private function mapBundledComponents(\PharIo\Manifest\ManifestDocument $document)
    {
        $collection = new \PharIo\Manifest\BundledComponentCollection();
        if (!$document->hasBundlesElement()) {
            return $collection;
        }
        foreach ($document->getBundlesElement()->getComponentElements() as $componentElement) {
            $collection->add(new \PharIo\Manifest\BundledComponent($componentElement->getName(), new \PharIo\Version\Version($componentElement->getVersion())));
        }
        return $collection;
    }
    /**
     * @param ExtensionElement $extension
     *
     * @return Extension
     *
     * @throws ManifestDocumentMapperException
     */
    private function mapExtension(\PharIo\Manifest\ExtensionElement $extension)
    {
        try {
            $parser = new \PharIo\Version\VersionConstraintParser();
            $versionConstraint = $parser->parse($extension->getCompatible());
            return \PharIo\Manifest\Type::extension(new \PharIo\Manifest\ApplicationName($extension->getFor()), $versionConstraint);
        } catch (\PharIo\Version\Exception $e) {
            throw new \PharIo\Manifest\ManifestDocumentMapperException(\sprintf('Unsupported version constraint - %s', $e->getMessage()), $e->getCode(), $e);
        }
    }
}
