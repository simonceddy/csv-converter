<?php
namespace Eddy\CSVConverter\Processors;

use Eddy\CSVConverter\{
    Payload,
    Processor,
    ColumnMap
};
use Evenement\EventEmitterInterface;

class LineToData implements Processor
{
    public function __construct(
        private ColumnMap $keys,
        private EventEmitterInterface $emitter,
        private array $handlers = []
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
                $this->emitter->emit('warning.index_mismatch', [$lineNo]);
            }

            // Iterate over bits - remove invalid - map to keys
            $data = [
                'lineNo' => $lineNo
            ];

            $keys = $this->keys->keys();

            foreach ($bits as $key => $bit) {
                if (!isset($keys[$key])
                    || ($mapping = $keys[$key]) === null
                ) {
                    continue;
                }

                $bit = htmlspecialchars($bit);

                if (!$mapping) {
                    if (mb_strlen($bit) < 1 
                        || $bit === '0'
                        || $bit === '.'
                    ) {
                        continue;
                    }

                    // Handle unknown values
                    $this->emitter->emit(
                        'warning.unknown_value',
                        [$lineNo, $key, $bit]
                    );
                } elseif (preg_match('/^[\.]+$/', $bit)) {
                    $data[$mapping] = null;
                } else {
                    if (isset($this->handlers[$mapping])) {
                        $bit = call_user_func(
                            $this->handlers[$mapping],
                            $bit
                        );
                    }
                    $data[$mapping] = $bit;
                }   
            }
            $converted[$lineNo] = $data;
        }

        return $payload->set($converted);
    }
}
