<?php
namespace Eddy\CSVConverter\Support;

use Eddy\CSVConverter\{
    Exceptions\InvalidProcessorException,
    Payload,
    Processor
};

trait ProcessesPayload
{
    /**
     * Array of processors
     * 
     * @var Processor[]
     */
    protected array $processors = [];

    public function process(Payload $payload)
    {
        if (!empty($this->processors)) {
            foreach ($this->processors as $processor) {
                if (!($processor instanceof Processor)) {
                    throw new InvalidProcessorException();
                }
                $payload = call_user_func($processor, $payload);
            }
        }
        return $payload;
    }
}
