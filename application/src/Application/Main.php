<?php

namespace Application;

class Main
{

    /**
     * @var array
     */
    protected $data;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->setData($data);
    }

    /**
     * @param array $data
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }

    /**
     * Placeholder method.
     *
     * This method must be removed when starting the assignment.
     *
     * @todo: Remove this method.
     */
    public function yourMethodCall()
    {
        // @todo: Implement method
    }
}
