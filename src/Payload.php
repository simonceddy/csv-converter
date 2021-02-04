<?php
namespace Eddy\CSVConverter;

interface Payload
{
    /**
     * Get the data array.
     *
     * @return array
     */
    public function data(): array;

    /**
     * Set the payload data.
     * 
     * This method should return a new Payload instance.
     *
     * @param array $data
     *
     * @return Payload
     */
    public function set(array $data): Payload;
}
