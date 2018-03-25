<?php

namespace Accessory\Support;

class Regulator
{
    use Makable;

    /**
     * The subject of that the regulator
     * controls.
     *
     * @var mixed
     */
    protected $subject;

    /**
     * The determinant will determine if
     * any action call on the regulator
     * can be delegated to the subject.
     *
     * @var bool
     */
    protected $determinant = false;

    /**
     * Create and return a new instance of the Regulator.
     *
     * @param mixed   $subject
     * @param boolean $determinant
     */
    public function __construct($subject = null, $determinant = false)
    {
        $this->subject = $subject;
        $this->determinant = $determinant;
    }

    /**
     * Sets the subject to the regulator.
     *
     * @param mixed $subject
     *
     * @return self
     */
    public function regulates($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Will set the determinant
     * to true.
     *
     * @return self
     */
    public function approve()
    {
        $this->determinant = true;

        return $this;
    }

    /**
     * Will set the determinant
     * to false.
     *
     * @return self
     */
    public function reject()
    {
        $this->determinant = false;

        return $this;
    }

    /**
     * Delegates method to underlying subject.
     *
     * @param string $name
     * @param mixed  $arguments
     *
     * @return mixed
     *
     * @throws \InvalidArgumentException
     */
    public function __call($name, $arguments)
    {
        // Regulator is not approved.
        if (!$this->determinant) {
            return null;
        }

        // Subject is an Object.
        if (is_object($this->subject)) {
            return $this->subject->{$name}(...$arguments);
        }

        // Subject is a class name.
        if (is_string($this->subject)) {
            return $this->subject::{$name}(...$arguments);
        }

        throw new \InvalidArgumentException('Subject passed to regulator should be an object or class name.');
    }
}
