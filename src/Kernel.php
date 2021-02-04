<?php
namespace Eddy\CSVConverter;

use Eddy\CSVConverter\Support\ProcessesPayload;

class Kernel implements Processor
{
    use ProcessesPayload;

    private UnknownValues $unknownValues;

    private ColMap $colMap;

    public function __construct(
        array $processors = [],
        ColMap $colMap = null,
        UnknownValues $unknownValues = null
    ) {
        if (!empty($processors)) {
            // validate processors
        }
        $this->processors = $processors;
        $this->colMap = $colMap ?? new ColMap();
        $this->unknownValues = $unknownValues ?? new UnknownValues($this->colMap);
    }

    public function __invoke(Payload $payload): Payload
    {
        return $this->process($payload);
    }
}
