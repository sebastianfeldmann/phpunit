<?php

/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PHPUnit\Util;

use _PhpScoper5bf3cbdac76b4\Composer\Autoload\ClassLoader;
use _PhpScoper5bf3cbdac76b4\DeepCopy\DeepCopy;
use _PhpScoper5bf3cbdac76b4\Doctrine\Instantiator\Instantiator;
use _PhpScoper5bf3cbdac76b4\PHP_Token;
use _PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\DocBlock;
use PHPUnit\Framework\MockObject\Generator;
use PHPUnit\Framework\TestCase;
use _PhpScoper5bf3cbdac76b4\Prophecy\Prophet;
use ReflectionClass;
use SebastianBergmann\CodeCoverage\CodeCoverage;
use _PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\Comparator;
use _PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Diff;
use _PhpScoper5bf3cbdac76b4\SebastianBergmann\Environment\Runtime;
use _PhpScoper5bf3cbdac76b4\SebastianBergmann\Exporter\Exporter;
use _PhpScoper5bf3cbdac76b4\SebastianBergmann\FileIterator\Facade as FileIteratorFacade;
use _PhpScoper5bf3cbdac76b4\SebastianBergmann\GlobalState\Snapshot;
use _PhpScoper5bf3cbdac76b4\SebastianBergmann\Invoker\Invoker;
use _PhpScoper5bf3cbdac76b4\SebastianBergmann\RecursionContext\Context;
use _PhpScoper5bf3cbdac76b4\SebastianBergmann\Timer\Timer;
use _PhpScoper5bf3cbdac76b4\SebastianBergmann\Version;
use _PhpScoper5bf3cbdac76b4\Text_Template;
/**
 * Utility class for blacklisting PHPUnit's own source code files.
 */
final class Blacklist
{
    /**
     * @var array
     */
    public static $blacklistedClassNames = [\_PhpScoper5bf3cbdac76b4\SebastianBergmann\FileIterator\Facade::class => 1, \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Timer\Timer::class => 1, \_PhpScoper5bf3cbdac76b4\PHP_Token::class => 1, \PHPUnit\Framework\TestCase::class => 2, 'PHPUnit\\DbUnit\\TestCase' => 2, \PHPUnit\Framework\MockObject\Generator::class => 1, \_PhpScoper5bf3cbdac76b4\Text_Template::class => 1, '_PhpScoper5bf3cbdac76b4\\Symfony\\Component\\Yaml\\Yaml' => 1, \SebastianBergmann\CodeCoverage\CodeCoverage::class => 1, \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Diff\Diff::class => 1, \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Environment\Runtime::class => 1, \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Comparator\Comparator::class => 1, \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Exporter\Exporter::class => 1, \_PhpScoper5bf3cbdac76b4\SebastianBergmann\GlobalState\Snapshot::class => 1, \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Invoker\Invoker::class => 1, \_PhpScoper5bf3cbdac76b4\SebastianBergmann\RecursionContext\Context::class => 1, \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Version::class => 1, \_PhpScoper5bf3cbdac76b4\Composer\Autoload\ClassLoader::class => 1, \_PhpScoper5bf3cbdac76b4\Doctrine\Instantiator\Instantiator::class => 1, \_PhpScoper5bf3cbdac76b4\phpDocumentor\Reflection\DocBlock::class => 1, \_PhpScoper5bf3cbdac76b4\Prophecy\Prophet::class => 1, \_PhpScoper5bf3cbdac76b4\DeepCopy\DeepCopy::class => 1];
    /**
     * @var string[]
     */
    private static $directories;
    /**
     * @return string[]
     */
    public function getBlacklistedDirectories() : array
    {
        $this->initialize();
        return self::$directories;
    }
    public function isBlacklisted(string $file) : bool
    {
        if (\defined('PHPUNIT_TESTSUITE')) {
            return \false;
        }
        $this->initialize();
        foreach (self::$directories as $directory) {
            if (\strpos($file, $directory) === 0) {
                return \true;
            }
        }
        return \false;
    }
    private function initialize() : void
    {
        if (self::$directories === null) {
            self::$directories = [];
            foreach (self::$blacklistedClassNames as $className => $parent) {
                if (!\class_exists($className)) {
                    continue;
                }
                $reflector = new \ReflectionClass($className);
                $directory = $reflector->getFileName();
                for ($i = 0; $i < $parent; $i++) {
                    $directory = \dirname($directory);
                }
                self::$directories[] = $directory;
            }
            // Hide process isolation workaround on Windows.
            if (\DIRECTORY_SEPARATOR === '\\') {
                // tempnam() prefix is limited to first 3 chars.
                // @see https://php.net/manual/en/function.tempnam.php
                self::$directories[] = \sys_get_temp_dir() . '\\PHP';
            }
        }
    }
}
