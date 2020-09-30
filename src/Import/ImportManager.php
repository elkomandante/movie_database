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

    public function runImport($file,$type)
    {

        foreach ($this->importers as $importer){
            if(!$importer->supports($type)) continue;
            $importer->setFile($file);
            $importer->import();
        }
    }
}