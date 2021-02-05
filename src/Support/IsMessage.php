<?php
namespace Eddy\CSVConverter\Support;

trait IsMessage
{
    protected string $message = 'I\'m the default message.';

    protected array $data = [];

    abstract public function type();

    public function message()
    {
        return $this->message;
    }

    public function __toString()
    {
        // TODO format with data?
        return $this->message();
    }

    /**
     * Get an array containing any message data
     * 
     * @return array
     */ 
    public function data()
    {
        return $this->data;
    }
}