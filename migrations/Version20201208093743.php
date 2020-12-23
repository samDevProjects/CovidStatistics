<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201208093743 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE records_hospital (records_id INT NOT NULL, hospital_id INT NOT NULL, INDEX IDX_A3B2DE01EE8A0C7B (records_id), INDEX IDX_A3B2DE0163DBB69 (hospital_id), PRIMARY KEY(records_id, hospital_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE records_lab (records_id INT NOT NULL, lab_id INT NOT NULL, INDEX IDX_CD3BFBEFEE8A0C7B (records_id), INDEX IDX_CD3BFBEF628913D5 (lab_id), PRIMARY KEY(records_id, lab_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE records_hospital ADD CONSTRAINT FK_A3B2DE01EE8A0C7B FOREIGN KEY (records_id) REFERENCES records (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE records_hospital ADD CONSTRAINT FK_A3B2DE0163DBB69 FOREIGN KEY (hospital_id) REFERENCES hospital (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE records_lab ADD CONSTRAINT FK_CD3BFBEFEE8A0C7B FOREIGN KEY (records_id) REFERENCES records (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE records_lab ADD CONSTRAINT FK_CD3BFBEF628913D5 FOREIGN KEY (lab_id) REFERENCES lab (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE records_hospital');
        $this->addSql('DROP TABLE records_lab');
    }
}
