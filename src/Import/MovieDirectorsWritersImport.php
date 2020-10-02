<?php


namespace App\Import;


use App\Entity\Movie;
use App\Entity\MovieNameProfession;
use App\Entity\Name;
use App\Entity\Profession;

class MovieDirectorsWritersImport extends ImportFather implements ImporterInterface
{


    const type = 'crew';

    public function supports($type)
    {
        return self::type === $type;
    }

    public function import()
    {
        $handle = fopen($this->file,"r");
        for($i = 0; $row = fgets($handle); $i++){
            if($i === 0) continue;
            $data = explode("\t",$row);
            $movie = $this->entityManager->getRepository(Movie::class)->findOneBy(['tconst' => $data[0]]);



            if(!$movie) continue;

            $directors = explode(",",$data[1]);
            $directorsProfession = $this->entityManager->getRepository(Profession::class)->findOneBy(['name' => 'director']);

            foreach ($directors as $director){
                $directorEntity = $this->entityManager->getRepository(Name::class)->findOneBy(['nconst' => $director]);
                if(!$directorEntity) continue;
                $movieNameProfession = new MovieNameProfession();
                $movieNameProfession->setMovie($movie);
                $movieNameProfession->setName($directorEntity);
                $movieNameProfession->setProfession($directorsProfession);
                $this->entityManager->persist($movieNameProfession);
            }

            $writers = explode(",",$data[2]);
            $writersProfession = $this->entityManager->getRepository(Profession::class)->findOneBy(['name' => 'writer']);


            foreach ($writers as $writer){
                $writerEntity = $this->entityManager->getRepository(Name::class)->findOneBy(['nconst'=>$writer]);
                if(!$writerEntity) continue;
                $movieNameProfession = new MovieNameProfession();
                $movieNameProfession->setMovie($movie);
                $movieNameProfession->setProfession($writersProfession);
                $movieNameProfession->setName($writerEntity);
                $this->entityManager->persist($movieNameProfession);
            }

        if($i % 100 === 0){
            $this->entityManager->flush();
            $this->entityManager->clear();
            $this->entityManager->getUnitOfWork()->clear();
        }


        }

        fclose($handle);

        $this->entityManager->flush();
    }
}