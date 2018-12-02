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
namespace _PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\DocBlock;

use _PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\DocBlock;
use _PhpScoper5bf3cbdac76b4\Webmozart\Assert\Assert;
/**
 * Converts a DocBlock back from an object to a complete DocComment including Asterisks.
 */
class Serializer
{
    /** @var string The string to indent the comment with. */
    protected $indentString = ' ';
    /** @var int The number of times the indent string is repeated. */
    protected $indent = 0;
    /** @var bool Whether to indent the first line with the given indent amount and string. */
    protected $isFirstLineIndented = \true;
    /** @var int|null The max length of a line. */
    protected $lineLength = null;
    /** @var DocBlock\Tags\Formatter A custom tag formatter. */
    protected $tagFormatter = null;
    /**
     * Create a Serializer instance.
     *
     * @param int $indent The number of times the indent string is repeated.
     * @param string   $indentString    The string to indent the comment with.
     * @param bool     $indentFirstLine Whether to indent the first line.
     * @param int|null $lineLength The max length of a line or NULL to disable line wrapping.
     * @param DocBlock\Tags\Formatter $tagFormatter A custom tag formatter, defaults to PassthroughFormatter.
     */
    public function __construct($indent = 0, $indentString = ' ', $indentFirstLine = \true, $lineLength = null, $tagFormatter = null)
    {
        \_PhpScoper5bf3cbdac76b4\Webmozart\Assert\Assert::integer($indent);
        \_PhpScoper5bf3cbdac76b4\Webmozart\Assert\Assert::string($indentString);
        \_PhpScoper5bf3cbdac76b4\Webmozart\Assert\Assert::boolean($indentFirstLine);
        \_PhpScoper5bf3cbdac76b4\Webmozart\Assert\Assert::nullOrInteger($lineLength);
        \_PhpScoper5bf3cbdac76b4\Webmozart\Assert\Assert::nullOrIsInstanceOf($tagFormatter, '_PhpScoper5bf3cbdac76b4\\phpDocumentor\\Reflection\\DocBlock\\Tags\\Formatter');
        $this->indent = $indent;
        $this->indentString = $indentString;
        $this->isFirstLineIndented = $indentFirstLine;
        $this->lineLength = $lineLength;
        $this->tagFormatter = $tagFormatter ?: new \_PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\DocBlock\Tags\Formatter\PassthroughFormatter();
    }
    /**
     * Generate a DocBlock comment.
     *
     * @param DocBlock $docblock The DocBlock to serialize.
     *
     * @return string The serialized doc block.
     */
    public function getDocComment(\_PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\DocBlock $docblock)
    {
        $indent = \str_repeat($this->indentString, $this->indent);
        $firstIndent = $this->isFirstLineIndented ? $indent : '';
        // 3 === strlen(' * ')
        $wrapLength = $this->lineLength ? $this->lineLength - \strlen($indent) - 3 : null;
        $text = $this->removeTrailingSpaces($indent, $this->addAsterisksForEachLine($indent, $this->getSummaryAndDescriptionTextBlock($docblock, $wrapLength)));
        $comment = "{$firstIndent}/**\n";
        if ($text) {
            $comment .= "{$indent} * {$text}\n";
            $comment .= "{$indent} *\n";
        }
        $comment = $this->addTagBlock($docblock, $wrapLength, $indent, $comment);
        $comment .= $indent . ' */';
        return $comment;
    }
    /**
     * @param $indent
     * @param $text
     * @return mixed
     */
    private function removeTrailingSpaces($indent, $text)
    {
        return \str_replace("\n{$indent} * \n", "\n{$indent} *\n", $text);
    }
    /**
     * @param $indent
     * @param $text
     * @return mixed
     */
    private function addAsterisksForEachLine($indent, $text)
    {
        return \str_replace("\n", "\n{$indent} * ", $text);
    }
    /**
     * @param DocBlock $docblock
     * @param $wrapLength
     * @return string
     */
    private function getSummaryAndDescriptionTextBlock(\_PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\DocBlock $docblock, $wrapLength)
    {
        $text = $docblock->getSummary() . ((string) $docblock->getDescription() ? "\n\n" . $docblock->getDescription() : '');
        if ($wrapLength !== null) {
            $text = \wordwrap($text, $wrapLength);
            return $text;
        }
        return $text;
    }
    /**
     * @param DocBlock $docblock
     * @param $wrapLength
     * @param $indent
     * @param $comment
     * @return string
     */
    private function addTagBlock(\_PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\DocBlock $docblock, $wrapLength, $indent, $comment)
    {
        foreach ($docblock->getTags() as $tag) {
            $tagText = $this->tagFormatter->format($tag);
            if ($wrapLength !== null) {
                $tagText = \wordwrap($tagText, $wrapLength);
            }
            $tagText = \str_replace("\n", "\n{$indent} * ", $tagText);
            $comment .= "{$indent} * {$tagText}\n";
        }
        return $comment;
    }
}
