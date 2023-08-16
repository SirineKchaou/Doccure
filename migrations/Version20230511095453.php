<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230511095453 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE doctor_f ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE doctor_f ADD CONSTRAINT FK_638DA84212469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_638DA84212469DE2 ON doctor_f (category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE doctor_f DROP FOREIGN KEY FK_638DA84212469DE2');
        $this->addSql('DROP INDEX IDX_638DA84212469DE2 ON doctor_f');
        $this->addSql('ALTER TABLE doctor_f DROP category_id');
    }
}
