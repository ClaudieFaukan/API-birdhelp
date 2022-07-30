<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220730213602 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE geographic_coordinate_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE geographic_coordinate (id INT NOT NULL, fiche_id INT DEFAULT NULL, longitude VARCHAR(255) NOT NULL, lattitude VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_EA3159E2DF522508 ON geographic_coordinate (fiche_id)');
        $this->addSql('ALTER TABLE geographic_coordinate ADD CONSTRAINT FK_EA3159E2DF522508 FOREIGN KEY (fiche_id) REFERENCES fiche (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE geographic_coordinate_id_seq CASCADE');
        $this->addSql('DROP TABLE geographic_coordinate');
    }
}
