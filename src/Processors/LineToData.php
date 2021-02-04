<?php
namespace Eddy\CSVConverter\Processors;

use Eddy\CSVConverter\{
    Payload,
    Processor,
    ColMap,
    UnknownValues
};

class LineToData implements Processor
{
    private array $countMismatches = [];

    public function __construct(
        private ColMap $keys,
        private UnknownValues $unknownVals
    ) {
        
    }

    public function __invoke(Payload $payload): Payload
    {
        // TODO split up a bit
        $converted = [];
        $lines = $payload->data();

        $count = count($this->keys);

        // Iterate over lines and convert CSV to array
        foreach ($lines as $lineNo => $line) {
            $bits = str_getcsv($line);

            // TODO: Log count mismatch
            if (count($bits) !== $count) {
                $this->countMismatches[] = $lineNo;
            }

            // Iterate over bits - remove invalid - map to keys
            $data = [];

            foreach ($bits as $key => $bit) {
                if (($mapping = $this->keys->key($key)) === null) {
                    continue;
                }

                if (!$mapping) {
                    if (mb_strlen($bit) < 1 
                        || $bit === '0'
                        || preg_match('/^[.]+$/', $bit)
                    ) {
                        continue;
                    }

                    // Handle unknown values
                    $this->unknownVals->add($lineNo, $key, $bit);
                } else {
                    $data[$mapping] = $bit;
                }   
            }
            $converted[$lineNo] = $data;
        }

        return $payload->set($converted);
    }
}
