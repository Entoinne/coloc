<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230316083815 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE room_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE task_id_seq CASCADE');
        $this->addSql('ALTER TABLE room DROP CONSTRAINT fk_729f519b8236fdd6');
        $this->addSql('ALTER TABLE task DROP CONSTRAINT fk_527edb2535f83ffc');
        $this->addSql('DROP TABLE room');
        $this->addSql('DROP TABLE task');
        $this->addSql('ALTER TABLE appartement ADD name VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE appartement ADD street_number INT DEFAULT NULL');
        $this->addSql('ALTER TABLE appartement ADD city VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE appartement ADD living_space DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE appartement ADD price DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE appartement ALTER address TYPE VARCHAR(255)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE room_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE task_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE room (id INT NOT NULL, appartement_id_id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_729f519b8236fdd6 ON room (appartement_id_id)');
        $this->addSql('CREATE TABLE task (id INT NOT NULL, room_id_id INT NOT NULL, name VARCHAR(255) NOT NULL, completion DOUBLE PRECISION NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_527edb2535f83ffc ON task (room_id_id)');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT fk_729f519b8236fdd6 FOREIGN KEY (appartement_id_id) REFERENCES appartement (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT fk_527edb2535f83ffc FOREIGN KEY (room_id_id) REFERENCES room (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE appartement DROP name');
        $this->addSql('ALTER TABLE appartement DROP street_number');
        $this->addSql('ALTER TABLE appartement DROP city');
        $this->addSql('ALTER TABLE appartement DROP living_space');
        $this->addSql('ALTER TABLE appartement DROP price');
        $this->addSql('ALTER TABLE appartement ALTER address TYPE TEXT');
    }
}
