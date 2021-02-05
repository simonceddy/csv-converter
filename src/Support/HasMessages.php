<?php
namespace Eddy\CSVConverter\Support;

use Eddy\CSVConverter\Messages\Message;

trait HasMessages
{
    /**
     * Array of messages generated during process
     * 
     * @var string[]
     */
    protected array $messages = [];

    public function hasMessages()
    {
        return !empty($this->messages);
    }

    /**
     * Get array of messages generated during process
     *
     * @return Message[]
     */ 
    public function getMessages()
    {
        return $this->messages;
    }
}
