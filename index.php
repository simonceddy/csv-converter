<?php
use Eddy\CSVConverter\{
    PIADGSLibraryMap,
    Kernel,
    PayloadFactory,
    Processors,
    Handlers,
};
use Evenement\EventEmitter;

require 'vendor/autoload.php';

$emitter = new EventEmitter();

$keys = new PIADGSLibraryMap();

$filename = __DIR__ . '/storage/catalogue.csv';

$contents = file_get_contents($filename);

$payload = PayloadFactory::fromString($contents);

$kernel = new Kernel($emitter, [
    new Processors\LineToData($keys, $emitter, [
        'authors' => new Handlers\AuthorsHandler(),
        'subjects' => new Handlers\SubjectsHandler(),
    ])
]);

// dd($payload);

$results = $kernel($payload)->data();
// dd($results);
/* $i = 0;

$last = null;

while(isset($results[$i]) && json_encode($results[$i])) {
    $last = $results[$i];
    $i++;
} */

// dd($last);

// dd(json_encode($results[count($results) - 12], JSON_PRETTY_PRINT));
file_put_contents(
    __DIR__ . '/storage/results.json',
    json_encode($results, JSON_PRETTY_PRINT)
);

if ($kernel->hasMessages()) {

    $messages = $kernel->getMessages();

    // foreach ($messages as $message) {
    //     // TODO handle messages
    // }
    dd(count($messages));
}


// dd(str_getcsv($lines[10]));
