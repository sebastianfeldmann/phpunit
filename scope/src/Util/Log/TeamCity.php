<?php

/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Util\Log;

use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\ExceptionWrapper;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\Test;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\TestFailure;
use PHPUnit\Framework\TestResult;
use PHPUnit\Framework\TestSuite;
use PHPUnit\Framework\Warning;
use PHPUnit\TextUI\ResultPrinter;
use PHPUnit\Util\Filter;
use ReflectionClass;
use _PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\ComparisonFailure;
/**
 * A TestListener that generates a logfile of the test execution using the
 * TeamCity format (for use with PhpStorm, for instance).
 */
class TeamCity extends \PHPUnit\TextUI\ResultPrinter
{
    /**
     * @var bool
     */
    private $isSummaryTestCountPrinted = \false;
    /**
     * @var string
     */
    private $startedTestName;
    /**
     * @var false|int
     */
    private $flowId;
    public function printResult(\PHPUnit\Framework\TestResult $result) : void
    {
        $this->printHeader();
        $this->printFooter($result);
    }
    /**
     * An error occurred.
     *
     * @throws \InvalidArgumentException
     */
    public function addError(\PHPUnit\Framework\Test $test, \Throwable $t, float $time) : void
    {
        if (!$test instanceof \PHPUnit\Framework\TestCase) {
            return;
        }
        $this->printEvent('testFailed', ['name' => $test->getName(), 'message' => self::getMessage($t), 'details' => self::getDetails($t), 'duration' => self::toMilliseconds($time)]);
    }
    /**
     * A warning occurred.
     *
     * @throws \InvalidArgumentException
     */
    public function addWarning(\PHPUnit\Framework\Test $test, \PHPUnit\Framework\Warning $e, float $time) : void
    {
        if (!$test instanceof \PHPUnit\Framework\TestCase) {
            return;
        }
        $this->printEvent('testFailed', ['name' => $test->getName(), 'message' => self::getMessage($e), 'details' => self::getDetails($e), 'duration' => self::toMilliseconds($time)]);
    }
    /**
     * A failure occurred.
     *
     * @throws \InvalidArgumentException
     */
    public function addFailure(\PHPUnit\Framework\Test $test, \PHPUnit\Framework\AssertionFailedError $e, float $time) : void
    {
        if (!$test instanceof \PHPUnit\Framework\TestCase) {
            return;
        }
        $parameters = ['name' => $test->getName(), 'message' => self::getMessage($e), 'details' => self::getDetails($e), 'duration' => self::toMilliseconds($time)];
        if ($e instanceof \PHPUnit\Framework\ExpectationFailedException) {
            $comparisonFailure = $e->getComparisonFailure();
            if ($comparisonFailure instanceof \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\ComparisonFailure) {
                $expectedString = $comparisonFailure->getExpectedAsString();
                if ($expectedString === null || empty($expectedString)) {
                    $expectedString = self::getPrimitiveValueAsString($comparisonFailure->getExpected());
                }
                $actualString = $comparisonFailure->getActualAsString();
                if ($actualString === null || empty($actualString)) {
                    $actualString = self::getPrimitiveValueAsString($comparisonFailure->getActual());
                }
                if ($actualString !== null && $expectedString !== null) {
                    $parameters['type'] = 'comparisonFailure';
                    $parameters['actual'] = $actualString;
                    $parameters['expected'] = $expectedString;
                }
            }
        }
        $this->printEvent('testFailed', $parameters);
    }
    /**
     * Incomplete test.
     */
    public function addIncompleteTest(\PHPUnit\Framework\Test $test, \Throwable $t, float $time) : void
    {
        if (!$test instanceof \PHPUnit\Framework\TestCase) {
            return;
        }
        $this->printIgnoredTest($test->getName(), $t, $time);
    }
    /**
     * Risky test.
     *
     * @throws \InvalidArgumentException
     */
    public function addRiskyTest(\PHPUnit\Framework\Test $test, \Throwable $t, float $time) : void
    {
        if (!$test instanceof \PHPUnit\Framework\TestCase) {
            return;
        }
        $this->addError($test, $t, $time);
    }
    /**
     * Skipped test.
     *
     * @throws \ReflectionException
     */
    public function addSkippedTest(\PHPUnit\Framework\Test $test, \Throwable $t, float $time) : void
    {
        if (!$test instanceof \PHPUnit\Framework\TestCase) {
            return;
        }
        $testName = $test->getName();
        if ($this->startedTestName !== $testName) {
            $this->startTest($test);
            $this->printIgnoredTest($testName, $t, $time);
            $this->endTest($test, $time);
        } else {
            $this->printIgnoredTest($testName, $t, $time);
        }
    }
    public function printIgnoredTest($testName, \Throwable $t, float $time) : void
    {
        $this->printEvent('testIgnored', ['name' => $testName, 'message' => self::getMessage($t), 'details' => self::getDetails($t), 'duration' => self::toMilliseconds($time)]);
    }
    /**
     * A testsuite started.
     *
     * @throws \ReflectionException
     */
    public function startTestSuite(\PHPUnit\Framework\TestSuite $suite) : void
    {
        if (\stripos(\ini_get('disable_functions'), 'getmypid') === \false) {
            $this->flowId = \getmypid();
        } else {
            $this->flowId = \false;
        }
        if (!$this->isSummaryTestCountPrinted) {
            $this->isSummaryTestCountPrinted = \true;
            $this->printEvent('testCount', ['count' => \count($suite)]);
        }
        $suiteName = $suite->getName();
        if (empty($suiteName)) {
            return;
        }
        $parameters = ['name' => $suiteName];
        if (\class_exists($suiteName, \false)) {
            $fileName = self::getFileName($suiteName);
            $parameters['locationHint'] = "php_qn://{$fileName}::\\{$suiteName}";
        } else {
            $split = \explode('::', $suiteName);
            if (\count($split) === 2 && \method_exists($split[0], $split[1])) {
                $fileName = self::getFileName($split[0]);
                $parameters['locationHint'] = "php_qn://{$fileName}::\\{$suiteName}";
                $parameters['name'] = $split[1];
            }
        }
        $this->printEvent('testSuiteStarted', $parameters);
    }
    /**
     * A testsuite ended.
     */
    public function endTestSuite(\PHPUnit\Framework\TestSuite $suite) : void
    {
        $suiteName = $suite->getName();
        if (empty($suiteName)) {
            return;
        }
        $parameters = ['name' => $suiteName];
        if (!\class_exists($suiteName, \false)) {
            $split = \explode('::', $suiteName);
            if (\count($split) === 2 && \method_exists($split[0], $split[1])) {
                $parameters['name'] = $split[1];
            }
        }
        $this->printEvent('testSuiteFinished', $parameters);
    }
    /**
     * A test started.
     *
     * @throws \ReflectionException
     */
    public function startTest(\PHPUnit\Framework\Test $test) : void
    {
        if (!$test instanceof \PHPUnit\Framework\TestCase) {
            return;
        }
        $testName = $test->getName();
        $this->startedTestName = $testName;
        $params = ['name' => $testName];
        if ($test instanceof \PHPUnit\Framework\TestCase) {
            $className = \get_class($test);
            $fileName = self::getFileName($className);
            $params['locationHint'] = "php_qn://{$fileName}::\\{$className}::{$testName}";
        }
        $this->printEvent('testStarted', $params);
    }
    /**
     * A test ended.
     */
    public function endTest(\PHPUnit\Framework\Test $test, float $time) : void
    {
        if (!$test instanceof \PHPUnit\Framework\TestCase) {
            return;
        }
        parent::endTest($test, $time);
        $this->printEvent('testFinished', ['name' => $test->getName(), 'duration' => self::toMilliseconds($time)]);
    }
    protected function writeProgress(string $progress) : void
    {
    }
    /**
     * @param string $eventName
     * @param array  $params
     */
    private function printEvent($eventName, $params = []) : void
    {
        $this->write("\n##teamcity[{$eventName}");
        if ($this->flowId) {
            $params['flowId'] = $this->flowId;
        }
        foreach ($params as $key => $value) {
            $escapedValue = self::escapeValue($value);
            $this->write(" {$key}='{$escapedValue}'");
        }
        $this->write("]\n");
    }
    private static function getMessage(\Throwable $t) : string
    {
        $message = '';
        if ($t instanceof \PHPUnit\Framework\ExceptionWrapper) {
            if ($t->getClassName() !== '') {
                $message .= $t->getClassName();
            }
            if ($message !== '' && $t->getMessage() !== '') {
                $message .= ' : ';
            }
        }
        return $message . $t->getMessage();
    }
    /**
     * @throws \InvalidArgumentException
     */
    private static function getDetails(\Throwable $t) : string
    {
        $stackTrace = \PHPUnit\Util\Filter::getFilteredStacktrace($t);
        $previous = $t instanceof \PHPUnit\Framework\ExceptionWrapper ? $t->getPreviousWrapped() : $t->getPrevious();
        while ($previous) {
            $stackTrace .= "\nCaused by\n" . \PHPUnit\Framework\TestFailure::exceptionToString($previous) . "\n" . \PHPUnit\Util\Filter::getFilteredStacktrace($previous);
            $previous = $previous instanceof \PHPUnit\Framework\ExceptionWrapper ? $previous->getPreviousWrapped() : $previous->getPrevious();
        }
        return ' ' . \str_replace("\n", "\n ", $stackTrace);
    }
    private static function getPrimitiveValueAsString($value) : ?string
    {
        if ($value === null) {
            return 'null';
        }
        if (\is_bool($value)) {
            return $value === \true ? 'true' : 'false';
        }
        if (\is_scalar($value)) {
            return \print_r($value, \true);
        }
        return null;
    }
    private static function escapeValue(string $text) : string
    {
        return \str_replace(['|', "'", "\n", "\r", ']', '['], ['||', "|'", '|n', '|r', '|]', '|['], $text);
    }
    /**
     * @param string $className
     *
     * @throws \ReflectionException
     */
    private static function getFileName($className) : string
    {
        $reflectionClass = new \ReflectionClass($className);
        return $reflectionClass->getFileName();
    }
    /**
     * @param float $time microseconds
     */
    private static function toMilliseconds(float $time) : int
    {
        return \round($time * 1000);
    }
}
