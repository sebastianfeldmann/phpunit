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
use _PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\Type;
use _PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\TypeResolver;
use _PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\Types\Context as TypeContext;
use _PhpScoper5bf3cbdac76b4\Webmozart\Assert\Assert;
/**
 * Reflection class for the {@}param tag in a Docblock.
 */
final class Param extends \_PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\DocBlock\Tags\BaseTag implements \_PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\DocBlock\Tags\Factory\StaticMethod
{
    /** @var string */
    protected $name = 'param';
    /** @var Type */
    private $type;
    /** @var string */
    private $variableName = '';
    /** @var bool determines whether this is a variadic argument */
    private $isVariadic = \false;
    /**
     * @param string $variableName
     * @param Type $type
     * @param bool $isVariadic
     * @param Description $description
     */
    public function __construct($variableName, \_PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\Type $type = null, $isVariadic = \false, \_PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\DocBlock\Description $description = null)
    {
        \_PhpScoper5bf3cbdac76b4\Webmozart\Assert\Assert::string($variableName);
        \_PhpScoper5bf3cbdac76b4\Webmozart\Assert\Assert::boolean($isVariadic);
        $this->variableName = $variableName;
        $this->type = $type;
        $this->isVariadic = $isVariadic;
        $this->description = $description;
    }
    /**
     * {@inheritdoc}
     */
    public static function create($body, \_PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\TypeResolver $typeResolver = null, \_PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\DocBlock\DescriptionFactory $descriptionFactory = null, \_PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\Types\Context $context = null)
    {
        \_PhpScoper5bf3cbdac76b4\Webmozart\Assert\Assert::stringNotEmpty($body);
        \_PhpScoper5bf3cbdac76b4\Webmozart\Assert\Assert::allNotNull([$typeResolver, $descriptionFactory]);
        $parts = \preg_split('/(\\s+)/Su', $body, 3, \PREG_SPLIT_DELIM_CAPTURE);
        $type = null;
        $variableName = '';
        $isVariadic = \false;
        // if the first item that is encountered is not a variable; it is a type
        if (isset($parts[0]) && \strlen($parts[0]) > 0 && $parts[0][0] !== '$') {
            $type = $typeResolver->resolve(\array_shift($parts), $context);
            \array_shift($parts);
        }
        // if the next item starts with a $ or ...$ it must be the variable name
        if (isset($parts[0]) && \strlen($parts[0]) > 0 && ($parts[0][0] === '$' || \substr($parts[0], 0, 4) === '...$')) {
            $variableName = \array_shift($parts);
            \array_shift($parts);
            if (\substr($variableName, 0, 3) === '...') {
                $isVariadic = \true;
                $variableName = \substr($variableName, 3);
            }
            if (\substr($variableName, 0, 1) === '$') {
                $variableName = \substr($variableName, 1);
            }
        }
        $description = $descriptionFactory->create(\implode('', $parts), $context);
        return new static($variableName, $type, $isVariadic, $description);
    }
    /**
     * Returns the variable's name.
     *
     * @return string
     */
    public function getVariableName()
    {
        return $this->variableName;
    }
    /**
     * Returns the variable's type or null if unknown.
     *
     * @return Type|null
     */
    public function getType()
    {
        return $this->type;
    }
    /**
     * Returns whether this tag is variadic.
     *
     * @return boolean
     */
    public function isVariadic()
    {
        return $this->isVariadic;
    }
    /**
     * Returns a string representation for this tag.
     *
     * @return string
     */
    public function __toString()
    {
        return ($this->type ? $this->type . ' ' : '') . ($this->isVariadic() ? '...' : '') . '$' . $this->variableName . ($this->description ? ' ' . $this->description : '');
    }
}
