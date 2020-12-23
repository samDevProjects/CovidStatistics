<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201201094413 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE hospital (id INT AUTO_INCREMENT NOT NULL, city_id INT DEFAULT NULL, deaths_number INT NOT NULL, record_date DATETIME NOT NULL, INDEX IDX_4282C85B8BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE record (id INT AUTO_INCREMENT NOT NULL, date VARCHAR(255) NOT NULL COMMENT \'(DC2Type:dateinterval)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE hospital ADD CONSTRAINT FK_4282C85B8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE lab ADD city_id INT DEFAULT NULL, ADD longitude DOUBLE PRECISION NOT NULL, ADD latitude DOUBLE PRECISION NOT NULL, ADD cases_number INT NOT NULL, ADD records_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE lab ADD CONSTRAINT FK_61D6B1C48BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('CREATE INDEX IDX_61D6B1C48BAC62AF ON lab (city_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE hospital');
        $this->addSql('DROP TABLE record');
        $this->addSql('ALTER TABLE lab DROP FOREIGN KEY FK_61D6B1C48BAC62AF');
        $this->addSql('DROP INDEX IDX_61D6B1C48BAC62AF ON lab');
        $this->addSql('ALTER TABLE lab DROP city_id, DROP longitude, DROP latitude, DROP cases_number, DROP records_date');
    }
}
