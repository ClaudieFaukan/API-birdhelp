<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220830143651 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fiche (id INT NOT NULL, helper_id INT DEFAULT NULL, animal_id INT DEFAULT NULL, healthstatus_id INT DEFAULT NULL, category_id INT DEFAULT NULL, coordinate_id INT DEFAULT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, photo VARCHAR(255) DEFAULT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4C13CC78D7693E95 ON fiche (helper_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4C13CC788E962C16 ON fiche (animal_id)');
        $this->addSql('CREATE INDEX IDX_4C13CC78AD123873 ON fiche (healthstatus_id)');
        $this->addSql('CREATE INDEX IDX_4C13CC7812469DE2 ON fiche (category_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4C13CC7898BBE953 ON fiche (coordinate_id)');
        $this->addSql('ALTER TABLE fiche ADD CONSTRAINT FK_4C13CC78D7693E95 FOREIGN KEY (helper_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE fiche ADD CONSTRAINT FK_4C13CC788E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE fiche ADD CONSTRAINT FK_4C13CC78AD123873 FOREIGN KEY (healthstatus_id) REFERENCES health_status (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE fiche ADD CONSTRAINT FK_4C13CC7812469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE fiche ADD CONSTRAINT FK_4C13CC7898BBE953 FOREIGN KEY (coordinate_id) REFERENCES geographic_coordinate (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE animal ALTER color DROP NOT NULL');
        $this->addSql('ALTER TABLE geographic_coordinate ALTER diff_dist SET NOT NULL');
        $this->addSql('ALTER TABLE geographic_coordinate ADD CONSTRAINT FK_EA3159E2DF522508 FOREIGN KEY (fiche_id) REFERENCES fiche (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE geographic_coordinate DROP CONSTRAINT FK_EA3159E2DF522508');
        $this->addSql('DROP TABLE fiche');
        $this->addSql('ALTER TABLE animal ALTER color SET NOT NULL');
        $this->addSql('ALTER TABLE geographic_coordinate ALTER diff_dist DROP NOT NULL');
    }
}
