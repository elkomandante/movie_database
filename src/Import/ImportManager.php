<?php


namespace App\Import;


class ImportManager
{
    /**
     * @var iterable
     */
    private $importers;

    public function __construct(iterable $importers)
    {
        $this->importers = $importers;
    }

    public function runImport($file)
    {

        foreach ($this->importers as $importer){
            $importer->setFile($file);
            $importer->import();
        }
    }
}