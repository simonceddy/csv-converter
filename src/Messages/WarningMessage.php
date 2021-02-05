<?php
namespace Eddy\CSVConverter\Messages;

use Eddy\CSVConverter\Support\IsMessage;

class WarningMessage implements Message
{
    use IsMessage;

    public const TYPE = 'WARNING_MESSAGE';

    public function __construct(
        string $message = 'A warning was generated',
        array $data = []
    )
    {
        $this->message = $message;
        $this->data = $data;
    }

    public function type()
    {
        return static::TYPE;
    }

}