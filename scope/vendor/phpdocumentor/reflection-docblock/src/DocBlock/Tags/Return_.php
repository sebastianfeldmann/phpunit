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
 * Reflection class for a {@}return tag in a Docblock.
 */
final class Return_ extends \_PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\DocBlock\Tags\BaseTag implements \_PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\DocBlock\Tags\Factory\StaticMethod
{
    protected $name = 'return';
    /** @var Type */
    private $type;
    public function __construct(\_PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\Type $type, \_PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\DocBlock\Description $description = null)
    {
        $this->type = $type;
        $this->description = $description;
    }
    /**
     * {@inheritdoc}
     */
    public static function create($body, \_PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\TypeResolver $typeResolver = null, \_PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\DocBlock\DescriptionFactory $descriptionFactory = null, \_PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\Types\Context $context = null)
    {
        \_PhpScoper5bf3cbdac76b4\Webmozart\Assert\Assert::string($body);
        \_PhpScoper5bf3cbdac76b4\Webmozart\Assert\Assert::allNotNull([$typeResolver, $descriptionFactory]);
        $parts = \preg_split('/\\s+/Su', $body, 2);
        $type = $typeResolver->resolve(isset($parts[0]) ? $parts[0] : '', $context);
        $description = $descriptionFactory->create(isset($parts[1]) ? $parts[1] : '', $context);
        return new static($type, $description);
    }
    /**
     * Returns the type section of the variable.
     *
     * @return Type
     */
    public function getType()
    {
        return $this->type;
    }
    public function __toString()
    {
        return $this->type . ' ' . $this->description;
    }
}
