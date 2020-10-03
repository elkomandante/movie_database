<?php


namespace App\Import;



class MoviesImporter extends ImportFather implements ImporterInterface
{
    const type = 'movies';

    public function supports($type)
    {
        return self::type === $type;
    }

    public function import()
    {
        $handle = fopen($this->file,"r");
        $sqlQueryForMovies = "Insert INTO movie VALUES ";

        $newQueryForMovies = $sqlQueryForMovies;
        $conn = $this->entityManager->getConnection();

        for($i=0; $line = fgets($handle);$i++){
            if($i === 0) continue;
            $data = explode("\t",$line);
            if($data[1] !== "movie") continue;

            $newQueryForMovies .= sprintf("(%s,%s,%s,%s,%s,%s,%s),",$conn->quote($data[0]),$conn->quote($data[2]),$conn->quote($data[3]),$data[4],$conn->quote($data[5]),$conn->quote($data[6]),$conn->quote($data[7]));

            if($i % 50000 === 0){
                $this->executeQuery(trim($newQueryForMovies,','));
                $newQueryForMovies = $sqlQueryForMovies;
            }
        }

        fclose($handle);
        $this->executeQuery(trim($newQueryForMovies,','));

    }


}