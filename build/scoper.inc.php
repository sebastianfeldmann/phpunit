<?php
declare(strict_types=1);
/*
 * This file is part of PHPUnit.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [
    'whitelist-global-classes' => false,

    'whitelist' => [
        'PHPUnit\*',
        'SebastianBergmann\CodeCoverage\*',
        'PharIo\*',
        'PHP_Token*',
        'PHPUnit_Framework_MockObject_MockObject',
        'MultiDependencyTest',
    ],
];
