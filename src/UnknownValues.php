<?php
namespace Eddy\CSVConverter;

class UnknownValues
{
    private array $data = [];

    public function __construct(private ColMap $colMap)
    {
        
    }

    /**
     * Init data row for a new line.
     * 
     * Does nothing if the line already exists.
     *
     * @param int $line
     *
     * @return static
     */
    public function addLine(int $line)
    {
        isset($this->data[$line]) ?: $this->data[$line] = [];

        return $this;
    }

    public function add(int $line, int $key, string $val = null)
    {
        isset($this->data[$line]) ?: $this->addLine($line);

        $this->data[$line][$key] = [
            'val' => $val,
            'adjacent_keys' => $this->colMap->adjacent($key)
        ];
        return $this;
    }

    /**
     * Get the value of data
     */ 
    public function getValues()
    {
        return $this->data;
    }
}
