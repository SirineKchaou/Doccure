<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231007095650 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F844E2BAFF7B');
        $this->addSql('DROP INDEX UNIQ_FE38F844E2BAFF7B ON appointment');
        $this->addSql('ALTER TABLE appointment CHANGE doctor_name_id doctor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F84487F4FB17 FOREIGN KEY (doctor_id) REFERENCES doctor (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FE38F84487F4FB17 ON appointment (doctor_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appointment DROP FOREIGN KEY FK_FE38F84487F4FB17');
        $this->addSql('DROP INDEX UNIQ_FE38F84487F4FB17 ON appointment');
        $this->addSql('ALTER TABLE appointment CHANGE doctor_id doctor_name_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE appointment ADD CONSTRAINT FK_FE38F844E2BAFF7B FOREIGN KEY (doctor_name_id) REFERENCES doctor (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FE38F844E2BAFF7B ON appointment (doctor_name_id)');
    }
}
