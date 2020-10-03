<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201003190550 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE genre (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movie (id VARCHAR(255) NOT NULL, tconst VARCHAR(255) NOT NULL, primary_title VARCHAR(255) NOT NULL, original_title VARCHAR(255) NOT NULL, is_adult TINYINT(1) DEFAULT NULL, start_year VARCHAR(255) DEFAULT NULL, end_year VARCHAR(255) DEFAULT NULL, runtime_minutes VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movie_genre (movie_id VARCHAR(255) NOT NULL, genre_id INT NOT NULL, INDEX IDX_FD1229648F93B6FC (movie_id), INDEX IDX_FD1229644296D31F (genre_id), PRIMARY KEY(movie_id, genre_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movie_name_profession (id INT AUTO_INCREMENT NOT NULL, movie_id VARCHAR(255) DEFAULT NULL, name_id INT DEFAULT NULL, profession_id INT DEFAULT NULL, INDEX IDX_17AB13858F93B6FC (movie_id), INDEX IDX_17AB138571179CD6 (name_id), INDEX IDX_17AB1385FDEF8996 (profession_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE name (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, birth_year INT NOT NULL, death_year INT NOT NULL, nconst VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profession (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profession_name (profession_id INT NOT NULL, name_id INT NOT NULL, INDEX IDX_84318367FDEF8996 (profession_id), INDEX IDX_8431836771179CD6 (name_id), PRIMARY KEY(profession_id, name_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE movie_genre ADD CONSTRAINT FK_FD1229648F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie_genre ADD CONSTRAINT FK_FD1229644296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie_name_profession ADD CONSTRAINT FK_17AB13858F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id)');
        $this->addSql('ALTER TABLE movie_name_profession ADD CONSTRAINT FK_17AB138571179CD6 FOREIGN KEY (name_id) REFERENCES name (id)');
        $this->addSql('ALTER TABLE movie_name_profession ADD CONSTRAINT FK_17AB1385FDEF8996 FOREIGN KEY (profession_id) REFERENCES profession (id)');
        $this->addSql('ALTER TABLE profession_name ADD CONSTRAINT FK_84318367FDEF8996 FOREIGN KEY (profession_id) REFERENCES profession (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE profession_name ADD CONSTRAINT FK_8431836771179CD6 FOREIGN KEY (name_id) REFERENCES name (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE movie_genre DROP FOREIGN KEY FK_FD1229644296D31F');
        $this->addSql('ALTER TABLE movie_genre DROP FOREIGN KEY FK_FD1229648F93B6FC');
        $this->addSql('ALTER TABLE movie_name_profession DROP FOREIGN KEY FK_17AB13858F93B6FC');
        $this->addSql('ALTER TABLE movie_name_profession DROP FOREIGN KEY FK_17AB138571179CD6');
        $this->addSql('ALTER TABLE profession_name DROP FOREIGN KEY FK_8431836771179CD6');
        $this->addSql('ALTER TABLE movie_name_profession DROP FOREIGN KEY FK_17AB1385FDEF8996');
        $this->addSql('ALTER TABLE profession_name DROP FOREIGN KEY FK_84318367FDEF8996');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE movie');
        $this->addSql('DROP TABLE movie_genre');
        $this->addSql('DROP TABLE movie_name_profession');
        $this->addSql('DROP TABLE name');
        $this->addSql('DROP TABLE profession');
        $this->addSql('DROP TABLE profession_name');
    }
}
