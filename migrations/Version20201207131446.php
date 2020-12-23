<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201207131446 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE city CHANGE city_postal_code city_postal_code VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE hospital DROP FOREIGN KEY FK_4282C85B8BAC62AF');
        $this->addSql('DROP INDEX IDX_4282C85B8BAC62AF ON hospital');
        $this->addSql('ALTER TABLE hospital CHANGE date_record date_record DATETIME NOT NULL, CHANGE city_id departement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE hospital ADD CONSTRAINT FK_4282C85BCCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id)');
        $this->addSql('CREATE INDEX IDX_4282C85BCCF9E01E ON hospital (departement_id)');
        $this->addSql('ALTER TABLE lab DROP FOREIGN KEY FK_61D6B1C48BAC62AF');
        $this->addSql('DROP INDEX IDX_61D6B1C48BAC62AF ON lab');
        $this->addSql('ALTER TABLE lab CHANGE date_record date_record DATETIME NOT NULL, CHANGE city_id departement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE lab ADD CONSTRAINT FK_61D6B1C4CCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id)');
        $this->addSql('CREATE INDEX IDX_61D6B1C4CCF9E01E ON lab (departement_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE city CHANGE city_postal_code city_postal_code VARCHAR(11) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE hospital DROP FOREIGN KEY FK_4282C85BCCF9E01E');
        $this->addSql('DROP INDEX IDX_4282C85BCCF9E01E ON hospital');
        $this->addSql('ALTER TABLE hospital CHANGE date_record date_record DATETIME DEFAULT NULL, CHANGE departement_id city_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE hospital ADD CONSTRAINT FK_4282C85B8BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('CREATE INDEX IDX_4282C85B8BAC62AF ON hospital (city_id)');
        $this->addSql('ALTER TABLE lab DROP FOREIGN KEY FK_61D6B1C4CCF9E01E');
        $this->addSql('DROP INDEX IDX_61D6B1C4CCF9E01E ON lab');
        $this->addSql('ALTER TABLE lab CHANGE date_record date_record DATETIME DEFAULT NULL, CHANGE departement_id city_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE lab ADD CONSTRAINT FK_61D6B1C48BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('CREATE INDEX IDX_61D6B1C48BAC62AF ON lab (city_id)');
    }
}
