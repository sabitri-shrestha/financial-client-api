<?php


namespace App\Services;


use Illuminate\Support\Facades\Storage;
use League\Csv\Writer;

class CsvExportService
{
    public function export(array $data, string $filename)
    {
        $csv = Writer::createFromString('');
        $csv->insertOne(array_keys($data[0]));

        foreach ($data as $row) {
            $csv->insertOne($row);
        }

        return $csv->getContent();
    }
}
