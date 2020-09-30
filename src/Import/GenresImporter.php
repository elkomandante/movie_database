<?php


namespace App\Import;


use App\Entity\Genre;

class GenresImporter extends ImportFather implements ImporterInterface
{

    const type = 'genres';

    public function supports($type)
    {
        return self::type === $type;
    }

    public function import()
    {
        $allGenres = [];
        $handle = fopen($this->file,"r");
        for($i=0; $line = fgets($handle);$i++){
            if($i === 0) continue;

            $data = explode("\t",$line);

            if($data[1] !== "movie") continue;

            $genres = $data[8];

            if(!empty($genres)){
                $genres=explode(",",$genres);
                foreach ($genres as $genre){
                    if($genre === "\N") continue;
                    $genre = str_replace(' ', '-', $genre); // Replaces all spaces with hyphens.
                    $genre =  preg_replace('/[^A-Za-z0-9\-]/', '', $genre);

                    if(!in_array($genre,$allGenres)){
                        $allGenres[]=$genre;
                    }

                }

            }
        }
        fclose($handle);

        foreach ($allGenres as $genre){
            if($genre === "N") continue;
            $genreEntity = new Genre();
            $genreEntity->setName($genre);
            $this->entityManager->persist($genreEntity);
        }

        $this->entityManager->flush();
    }

}