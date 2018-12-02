<?php

/**
 * This file is part of phpDocumentor.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright 2010-2015 Mike van Riel<mike@phpdoc.org>
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      http://phpdoc.org
 */
namespace _PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\DocBlock\Tags;

use _PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\DocBlock\Description;
use _PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\DocBlock\DescriptionFactory;
use _PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\DocBlock\StandardTagFactory;
use _PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\Types\Context as TypeContext;
use _PhpScoper5bf3cbdac76b4\Webmozart\Assert\Assert;
/**
 * Parses a tag definition for a DocBlock.
 */
class Generic extends \_PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\DocBlock\Tags\BaseTag implements \_PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\DocBlock\Tags\Factory\StaticMethod
{
    /**
     * Parses a tag and populates the member variables.
     *
     * @param string $name Name of the tag.
     * @param Description $description The contents of the given tag.
     */
    public function __construct($name, \_PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\DocBlock\Description $description = null)
    {
        $this->validateTagName($name);
        $this->name = $name;
        $this->description = $description;
    }
    /**
     * Creates a new tag that represents any unknown tag type.
     *
     * @param string             $body
     * @param string             $name
     * @param DescriptionFactory $descriptionFactory
     * @param TypeContext        $context
     *
     * @return static
     */
    public static function create($body, $name = '', \_PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\DocBlock\DescriptionFactory $descriptionFactory = null, \_PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\Types\Context $context = null)
    {
        \_PhpScoper5bf3cbdac76b4\Webmozart\Assert\Assert::string($body);
        \_PhpScoper5bf3cbdac76b4\Webmozart\Assert\Assert::stringNotEmpty($name);
        \_PhpScoper5bf3cbdac76b4\Webmozart\Assert\Assert::notNull($descriptionFactory);
        $description = $descriptionFactory && $body ? $descriptionFactory->create($body, $context) : null;
        return new static($name, $description);
    }
    /**
     * Returns the tag as a serialized string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->description ? $this->description->render() : '';
    }
    /**
     * Validates if the tag name matches the expected format, otherwise throws an exception.
     *
     * @param string $name
     *
     * @return void
     */
    private function validateTagName($name)
    {
        if (!\preg_match('/^' . \_PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\DocBlock\StandardTagFactory::REGEX_TAGNAME . '$/u', $name)) {
            throw new \InvalidArgumentException('The tag name "' . $name . '" is not wellformed. Tags may only consist of letters, underscores, ' . 'hyphens and backslashes.');
        }
    }
}
