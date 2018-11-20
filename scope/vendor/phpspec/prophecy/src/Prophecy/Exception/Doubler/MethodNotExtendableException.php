<?php

namespace _PhpScoper5bf3cbdac76b4\Prophecy\Exception\Doubler;

class MethodNotExtendableException extends \_PhpScoper5bf3cbdac76b4\Prophecy\Exception\Doubler\DoubleException
{
    private $methodName;
    private $className;
    /**
     * @param string $message
     * @param string $className
     * @param string $methodName
     */
    public function __construct($message, $className, $methodName)
    {
        parent::__construct($message);
        $this->methodName = $methodName;
        $this->className = $className;
    }
    /**
     * @return string
     */
    public function getMethodName()
    {
        return $this->methodName;
    }
    /**
     * @return string
     */
    public function getClassName()
    {
        return $this->className;
    }
}
