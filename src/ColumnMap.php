<?php
namespace Eddy\CSVConverter;

interface ColumnMap
{
    /**
     * Returns an array of column keys.
     * 
     * Must return a sequential array where the index equals the column index
     * and the value equals the associative key for that column.
     * 
     * The value can also equal false. This specifies that the column should
     * be ignored.
     *
     * E.g. return ['name', false, 'quote'];
     * 
     * In the above example the first column is mapped to 'name' and the 
     * third column is mapped to 'quote', while the second column is ignored.
     * 
     * @return array
     */
    public function keys(): array;

    /**
     * Returns adjacent keys to the given index.
     *
     * Adjacent keys are returned in an array, with the first element being
     * the preceding key and the second element the successive key.
     * 
     * If an adjacent key cannot be resolved (e.g. the first key will never
     * have a preceding key) the returned array should contain null in place
     * of the unresolved key.
     * 
     * Should return null if the given index is outside the range of the keys
     * array.
     * 
     * @param int $index
     *
     * @return array|null
     */
    public function adjacent(int $index);
}
