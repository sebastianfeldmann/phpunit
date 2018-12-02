<?php

/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Util\TestDox;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Test;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\TestResult;
use PHPUnit\Framework\TestSuite;
use PHPUnit\Framework\Warning;
use PHPUnit\Runner\PhptTestCase;
use PHPUnit\TextUI\ResultPrinter;
use PHPUnit\Util\TestDox\TestResult as TestDoxTestResult;
use _PhpScoper5bf3cbdac76b4\SebastianBergmann\Timer\Timer;
/**
 * This printer is for CLI output only. For the classes that output to file, html and xml,
 * please refer to the PHPUnit\Util\TestDox namespace
 */
class CliTestDoxPrinter extends \PHPUnit\TextUI\ResultPrinter
{
    /**
     * @var TestDoxTestResult
     */
    private $currentTestResult;
    /**
     * @var TestDoxTestResult
     */
    private $previousTestResult;
    /**
     * @var TestDoxTestResult[]
     */
    private $nonSuccessfulTestResults = [];
    /**
     * @var NamePrettifier
     */
    private $prettifier;
    public function __construct($out = null, bool $verbose = \false, $colors = self::COLOR_DEFAULT, bool $debug = \false, $numberOfColumns = 80, bool $reverse = \false)
    {
        parent::__construct($out, $verbose, $colors, $debug, $numberOfColumns, $reverse);
        $this->prettifier = new \PHPUnit\Util\TestDox\NamePrettifier();
    }
    public function startTest(\PHPUnit\Framework\Test $test) : void
    {
        if (!$test instanceof \PHPUnit\Framework\TestCase && !$test instanceof \PHPUnit\Runner\PhptTestCase && !$test instanceof \PHPUnit\Framework\TestSuite) {
            return;
        }
        $class = \get_class($test);
        if ($test instanceof \PHPUnit\Framework\TestCase) {
            $className = $this->prettifier->prettifyTestClass($class);
            $testMethod = $this->prettifier->prettifyTestCase($test);
        } elseif ($test instanceof \PHPUnit\Framework\TestSuite) {
            $className = $test->getName();
            $testMethod = \sprintf('Error bootstapping suite (most likely in %s::setUpBeforeClass)', $test->getName());
        } elseif ($test instanceof \PHPUnit\Runner\PhptTestCase) {
            $className = $class;
            $testMethod = $test->getName();
        }
        $this->currentTestResult = new \PHPUnit\Util\TestDox\TestResult(function (string $color, string $buffer) {
            return $this->formatWithColor($color, $buffer);
        }, $className, $testMethod);
        parent::startTest($test);
    }
    public function endTest(\PHPUnit\Framework\Test $test, float $time) : void
    {
        if (!$test instanceof \PHPUnit\Framework\TestCase && !$test instanceof \PHPUnit\Runner\PhptTestCase && !$test instanceof \PHPUnit\Framework\TestSuite) {
            return;
        }
        parent::endTest($test, $time);
        $this->currentTestResult->setRuntime($time);
        $this->write($this->currentTestResult->toString($this->previousTestResult, $this->verbose));
        $this->previousTestResult = $this->currentTestResult;
        if (!$this->currentTestResult->isTestSuccessful()) {
            $this->nonSuccessfulTestResults[] = $this->currentTestResult;
        }
    }
    public function addError(\PHPUnit\Framework\Test $test, \Throwable $t, float $time) : void
    {
        $this->currentTestResult->fail($this->formatWithColor('fg-yellow', '✘'), (string) $t);
    }
    public function addWarning(\PHPUnit\Framework\Test $test, \PHPUnit\Framework\Warning $e, float $time) : void
    {
        $this->currentTestResult->fail($this->formatWithColor('fg-yellow', '✘'), (string) $e);
    }
    public function addFailure(\PHPUnit\Framework\Test $test, \PHPUnit\Framework\AssertionFailedError $e, float $time) : void
    {
        $this->currentTestResult->fail($this->formatWithColor('fg-red', '✘'), (string) $e);
    }
    public function addIncompleteTest(\PHPUnit\Framework\Test $test, \Throwable $t, float $time) : void
    {
        $this->currentTestResult->fail($this->formatWithColor('fg-yellow', '∅'), (string) $t, \true);
    }
    public function addRiskyTest(\PHPUnit\Framework\Test $test, \Throwable $t, float $time) : void
    {
        $this->currentTestResult->fail($this->formatWithColor('fg-yellow', '☢'), (string) $t, \true);
    }
    public function addSkippedTest(\PHPUnit\Framework\Test $test, \Throwable $t, float $time) : void
    {
        $this->currentTestResult->fail($this->formatWithColor('fg-yellow', '→'), (string) $t, \true);
    }
    public function writeProgress(string $progress) : void
    {
    }
    public function flush() : void
    {
    }
    public function printResult(\PHPUnit\Framework\TestResult $result) : void
    {
        $this->printHeader();
        $this->printNonSuccessfulTestsSummary($result->count());
        $this->printFooter($result);
    }
    protected function printHeader() : void
    {
        $this->write("\n" . \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Timer\Timer::resourceUsage() . "\n\n");
    }
    private function printNonSuccessfulTestsSummary(int $numberOfExecutedTests) : void
    {
        $numberOfNonSuccessfulTests = \count($this->nonSuccessfulTestResults);
        if ($numberOfNonSuccessfulTests === 0) {
            return;
        }
        if ($numberOfNonSuccessfulTests / $numberOfExecutedTests >= 0.7) {
            return;
        }
        $this->write("Summary of non-successful tests:\n\n");
        $previousTestResult = null;
        foreach ($this->nonSuccessfulTestResults as $testResult) {
            $this->write($testResult->toString($previousTestResult, $this->verbose));
            $previousTestResult = $testResult;
        }
    }
}
