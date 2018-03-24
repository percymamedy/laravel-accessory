<?php

namespace Accessory\Support;

class Regulator
{
    use Makable;

    /**
     * The subject of that the regulator
     * controls.
     *
     * @var string
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
     * @param string  $subject
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
     * @param string $subject
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
     * Undocumented function
     *
     * @param string $name
     * @param mixed  $arguments
     *
     * @return void
     */
    public function __call($name, $arguments)
    {
        
    }
}
