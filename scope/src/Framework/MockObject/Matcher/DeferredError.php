<?php

/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework\MockObject\Matcher;

use PHPUnit\Framework\MockObject\Invocation as BaseInvocation;
class DeferredError extends \PHPUnit\Framework\MockObject\Matcher\StatelessInvocation
{
    /**
     * @var \Throwable
     */
    private $exception;
    public function __construct(\Throwable $exception)
    {
        $this->exception = $exception;
    }
    public function verify() : void
    {
        throw $this->exception;
    }
    public function toString() : string
    {
        return '';
    }
    public function matches(\PHPUnit\Framework\MockObject\Invocation $invocation) : bool
    {
        return \true;
    }
}
