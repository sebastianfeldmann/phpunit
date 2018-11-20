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
use _PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\Types\Void_;
use _PhpScoper5bf3cbdac76b4\Webmozart\Assert\Assert;
/**
 * Reflection class for an {@}method in a Docblock.
 */
final class Method extends \_PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\DocBlock\Tags\BaseTag implements \_PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\DocBlock\Tags\Factory\StaticMethod
{
    protected $name = 'method';
    /** @var string */
    private $methodName = '';
    /** @var string[] */
    private $arguments = [];
    /** @var bool */
    private $isStatic = \false;
    /** @var Type */
    private $returnType;
    public function __construct($methodName, array $arguments = [], \_PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\Type $returnType = null, $static = \false, \_PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\DocBlock\Description $description = null)
    {
        \_PhpScoper5bf3cbdac76b4\Webmozart\Assert\Assert::stringNotEmpty($methodName);
        \_PhpScoper5bf3cbdac76b4\Webmozart\Assert\Assert::boolean($static);
        if ($returnType === null) {
            $returnType = new \_PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\Types\Void_();
        }
        $this->methodName = $methodName;
        $this->arguments = $this->filterArguments($arguments);
        $this->returnType = $returnType;
        $this->isStatic = $static;
        $this->description = $description;
    }
    /**
     * {@inheritdoc}
     */
    public static function create($body, \_PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\TypeResolver $typeResolver = null, \_PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\DocBlock\DescriptionFactory $descriptionFactory = null, \_PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\Types\Context $context = null)
    {
        \_PhpScoper5bf3cbdac76b4\Webmozart\Assert\Assert::stringNotEmpty($body);
        \_PhpScoper5bf3cbdac76b4\Webmozart\Assert\Assert::allNotNull([$typeResolver, $descriptionFactory]);
        // 1. none or more whitespace
        // 2. optionally the keyword "static" followed by whitespace
        // 3. optionally a word with underscores followed by whitespace : as
        //    type for the return value
        // 4. then optionally a word with underscores followed by () and
        //    whitespace : as method name as used by phpDocumentor
        // 5. then a word with underscores, followed by ( and any character
        //    until a ) and whitespace : as method name with signature
        // 6. any remaining text : as description
        if (!\preg_match('/^
                # Static keyword
                # Declares a static method ONLY if type is also present
                (?:
                    (static)
                    \\s+
                )?
                # Return type
                (?:
                    (   
                        (?:[\\w\\|_\\\\]*\\$this[\\w\\|_\\\\]*)
                        |
                        (?:
                            (?:[\\w\\|_\\\\]+)
                            # array notation           
                            (?:\\[\\])*
                        )*
                    )
                    \\s+
                )?
                # Legacy method name (not captured)
                (?:
                    [\\w_]+\\(\\)\\s+
                )?
                # Method name
                ([\\w\\|_\\\\]+)
                # Arguments
                (?:
                    \\(([^\\)]*)\\)
                )?
                \\s*
                # Description
                (.*)
            $/sux', $body, $matches)) {
            return null;
        }
        list(, $static, $returnType, $methodName, $arguments, $description) = $matches;
        $static = $static === 'static';
        if ($returnType === '') {
            $returnType = 'void';
        }
        $returnType = $typeResolver->resolve($returnType, $context);
        $description = $descriptionFactory->create($description, $context);
        if (\is_string($arguments) && \strlen($arguments) > 0) {
            $arguments = \explode(',', $arguments);
            foreach ($arguments as &$argument) {
                $argument = \explode(' ', self::stripRestArg(\trim($argument)), 2);
                if ($argument[0][0] === '$') {
                    $argumentName = \substr($argument[0], 1);
                    $argumentType = new \_PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\Types\Void_();
                } else {
                    $argumentType = $typeResolver->resolve($argument[0], $context);
                    $argumentName = '';
                    if (isset($argument[1])) {
                        $argument[1] = self::stripRestArg($argument[1]);
                        $argumentName = \substr($argument[1], 1);
                    }
                }
                $argument = ['name' => $argumentName, 'type' => $argumentType];
            }
        } else {
            $arguments = [];
        }
        return new static($methodName, $arguments, $returnType, $static, $description);
    }
    /**
     * Retrieves the method name.
     *
     * @return string
     */
    public function getMethodName()
    {
        return $this->methodName;
    }
    /**
     * @return string[]
     */
    public function getArguments()
    {
        return $this->arguments;
    }
    /**
     * Checks whether the method tag describes a static method or not.
     *
     * @return bool TRUE if the method declaration is for a static method, FALSE otherwise.
     */
    public function isStatic()
    {
        return $this->isStatic;
    }
    /**
     * @return Type
     */
    public function getReturnType()
    {
        return $this->returnType;
    }
    public function __toString()
    {
        $arguments = [];
        foreach ($this->arguments as $argument) {
            $arguments[] = $argument['type'] . ' $' . $argument['name'];
        }
        return \trim(($this->isStatic() ? 'static ' : '') . (string) $this->returnType . ' ' . $this->methodName . '(' . \implode(', ', $arguments) . ')' . ($this->description ? ' ' . $this->description->render() : ''));
    }
    private function filterArguments($arguments)
    {
        foreach ($arguments as &$argument) {
            if (\is_string($argument)) {
                $argument = ['name' => $argument];
            }
            if (!isset($argument['type'])) {
                $argument['type'] = new \_PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\Types\Void_();
            }
            $keys = \array_keys($argument);
            \sort($keys);
            if ($keys !== ['name', 'type']) {
                throw new \InvalidArgumentException('Arguments can only have the "name" and "type" fields, found: ' . \var_export($keys, \true));
            }
        }
        return $arguments;
    }
    private static function stripRestArg($argument)
    {
        if (\strpos($argument, '...') === 0) {
            $argument = \trim(\substr($argument, 3));
        }
        return $argument;
    }
}
