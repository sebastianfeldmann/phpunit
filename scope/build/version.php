#!/usr/bin/env php
<?php 
namespace _PhpScoper5bf3cbdac76b4;

require __DIR__ . '/../vendor/autoload.php';
use _PhpScoper5bf3cbdac76b4\SebastianBergmann\Version;
$buffer = \file_get_contents(__DIR__ . '/../src/Runner/Version.php');
$start = \strpos($buffer, 'new VersionId(\'') + \strlen('new VersionId(\'');
$end = \strpos($buffer, '\'', $start);
$version = \substr($buffer, $start, $end - $start);
$version = new \_PhpScoper5bf3cbdac76b4\SebastianBergmann\Version($version, __DIR__ . '/../');
print $version->getVersion();
