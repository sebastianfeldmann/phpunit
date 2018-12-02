<?php

/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework;

/**
 * Thrown when there is a warning.
 */
class Warning extends \PHPUnit\Framework\Exception implements \PHPUnit\Framework\SelfDescribing
{
    /**
     * Wrapper for getMessage() which is declared as final.
     */
    public function toString() : string
    {
        return $this->getMessage();
    }
}
