<?php


namespace App\Import;


use Doctrine\ORM\EntityManagerInterface;

class ImportFather
{
    /*** @var EntityManagerInterface */
    protected $entityManager;

    /*** @var string */
    protected $file;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function setFile(string $file)
    {
        $this->file =$file;
    }

    public function executeQuery($query){
        $conn = $this->entityManager->getConnection();
        $conn->prepare($query)->execute();
    }

}