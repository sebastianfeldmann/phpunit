<?php

/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Framework\MockObject\Stub;

use PHPUnit\Framework\MockObject\Invocation;
use PHPUnit\Framework\MockObject\Stub;
use _PhpScoper5bf3cbdac76b4\SebastianBergmann\Exporter\Exporter;
/**
 * Stubs a method by returning a user-defined reference to a value.
 */
class ReturnReference implements \PHPUnit\Framework\MockObject\Stub
{
    /**
     * @var mixed
     */
    private $reference;
    public function __construct(&$reference)
    {
        $this->reference =& $reference;
    }
    public function invoke(\PHPUnit\Framework\MockObject\Invocation $invocation)
    {
        return $this->reference;
    }
    public function toString() : string
    {
        $exporter = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Exporter\Exporter();
        return \sprintf('return user-specified reference %s', $exporter->export($this->reference));
    }
}
