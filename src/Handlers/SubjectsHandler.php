<?php
namespace Eddy\CSVConverter\Handlers;

use Eddy\CSVConverter\DataHandler;

class SubjectsHandler implements DataHandler
{
    private function splitSubjects(string $subjects)
    {
        $bits = explode('  ', $subjects);
        $results = array_map(function (string $bit) {
            // return 'here';
            // TODO remove number at start of subject
            // dd(preg_match('/^([0-9]*\.)/', $bit), $bit);
            
            if (preg_match('/^([0-9]*\.)/', $bit = trim($bit))) {
                $result = preg_replace('/^([0-9]*\.)/', '', $bit);
                if (strlen(trim($result) < 1)) {
                    return $bit;
                }
                // dd($result, $bit);
                $bit = $result;
            }
            return trim($bit);
        }, $bits);

        return array_filter($results, function (string $subject) {
            return mb_strlen($subject) >= 1;
        });
    }

    public function __invoke(string $subjects)
    {
        if (preg_match('/\s+/', $subjects)) {
            return $this->splitSubjects($subjects);
        }
        
        return [$subjects];
    }
}
