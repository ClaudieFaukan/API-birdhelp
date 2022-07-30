<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220730213043 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE fiche_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE fiche (id INT NOT NULL, helper_id INT DEFAULT NULL, animal_id INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4C13CC78D7693E95 ON fiche (helper_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4C13CC788E962C16 ON fiche (animal_id)');
        $this->addSql('ALTER TABLE fiche ADD CONSTRAINT FK_4C13CC78D7693E95 FOREIGN KEY (helper_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE fiche ADD CONSTRAINT FK_4C13CC788E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE fiche_id_seq CASCADE');
        $this->addSql('DROP TABLE fiche');
    }
}
