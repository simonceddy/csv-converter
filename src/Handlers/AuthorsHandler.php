<?php
namespace Eddy\CSVConverter\Handlers;

use Eddy\CSVConverter\DataHandler;

class AuthorsHandler implements DataHandler
{
    private function splitAuthor(string $data, int $splitPos)
    {
        return [
            'surname' => trim(mb_substr($data, 0, $splitPos)),
            'givenNames' => trim(mb_substr($data, $splitPos + 1)),
        ];
    }

    private function splitMultipleAuthors(string $authors)
    {
        if (!preg_match('/&/', $authors)) {
            return false;
        }
        return preg_split('/&/', html_entity_decode($authors));
        
    }

    private function singleNameAuthor(string $author)
    {
        return [
            'surname' => $author
        ];
    }

    public function __invoke(string $authors)
    {
        // TODO handle names that don't match the pattern
        $lastComma = mb_strrpos($authors, ',');

        
        if (!$lastComma) {
            return $this->singleNameAuthor($authors);
        }

        if (mb_strpos($authors, ',') !== $lastComma) {
            // TODO Handle multiple authors
            $bits = $this->splitMultipleAuthors($authors);

            if (!$bits) {
                return $this->singleNameAuthor($authors);
            }

            return array_map(function (string $author) {
                $bitComma = mb_strrpos($author, ',');
        
                if (!$bitComma) {
                    return $this->singleNameAuthor($author);
                }
                return $this->splitAuthor($author, $bitComma);
            }, $bits);
        }

        return [
            $this->splitAuthor($authors, $lastComma)
        ];
    }
}
