<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230517201345 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE specialities (id INT AUTO_INCREMENT NOT NULL, names VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE doctor ADD specialities_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE doctor ADD CONSTRAINT FK_1FC0F36A804698D6 FOREIGN KEY (specialities_id) REFERENCES specialities (id)');
        $this->addSql('CREATE INDEX IDX_1FC0F36A804698D6 ON doctor (specialities_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE doctor DROP FOREIGN KEY FK_1FC0F36A804698D6');
        $this->addSql('DROP TABLE specialities');
        $this->addSql('DROP INDEX IDX_1FC0F36A804698D6 ON doctor');
        $this->addSql('ALTER TABLE doctor DROP specialities_id');
    }
}