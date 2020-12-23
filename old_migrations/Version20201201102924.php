<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201201102924 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hospital DROP record_date');
        $this->addSql('ALTER TABLE lab DROP records_date');
        $this->addSql('ALTER TABLE record ADD lab_id INT DEFAULT NULL, ADD hospital_id INT DEFAULT NULL, ADD week_record DATETIME NOT NULL');
        $this->addSql('ALTER TABLE record ADD CONSTRAINT FK_9B349F91628913D5 FOREIGN KEY (lab_id) REFERENCES lab (id)');
        $this->addSql('ALTER TABLE record ADD CONSTRAINT FK_9B349F9163DBB69 FOREIGN KEY (hospital_id) REFERENCES hospital (id)');
        $this->addSql('CREATE INDEX IDX_9B349F91628913D5 ON record (lab_id)');
        $this->addSql('CREATE INDEX IDX_9B349F9163DBB69 ON record (hospital_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hospital ADD record_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE lab ADD records_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE record DROP FOREIGN KEY FK_9B349F91628913D5');
        $this->addSql('ALTER TABLE record DROP FOREIGN KEY FK_9B349F9163DBB69');
        $this->addSql('DROP INDEX IDX_9B349F91628913D5 ON record');
        $this->addSql('DROP INDEX IDX_9B349F9163DBB69 ON record');
        $this->addSql('ALTER TABLE record DROP lab_id, DROP hospital_id, DROP week_record');
    }
}
