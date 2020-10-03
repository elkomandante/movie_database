<?php


namespace App\Import;


use App\Entity\Genre;

class MovieGenresImporter extends ImportFather implements ImporterInterface
{

    const type = 'movie_genres';

    public function supports($type)
    {
        return self::type === $type;
    }

    public function import()
    {
        $allGenres = $this->entityManager->getRepository(Genre::class)->findAll();

        $genres = [];

        foreach ($allGenres  as $genre){
            $genres[$genre->getName()] = [
                'genreId' => $genre->getId(),
                'movies' => []
            ];
        }

        $handle = fopen($this->file,"r");

        $sqlQuery = "Insert INTO movie_genre VALUES ";
        $newQuery = $sqlQuery;

        $genresInsertImport = $genres;


        for($i=0; $line = fgets($handle); $i++){
            if($i === 0) continue;
            $data = explode("\t", $line);
            if($data[1] !== "movie") continue;

            $movieGenres = explode(',',$data[8]);

            foreach ($movieGenres as $movieGenre ){
                $movieGenre = str_replace(' ', '-', $movieGenre); // Replaces all spaces with hyphens.
                $movieGenre =  preg_replace('/[^A-Za-z0-9\-]/', '', $movieGenre);

                if(!isset($genresInsertImport[$movieGenre])) continue;
                $genresInsertImport[$movieGenre]['movies'][] = $data[0];
            }

            if($i % 50000 === 0){
               foreach ($genresInsertImport as $insertArray){
                   foreach ($insertArray['movies'] as $movieId){
                       $newQuery .= sprintf("('%s',%s),",$movieId,$insertArray['genreId']);
                   }
               }

               $this->executeQuery(trim($newQuery,','));
               $newQuery = $sqlQuery;
               $genresInsertImport = $genres;
            }


        }

        fclose($handle);

        foreach ($genresInsertImport as $insertArray){
            foreach ($insertArray['movies'] as $movieId){
                $newQuery .= sprintf("('%s',%s),",$movieId,$insertArray['genreId']);
            }
        }

        $this->executeQuery(trim($newQuery,','));

    }

}