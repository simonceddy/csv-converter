<?php
namespace Eddy\CSVConverter\Messages;

class MessagesHandler
{
    public function __construct(
        private array $resolvers = []
    ) {
    }
}
