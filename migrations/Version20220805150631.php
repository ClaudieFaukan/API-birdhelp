<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220805150631 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE health_status_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE health_status (id INT NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE fiche ADD healthstatus_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fiche ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fiche ADD date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE fiche ADD photo VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE fiche ADD description TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE fiche ADD CONSTRAINT FK_4C13CC78AD123873 FOREIGN KEY (healthstatus_id) REFERENCES health_status (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE fiche ADD CONSTRAINT FK_4C13CC7812469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_4C13CC78AD123873 ON fiche (healthstatus_id)');
        $this->addSql('CREATE INDEX IDX_4C13CC7812469DE2 ON fiche (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE fiche DROP CONSTRAINT FK_4C13CC78AD123873');
        $this->addSql('DROP SEQUENCE health_status_id_seq CASCADE');
        $this->addSql('DROP TABLE health_status');
        $this->addSql('ALTER TABLE fiche DROP CONSTRAINT FK_4C13CC7812469DE2');
        $this->addSql('DROP INDEX IDX_4C13CC78AD123873');
        $this->addSql('DROP INDEX IDX_4C13CC7812469DE2');
        $this->addSql('ALTER TABLE fiche DROP healthstatus_id');
        $this->addSql('ALTER TABLE fiche DROP category_id');
        $this->addSql('ALTER TABLE fiche DROP date');
        $this->addSql('ALTER TABLE fiche DROP photo');
        $this->addSql('ALTER TABLE fiche DROP description');
    }
}
