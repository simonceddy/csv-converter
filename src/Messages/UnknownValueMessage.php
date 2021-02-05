<?php
namespace Eddy\CSVConverter\Messages;

use Eddy\CSVConverter\Support\IsMessage;

class UnknownValueMessage implements Message
{
    use IsMessage;

    public const TYPE = 'UNKNOWN_VALUE_MESSAGE';

    public function __construct(
        string $message = '',
        array $data = []
    ) {
        $this->message = $message;
        $this->data = $data;
    }

    public function type()
    {
        return static::TYPE;
    }
}
