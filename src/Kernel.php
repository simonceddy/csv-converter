<?php
namespace Eddy\CSVConverter;

use Eddy\CSVConverter\Support\HasMessages;
use Eddy\CSVConverter\Support\ProcessesPayload;
use Evenement\EventEmitterInterface;

class Kernel implements Processor
{
    use ProcessesPayload, HasMessages;

    public function __construct(
        private EventEmitterInterface $emitter,
        array $processors = []
    ) {
        if (!empty($processors)) {
            // validate processors
        }
        $this->processors = $processors;

        $this->registerEvents();
    }

    private function registerEvents()
    {
        // TODO remove event registration from kernel
        $this->emitter->on('warning.index_mismatch', function (int $lineNo) {
            $this->messages[] = new Messages\WarningMessage(
                'An index mismatch occurred on ' . $lineNo,
                [
                    'type' => 'index_mismatch',
                    'lineNo' => $lineNo
                ]
            );
        });
        
        $this->emitter->on(
            'warning.unknown_value',
            function ($lineNo, $key, $bit) {
                $this->messages[] = new Messages\UnknownValueMessage(
                    "Unknown index value pair: {$key} => {$bit} on line {$lineNo}.",
                    [
                        'index' => $key,
                        'value' => $bit,
                        'lineNo' => $lineNo
                    ]
                );
            }
        );
    }

    public function __invoke(Payload $payload): Payload
    {
        return $this->process($payload);
    }   
}
