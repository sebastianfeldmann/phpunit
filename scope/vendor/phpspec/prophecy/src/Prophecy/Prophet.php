<?php

/*
 * This file is part of the Prophecy.
 * (c) Konstantin Kudryashov <ever.zet@gmail.com>
 *     Marcello Duarte <marcello.duarte@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace _PhpScoper5bf3cbdac76b4\Prophecy;

use _PhpScoper5bf3cbdac76b4\Prophecy\Doubler\Doubler;
use _PhpScoper5bf3cbdac76b4\Prophecy\Doubler\LazyDouble;
use _PhpScoper5bf3cbdac76b4\Prophecy\Doubler\ClassPatch;
use _PhpScoper5bf3cbdac76b4\Prophecy\Prophecy\ObjectProphecy;
use _PhpScoper5bf3cbdac76b4\Prophecy\Prophecy\RevealerInterface;
use _PhpScoper5bf3cbdac76b4\Prophecy\Prophecy\Revealer;
use _PhpScoper5bf3cbdac76b4\Prophecy\Call\CallCenter;
use _PhpScoper5bf3cbdac76b4\Prophecy\Util\StringUtil;
use _PhpScoper5bf3cbdac76b4\Prophecy\Exception\Prediction\PredictionException;
use _PhpScoper5bf3cbdac76b4\Prophecy\Exception\Prediction\AggregateException;
/**
 * Prophet creates prophecies.
 *
 * @author Konstantin Kudryashov <ever.zet@gmail.com>
 */
class Prophet
{
    private $doubler;
    private $revealer;
    private $util;
    /**
     * @var ObjectProphecy[]
     */
    private $prophecies = array();
    /**
     * Initializes Prophet.
     *
     * @param null|Doubler           $doubler
     * @param null|RevealerInterface $revealer
     * @param null|StringUtil        $util
     */
    public function __construct(\_PhpScoper5bf3cbdac76b4\Prophecy\Doubler\Doubler $doubler = null, \_PhpScoper5bf3cbdac76b4\Prophecy\Prophecy\RevealerInterface $revealer = null, \_PhpScoper5bf3cbdac76b4\Prophecy\Util\StringUtil $util = null)
    {
        if (null === $doubler) {
            $doubler = new \_PhpScoper5bf3cbdac76b4\Prophecy\Doubler\Doubler();
            $doubler->registerClassPatch(new \_PhpScoper5bf3cbdac76b4\Prophecy\Doubler\ClassPatch\SplFileInfoPatch());
            $doubler->registerClassPatch(new \_PhpScoper5bf3cbdac76b4\Prophecy\Doubler\ClassPatch\TraversablePatch());
            $doubler->registerClassPatch(new \_PhpScoper5bf3cbdac76b4\Prophecy\Doubler\ClassPatch\ThrowablePatch());
            $doubler->registerClassPatch(new \_PhpScoper5bf3cbdac76b4\Prophecy\Doubler\ClassPatch\DisableConstructorPatch());
            $doubler->registerClassPatch(new \_PhpScoper5bf3cbdac76b4\Prophecy\Doubler\ClassPatch\ProphecySubjectPatch());
            $doubler->registerClassPatch(new \_PhpScoper5bf3cbdac76b4\Prophecy\Doubler\ClassPatch\ReflectionClassNewInstancePatch());
            $doubler->registerClassPatch(new \_PhpScoper5bf3cbdac76b4\Prophecy\Doubler\ClassPatch\HhvmExceptionPatch());
            $doubler->registerClassPatch(new \_PhpScoper5bf3cbdac76b4\Prophecy\Doubler\ClassPatch\MagicCallPatch());
            $doubler->registerClassPatch(new \_PhpScoper5bf3cbdac76b4\Prophecy\Doubler\ClassPatch\KeywordPatch());
        }
        $this->doubler = $doubler;
        $this->revealer = $revealer ?: new \_PhpScoper5bf3cbdac76b4\Prophecy\Prophecy\Revealer();
        $this->util = $util ?: new \_PhpScoper5bf3cbdac76b4\Prophecy\Util\StringUtil();
    }
    /**
     * Creates new object prophecy.
     *
     * @param null|string $classOrInterface Class or interface name
     *
     * @return ObjectProphecy
     */
    public function prophesize($classOrInterface = null)
    {
        $this->prophecies[] = $prophecy = new \_PhpScoper5bf3cbdac76b4\Prophecy\Prophecy\ObjectProphecy(new \_PhpScoper5bf3cbdac76b4\Prophecy\Doubler\LazyDouble($this->doubler), new \_PhpScoper5bf3cbdac76b4\Prophecy\Call\CallCenter($this->util), $this->revealer);
        if ($classOrInterface && \class_exists($classOrInterface)) {
            return $prophecy->willExtend($classOrInterface);
        }
        if ($classOrInterface && \interface_exists($classOrInterface)) {
            return $prophecy->willImplement($classOrInterface);
        }
        return $prophecy;
    }
    /**
     * Returns all created object prophecies.
     *
     * @return ObjectProphecy[]
     */
    public function getProphecies()
    {
        return $this->prophecies;
    }
    /**
     * Returns Doubler instance assigned to this Prophet.
     *
     * @return Doubler
     */
    public function getDoubler()
    {
        return $this->doubler;
    }
    /**
     * Checks all predictions defined by prophecies of this Prophet.
     *
     * @throws Exception\Prediction\AggregateException If any prediction fails
     */
    public function checkPredictions()
    {
        $exception = new \_PhpScoper5bf3cbdac76b4\Prophecy\Exception\Prediction\AggregateException("Some predictions failed:\n");
        foreach ($this->prophecies as $prophecy) {
            try {
                $prophecy->checkProphecyMethodsPredictions();
            } catch (\_PhpScoper5bf3cbdac76b4\Prophecy\Exception\Prediction\PredictionException $e) {
                $exception->append($e);
            }
        }
        if (\count($exception->getExceptions())) {
            throw $exception;
        }
    }
}
