<?php
namespace Eddy\CSVConverter;

class PayloadFactory
{
    public static function fromString(string $data): Payload
    {
        return new DefaultPayload(explode("\r\n", $data));
    }
}
