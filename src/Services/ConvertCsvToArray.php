<?php


namespace App\Services;


class ConvertCsvToArray
{
    /**
     * @param        $filename
     * @param string $delimiter
     *
     * @return array|null
     */
    public function convert($filename, $delimiter = ';'): ?array
    {
        if(!file_exists($filename) || !is_readable($filename)) {
            return null;
        }

        $header = NULL;
        $data = array();

        if (($handle = fopen($filename, 'r')) !== FALSE) {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
                if(!$header) {
                    $header = $row;
                } else {
                    $data[] = array_combine($header, $row);
                }
            }
            fclose($handle);
        }

        return $data;
    }
}