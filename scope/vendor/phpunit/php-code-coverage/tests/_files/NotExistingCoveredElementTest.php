<?php

namespace _PhpScoper5bf3cbdac76b4;

use PHPUnit\Framework\TestCase;
class NotExistingCoveredElementTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @covers NotExistingClass
     */
    public function testOne()
    {
    }
    /**
     * @covers NotExistingClass::notExistingMethod
     */
    public function testTwo()
    {
    }
    /**
     * @covers NotExistingClass::<public>
     */
    public function testThree()
    {
    }
}
