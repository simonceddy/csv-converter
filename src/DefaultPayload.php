<?php
namespace Eddy\CSVConverter;

class DefaultPayload implements Payload
{
    public function __construct(private array $data = [])
    {
        
    }

    public function data(): array
    {
        return $this->data;
    }

    public function set(array $data): Payload
    {
        return new static($data);
    }
}
