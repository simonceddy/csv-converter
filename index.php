<?php

use Eddy\CSVConverter\{
    ColMap,
    Kernel,
    PayloadFactory,
    UnknownValues,
    Processors
};

require 'vendor/autoload.php';

$keys = new ColMap();

$filename = __DIR__ . '/storage/catalogue.csv';

$contents = file_get_contents($filename);

$payload = PayloadFactory::fromString($contents);

$unknownColVals = new UnknownValues($keys);

$kernel = new Kernel([
    new Processors\LineToData($keys, $unknownColVals)
]);

// dd($payload);

$results = $kernel($payload)->data();
dd($kernel);

// dd(str_getcsv($lines[10]));
