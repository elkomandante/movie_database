<?php


namespace App\Import;


use App\Entity\Profession;

class ProfessionImporter extends ImportFather implements ImporterInterface
{

    const type = 'professions';

    public function supports($type)
    {
        return self::type === $type;
    }

    public function import()
    {
        $allProfessions = [];
        $handle = fopen($this->file,"r");

        for($i = 0 ; $row = fgets($handle); $i ++ ){
            if($i === 0) continue;
            $data = explode("\t",$row);
            $professions = explode(",",$data[4]);
            foreach ($professions as $profession){
                if(!in_array($profession,$allProfessions ) && !empty($profession)){
                    $allProfessions[]=$profession;
                }
            }
        }
        fclose($handle);

        foreach ($allProfessions as $profession){
            $professionEntity = new Profession();
            $professionEntity->setName($profession);
            $this->entityManager->persist($professionEntity);
        }
        $this->entityManager->flush();
    }
}