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
 * A Listener for test progress.
 */
interface TestListener
{
    /**
     * An error occurred.
     */
    public function addError(\PHPUnit\Framework\Test $test, \Throwable $t, float $time) : void;
    /**
     * A warning occurred.
     */
    public function addWarning(\PHPUnit\Framework\Test $test, \PHPUnit\Framework\Warning $e, float $time) : void;
    /**
     * A failure occurred.
     */
    public function addFailure(\PHPUnit\Framework\Test $test, \PHPUnit\Framework\AssertionFailedError $e, float $time) : void;
    /**
     * Incomplete test.
     */
    public function addIncompleteTest(\PHPUnit\Framework\Test $test, \Throwable $t, float $time) : void;
    /**
     * Risky test.
     */
    public function addRiskyTest(\PHPUnit\Framework\Test $test, \Throwable $t, float $time) : void;
    /**
     * Skipped test.
     */
    public function addSkippedTest(\PHPUnit\Framework\Test $test, \Throwable $t, float $time) : void;
    /**
     * A test suite started.
     */
    public function startTestSuite(\PHPUnit\Framework\TestSuite $suite) : void;
    /**
     * A test suite ended.
     */
    public function endTestSuite(\PHPUnit\Framework\TestSuite $suite) : void;
    /**
     * A test started.
     */
    public function startTest(\PHPUnit\Framework\Test $test) : void;
    /**
     * A test ended.
     */
    public function endTest(\PHPUnit\Framework\Test $test, float $time) : void;
}
