<?php

/*
 * This file is part of sebastian/global-state.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare (strict_types=1);
namespace _PhpScoper5bf3cbdac76b4\SebastianBergmann\GlobalState;

use PHPUnit\Framework\TestCase;
/**
 * @covers \SebastianBergmann\GlobalState\CodeExporter
 */
class CodeExporterTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @runInSeparateProcess
     */
    public function testCanExportGlobalVariablesToCode()
    {
        $GLOBALS = ['foo' => 'bar'];
        $snapshot = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\GlobalState\Snapshot(null, \true, \false, \false, \false, \false, \false, \false, \false, \false);
        $exporter = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\GlobalState\CodeExporter();
        $this->assertEquals('$GLOBALS = [];' . \PHP_EOL . '$GLOBALS[\'foo\'] = \'bar\';' . \PHP_EOL, $exporter->globalVariables($snapshot));
    }
}
