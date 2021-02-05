<?php
namespace Eddy\CSVConverter;

interface DataHandler
{
    /**
     * Handle a data string
     *
     * @param string $data
     *
     * @return mixed
     */
    public function __invoke(string $data);
}
