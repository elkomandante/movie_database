<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200930210732 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE movie_name_profession (id INT AUTO_INCREMENT NOT NULL, movie_id INT DEFAULT NULL, name_id INT DEFAULT NULL, profession_id INT DEFAULT NULL, INDEX IDX_17AB13858F93B6FC (movie_id), INDEX IDX_17AB138571179CD6 (name_id), INDEX IDX_17AB1385FDEF8996 (profession_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE movie_name_profession ADD CONSTRAINT FK_17AB13858F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id)');
        $this->addSql('ALTER TABLE movie_name_profession ADD CONSTRAINT FK_17AB138571179CD6 FOREIGN KEY (name_id) REFERENCES name (id)');
        $this->addSql('ALTER TABLE movie_name_profession ADD CONSTRAINT FK_17AB1385FDEF8996 FOREIGN KEY (profession_id) REFERENCES profession (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE movie_name_profession');
    }
}
