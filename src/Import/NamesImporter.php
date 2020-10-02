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
        $handle = fopen($this->file,"r");

        for($i = 0 ; $row = fgets($handle); $i ++ ){

            if($i === 0) continue;

            $data = explode("\t",$row);
            $nameEntity = new Name();
            $nameEntity->setName($data[1]);
            $nameEntity->setNconst($data[0]);
            $nameEntity->setBirthYear(is_numeric($data[2])? (int)$data[2] : 0);
            $nameEntity->setDeathYear(is_numeric($data[3])? (int)$data[3] : 0);
            $this->entityManager->persist($nameEntity);

            $professions = explode(",",$data[4]);

            foreach ($professions as $profession){
                /*** @var $professionEntity Profession */
                $professionEntity = $this->entityManager->getRepository(Profession::class)->findOneBy(['name' => $profession]);
                if(!$professionEntity) continue;
                $professionEntity->addName($nameEntity);
                $nameEntity->addProfession($professionEntity);
;
            }

            if($i % 100000  === 0){
                $this->entityManager->flush();
                $this->entityManager->clear();
                $this->entityManager->getUnitOfWork()->clear();
            }
        }

        $this->entityManager->flush();
        fclose($handle);
    }
}