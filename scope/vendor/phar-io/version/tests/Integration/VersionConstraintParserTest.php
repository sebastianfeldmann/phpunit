<?php

/*
 * This file is part of PharIo\Version.
 *
 * (c) Arne Blankerts <arne@blankerts.de>, Sebastian Heuer <sebastian@phpeople.de>, Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace PharIo\Version;

use PHPUnit\Framework\TestCase;
/**
 * @covers \PharIo\Version\VersionConstraintParser
 */
class VersionConstraintParserTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider versionStringProvider
     *
     * @param string $versionString
     * @param VersionConstraint $expectedConstraint
     */
    public function testReturnsExpectedConstraint($versionString, \PharIo\Version\VersionConstraint $expectedConstraint)
    {
        $parser = new \PharIo\Version\VersionConstraintParser();
        $this->assertEquals($expectedConstraint, $parser->parse($versionString));
    }
    /**
     * @dataProvider unsupportedVersionStringProvider
     *
     * @param string $versionString
     */
    public function testThrowsExceptionIfVersionStringIsNotSupported($versionString)
    {
        $parser = new \PharIo\Version\VersionConstraintParser();
        $this->expectException(\PharIo\Version\UnsupportedVersionConstraintException::class);
        $parser->parse($versionString);
    }
    /**
     * @return array
     */
    public function versionStringProvider()
    {
        return [['1.0.2', new \PharIo\Version\ExactVersionConstraint('1.0.2')], ['~4.6', new \PharIo\Version\AndVersionConstraintGroup('~4.6', [new \PharIo\Version\GreaterThanOrEqualToVersionConstraint('~4.6', new \PharIo\Version\Version('4.6')), new \PharIo\Version\SpecificMajorVersionConstraint('~4.6', 4)])], ['~4.6.2', new \PharIo\Version\AndVersionConstraintGroup('~4.6.2', [new \PharIo\Version\GreaterThanOrEqualToVersionConstraint('~4.6.2', new \PharIo\Version\Version('4.6.2')), new \PharIo\Version\SpecificMajorAndMinorVersionConstraint('~4.6.2', 4, 6)])], ['^2.6.1', new \PharIo\Version\AndVersionConstraintGroup('^2.6.1', [new \PharIo\Version\GreaterThanOrEqualToVersionConstraint('^2.6.1', new \PharIo\Version\Version('2.6.1')), new \PharIo\Version\SpecificMajorVersionConstraint('^2.6.1', 2)])], ['5.1.*', new \PharIo\Version\SpecificMajorAndMinorVersionConstraint('5.1.*', 5, 1)], ['5.*', new \PharIo\Version\SpecificMajorVersionConstraint('5.*', 5)], ['*', new \PharIo\Version\AnyVersionConstraint()], ['1.0.2 || 1.0.5', new \PharIo\Version\OrVersionConstraintGroup('1.0.2 || 1.0.5', [new \PharIo\Version\ExactVersionConstraint('1.0.2'), new \PharIo\Version\ExactVersionConstraint('1.0.5')])], ['^5.6 || ^7.0', new \PharIo\Version\OrVersionConstraintGroup('^5.6 || ^7.0', [new \PharIo\Version\AndVersionConstraintGroup('^5.6', [new \PharIo\Version\GreaterThanOrEqualToVersionConstraint('^5.6', new \PharIo\Version\Version('5.6')), new \PharIo\Version\SpecificMajorVersionConstraint('^5.6', 5)]), new \PharIo\Version\AndVersionConstraintGroup('^7.0', [new \PharIo\Version\GreaterThanOrEqualToVersionConstraint('^7.0', new \PharIo\Version\Version('7.0')), new \PharIo\Version\SpecificMajorVersionConstraint('^7.0', 7)])])], ['7.0.28-1', new \PharIo\Version\ExactVersionConstraint('7.0.28-1')], ['^3.0.0-alpha1', new \PharIo\Version\AndVersionConstraintGroup('^3.0.0-alpha1', [new \PharIo\Version\GreaterThanOrEqualToVersionConstraint('^3.0.0-alpha1', new \PharIo\Version\Version('3.0.0-alpha1')), new \PharIo\Version\SpecificMajorVersionConstraint('^3.0.0-alpha1', 3)])], ['^3.0.0-alpha.1', new \PharIo\Version\AndVersionConstraintGroup('^3.0.0-alpha.1', [new \PharIo\Version\GreaterThanOrEqualToVersionConstraint('^3.0.0-alpha.1', new \PharIo\Version\Version('3.0.0-alpha.1')), new \PharIo\Version\SpecificMajorVersionConstraint('^3.0.0-alpha.1', 3)])]];
    }
    public function unsupportedVersionStringProvider()
    {
        return [['foo'], ['+1.0.2'], ['>=2.0'], ['^5.6 || >= 7.0'], ['2.0 || foo']];
    }
}
