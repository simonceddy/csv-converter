<?php
namespace Eddy\CSVConverter;

class ColMap implements \Countable
{
    private array $keys = [
        false,
        'author',
        false,
        'title',
        false,
        'imprint',
        false,
        'pagination',
        false,
        'isbn',
        false,
        'series?',
        false,
        '???',
        'date',
        'source',
        'cost',
        false,
        false,
        'accession_number',
        'subjects'
    ];

    private int $amount;

    public function __construct()
    {
        $this->amount = count($this->keys);
    }

    /**
     * Return the mapping for the given key.
     * 
     * If the key is not found it will return null. Otherwise it will return
     * the mapping name string or false if the column has no mapping.
     *
     * @param int $key
     *
     * @return string|bool|null
     */
    public function key(int $key)
    {
        return $this->keys[$key] ?? null;
    }

    /**
     * Get the keys array
     *
     * @return array
     */
    public function keys()
    {
        return $this->keys;
    }

    /**
     * Return adjacent keys.
     *
     * @param int $key
     *
     * @return array|null
     */
    public function adjacent(int $key)
    {
        if ($key < 0
            || $key >= $this->amount
        ) {
            return null;
        }
        return [
            $key === 0 ? null : $this->keys[$key - 1],
            $key >= $this->amount ? null : $this->keys[$key + 1]
        ];

    }

    public function count()
    {
        return count($this->keys);
    }
}
