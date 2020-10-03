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
        $handle = fopen($this->file, "r");
        for ($i = 0; $row = fgets($handle); $i++) {
            if ($i === 0) continue;
            $data = explode("\t", $row);


            /**
             * @var Movie $movie
             */
            $movie = $this->entityManager->getRepository(Movie::class)->findOneBy(['tconst' => $data[0]]);

            if (!$movie) continue;

            $name = $this->entityManager->getRepository(Name::class)->findOneBy(['nconst' => $data[2]]);
            $profession = $this->entityManager->getRepository(Profession::class)->findOneBy(['name' => $data[3]]);


            if (!$profession || !$name) continue;

            echo $movie->getOriginalTitle()."\n";
            echo $profession->getName()."\n";
            echo $name->getName()."\n";

            echo "\n\n\n";

            $movieNameProfession = new MovieNameProfession();
            $movieNameProfession->setMovie($movie);
            $movieNameProfession->setName($name);
            $movieNameProfession->setProfession($profession);

            $this->entityManager->persist($movieNameProfession);
            $this->entityManager->flush();



        }

        fclose($handle);

        $this->entityManager->flush();
    }
}