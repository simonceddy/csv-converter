<?php
namespace Eddy\CSVConverter;

interface Processor
{
    public function __invoke(Payload $payload): Payload;
}
