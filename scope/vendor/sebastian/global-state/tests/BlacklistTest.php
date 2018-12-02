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
use _PhpScoper5bf3cbdac76b4\SebastianBergmann\GlobalState\TestFixture\BlacklistedChildClass;
use _PhpScoper5bf3cbdac76b4\SebastianBergmann\GlobalState\TestFixture\BlacklistedClass;
use _PhpScoper5bf3cbdac76b4\SebastianBergmann\GlobalState\TestFixture\BlacklistedImplementor;
use _PhpScoper5bf3cbdac76b4\SebastianBergmann\GlobalState\TestFixture\BlacklistedInterface;
/**
 * @covers \SebastianBergmann\GlobalState\Blacklist
 */
class BlacklistTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \SebastianBergmann\GlobalState\Blacklist
     */
    private $blacklist;
    protected function setUp()
    {
        $this->blacklist = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\GlobalState\Blacklist();
    }
    public function testGlobalVariableThatIsNotBlacklistedIsNotTreatedAsBlacklisted()
    {
        $this->assertFalse($this->blacklist->isGlobalVariableBlacklisted('variable'));
    }
    public function testGlobalVariableCanBeBlacklisted()
    {
        $this->blacklist->addGlobalVariable('variable');
        $this->assertTrue($this->blacklist->isGlobalVariableBlacklisted('variable'));
    }
    public function testStaticAttributeThatIsNotBlacklistedIsNotTreatedAsBlacklisted()
    {
        $this->assertFalse($this->blacklist->isStaticAttributeBlacklisted(\_PhpScoper5bf3cbdac76b4\SebastianBergmann\GlobalState\TestFixture\BlacklistedClass::class, 'attribute'));
    }
    public function testClassCanBeBlacklisted()
    {
        $this->blacklist->addClass(\_PhpScoper5bf3cbdac76b4\SebastianBergmann\GlobalState\TestFixture\BlacklistedClass::class);
        $this->assertTrue($this->blacklist->isStaticAttributeBlacklisted(\_PhpScoper5bf3cbdac76b4\SebastianBergmann\GlobalState\TestFixture\BlacklistedClass::class, 'attribute'));
    }
    public function testSubclassesCanBeBlacklisted()
    {
        $this->blacklist->addSubclassesOf(\_PhpScoper5bf3cbdac76b4\SebastianBergmann\GlobalState\TestFixture\BlacklistedClass::class);
        $this->assertTrue($this->blacklist->isStaticAttributeBlacklisted(\_PhpScoper5bf3cbdac76b4\SebastianBergmann\GlobalState\TestFixture\BlacklistedChildClass::class, 'attribute'));
    }
    public function testImplementorsCanBeBlacklisted()
    {
        $this->blacklist->addImplementorsOf(\_PhpScoper5bf3cbdac76b4\SebastianBergmann\GlobalState\TestFixture\BlacklistedInterface::class);
        $this->assertTrue($this->blacklist->isStaticAttributeBlacklisted(\_PhpScoper5bf3cbdac76b4\SebastianBergmann\GlobalState\TestFixture\BlacklistedImplementor::class, 'attribute'));
    }
    public function testClassNamePrefixesCanBeBlacklisted()
    {
        $this->blacklist->addClassNamePrefix('_PhpScoper5bf3cbdac76b4\\SebastianBergmann\\GlobalState');
        $this->assertTrue($this->blacklist->isStaticAttributeBlacklisted(\_PhpScoper5bf3cbdac76b4\SebastianBergmann\GlobalState\TestFixture\BlacklistedClass::class, 'attribute'));
    }
    public function testStaticAttributeCanBeBlacklisted()
    {
        $this->blacklist->addStaticAttribute(\_PhpScoper5bf3cbdac76b4\SebastianBergmann\GlobalState\TestFixture\BlacklistedClass::class, 'attribute');
        $this->assertTrue($this->blacklist->isStaticAttributeBlacklisted(\_PhpScoper5bf3cbdac76b4\SebastianBergmann\GlobalState\TestFixture\BlacklistedClass::class, 'attribute'));
    }
}
