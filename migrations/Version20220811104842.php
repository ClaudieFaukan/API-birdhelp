<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220811104842 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fiche ADD coordinate_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fiche DROP image');
        $this->addSql('ALTER TABLE fiche ADD CONSTRAINT FK_4C13CC7898BBE953 FOREIGN KEY (coordinate_id) REFERENCES geographic_coordinate (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4C13CC7898BBE953 ON fiche (coordinate_id)');
        $this->addSql('ALTER TABLE "user" ALTER first_name SET NOT NULL');
        $this->addSql('ALTER TABLE "user" ALTER last_name SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "user" ALTER first_name DROP NOT NULL');
        $this->addSql('ALTER TABLE "user" ALTER last_name DROP NOT NULL');
        $this->addSql('ALTER TABLE fiche DROP CONSTRAINT FK_4C13CC7898BBE953');
        $this->addSql('DROP INDEX UNIQ_4C13CC7898BBE953');
        $this->addSql('ALTER TABLE fiche ADD image BYTEA DEFAULT NULL');
        $this->addSql('ALTER TABLE fiche DROP coordinate_id');
    }
}
