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

use ArrayObject;
use PHPUnit\Framework\TestCase;
use _PhpScoper5bf3cbdac76b4\SebastianBergmann\GlobalState\TestFixture\BlacklistedInterface;
use _PhpScoper5bf3cbdac76b4\SebastianBergmann\GlobalState\TestFixture\SnapshotClass;
use _PhpScoper5bf3cbdac76b4\SebastianBergmann\GlobalState\TestFixture\SnapshotTrait;
/**
 * @covers \SebastianBergmann\GlobalState\Snapshot
 */
class SnapshotTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Blacklist
     */
    private $blacklist;
    protected function setUp()
    {
        $this->blacklist = $this->createMock(\_PhpScoper5bf3cbdac76b4\SebastianBergmann\GlobalState\Blacklist::class);
    }
    public function testStaticAttributes()
    {
        $this->blacklist->method('isStaticAttributeBlacklisted')->willReturnCallback(function ($class) {
            return $class !== \_PhpScoper5bf3cbdac76b4\SebastianBergmann\GlobalState\TestFixture\SnapshotClass::class;
        });
        \_PhpScoper5bf3cbdac76b4\SebastianBergmann\GlobalState\TestFixture\SnapshotClass::init();
        $snapshot = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\GlobalState\Snapshot($this->blacklist, \false, \true, \false, \false, \false, \false, \false, \false, \false);
        $expected = [\_PhpScoper5bf3cbdac76b4\SebastianBergmann\GlobalState\TestFixture\SnapshotClass::class => ['string' => 'snapshot', 'arrayObject' => new \ArrayObject([1, 2, 3]), 'stdClass' => new \stdClass()]];
        $this->assertEquals($expected, $snapshot->staticAttributes());
    }
    public function testConstants()
    {
        $snapshot = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\GlobalState\Snapshot($this->blacklist, \false, \false, \true, \false, \false, \false, \false, \false, \false);
        $this->assertArrayHasKey('GLOBALSTATE_TESTSUITE', $snapshot->constants());
    }
    public function testFunctions()
    {
        $snapshot = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\GlobalState\Snapshot($this->blacklist, \false, \false, \false, \true, \false, \false, \false, \false, \false);
        $functions = $snapshot->functions();
        $this->assertContains('_PhpScoper5bf3cbdac76b4\\sebastianbergmann\\globalstate\\testfixture\\snapshotfunction', $functions);
        $this->assertNotContains('assert', $functions);
    }
    public function testClasses()
    {
        $snapshot = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\GlobalState\Snapshot($this->blacklist, \false, \false, \false, \false, \true, \false, \false, \false, \false);
        $classes = $snapshot->classes();
        $this->assertContains(\PHPUnit\Framework\TestCase::class, $classes);
        $this->assertNotContains(\_PhpScoper5bf3cbdac76b4\SebastianBergmann\GlobalState\Exception::class, $classes);
    }
    public function testInterfaces()
    {
        $snapshot = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\GlobalState\Snapshot($this->blacklist, \false, \false, \false, \false, \false, \true, \false, \false, \false);
        $interfaces = $snapshot->interfaces();
        $this->assertContains(\_PhpScoper5bf3cbdac76b4\SebastianBergmann\GlobalState\TestFixture\BlacklistedInterface::class, $interfaces);
        $this->assertNotContains(\Countable::class, $interfaces);
    }
    public function testTraits()
    {
        \spl_autoload_call('_PhpScoper5bf3cbdac76b4\\SebastianBergmann\\GlobalState\\TestFixture\\SnapshotTrait');
        $snapshot = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\GlobalState\Snapshot($this->blacklist, \false, \false, \false, \false, \false, \false, \true, \false, \false);
        $this->assertContains(\_PhpScoper5bf3cbdac76b4\SebastianBergmann\GlobalState\TestFixture\SnapshotTrait::class, $snapshot->traits());
    }
    public function testIniSettings()
    {
        $snapshot = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\GlobalState\Snapshot($this->blacklist, \false, \false, \false, \false, \false, \false, \false, \true, \false);
        $iniSettings = $snapshot->iniSettings();
        $this->assertArrayHasKey('date.timezone', $iniSettings);
        $this->assertEquals('Etc/UTC', $iniSettings['date.timezone']);
    }
    public function testIncludedFiles()
    {
        $snapshot = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\GlobalState\Snapshot($this->blacklist, \false, \false, \false, \false, \false, \false, \false, \false, \true);
        $this->assertContains(__FILE__, $snapshot->includedFiles());
    }
}
