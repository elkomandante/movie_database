<?php


namespace App\Import;


use App\Entity\Genre;
use App\Entity\Movie;

class MoviesImporter extends ImportFather implements ImporterInterface
{
    const type = 'title_basic';

    public function supports($type)
    {
        return self::type === $type;
    }

    public function import()
    {
        $handle = fopen($this->file,"r");
        for($i=0; $line = fgets($handle);$i++){
            if($i === 0) continue;
            $data = explode("\t",$line);
            if($data[1] !== "movie") continue;

            $movie= new Movie();
            $movie->setTconst($data[0]);
            $movie->setPrimaryTitle($data[2]);
            $movie->setOriginalTitle($data[3]);
            $movie->setIsAdult($data[4]);
            $movie->setStartYear($data[5]);
            $movie->setEndYear($data[6]);
            $movie->setRuntimeMinutes($data[7]);
            $this->entityManager->persist($movie);


            $genres = $data[8];

            if(!empty($genres)){
                $genres=explode(",",$genres);
                foreach ($genres as $genre){
                    if($genre === "\N") continue;
                    $genre = str_replace(' ', '-', $genre); // Replaces all spaces with hyphens.

                    $genre =  preg_replace('/[^A-Za-z0-9\-]/', '', $genre);

                    $existingGenre = $this->entityManager->getRepository(Genre::class)->findOneBy(['name'=>$genre]);

                    if(!$existingGenre) continue;

                    $existingGenre->addMovie($movie);
                    $movie->addCategory($existingGenre);

                }

            }

            if($i % 100 === 0){
                $this->entityManager->flush();
                $this->entityManager->clear();
                $this->entityManager->getUnitOfWork()->clear();
            }
        }
        $this->entityManager->flush();
        $this->entityManager->clear();
        $this->entityManager->getUnitOfWork()->clear();
        fclose($handle);

    }


}