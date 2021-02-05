<?php
namespace Eddy\CSVConverter\Messages;

interface Message
{
    /**
     * Return the type of message
     *
     * @return string|int
     */
    public function type();

    /**
     * Render the message as a string.
     *
     * @return string
     */
    public function __toString();

    /**
     * Returns an optional array of data for use by handlers.
     * 
     * This can be handy for passing information about what generated the
     * message.
     * 
     * Can be empty or return null.
     *
     * @return array|null
     */
    public function data();
}
