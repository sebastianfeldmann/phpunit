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
namespace _PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\Types;

use _PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\Type;
/**
 * Value Object representing the 'parent' type.
 *
 * Parent, as a Type, represents the parent class of class in which the associated element was defined.
 */
final class Parent_ implements \_PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\Type
{
    /**
     * Returns a rendered output of the Type as it would be used in a DocBlock.
     *
     * @return string
     */
    public function __toString()
    {
        return 'parent';
    }
}
