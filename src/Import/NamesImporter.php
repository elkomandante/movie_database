<?php


namespace App\Import;


use App\Entity\Genre;
use App\Entity\Name;
use App\Entity\Profession;

class NamesImporter extends ImportFather implements ImporterInterface
{

    const type = 'names';

    public function supports($type)
    {
        return self::type === $type;
    }


    public function import()
    {
        $sqlQuery = "INSERT INTO name VALUES ";
        $newQuery = $sqlQuery;

        $handle = fopen($this->file,"r");
        $conn = $this->entityManager->getConnection();

        for($i = 0 ; $row = fgets($handle); $i ++ ){

            if($i === 0) continue;

            $data = explode("\t",$row);

            $newQuery .= sprintf("(%s,%s,%s,%s),",$conn->quote($data[0]),$conn->quote($data[1]),is_numeric($data[2])? (int)$data[2] : 0,is_numeric($data[3])? (int)$data[3] : 0);



            /*
            $professions = explode(",",$data[4]);

            foreach ($professions as $profession){
                 @var $professionEntity Profession
                $professionEntity = $this->entityManager->getRepository(Profession::class)->findOneBy(['name' => $profession]);
                if(!$professionEntity) continue;
                $professionEntity->addName($nameEntity);
                $nameEntity->addProfession($professionEntity);
;
            }
            */

            if($i % 200000  === 0){
                $this->executeQuery(rtrim($newQuery,','));
                $newQuery = $sqlQuery;
            }
        }

        fclose($handle);
        $this->executeQuery(rtrim($newQuery,','));
    }
}