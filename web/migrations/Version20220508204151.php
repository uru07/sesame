<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220508204151 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE work_entry DROP FOREIGN KEY FK_3DAE65F9D86650F');
        $this->addSql('DROP INDEX IDX_3DAE65F9D86650F ON work_entry');
        $this->addSql('ALTER TABLE work_entry CHANGE user_id_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE work_entry ADD CONSTRAINT FK_3DAE65FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_3DAE65FA76ED395 ON work_entry (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE work_entry DROP FOREIGN KEY FK_3DAE65FA76ED395');
        $this->addSql('DROP INDEX IDX_3DAE65FA76ED395 ON work_entry');
        $this->addSql('ALTER TABLE work_entry CHANGE user_id user_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE work_entry ADD CONSTRAINT FK_3DAE65F9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_3DAE65F9D86650F ON work_entry (user_id_id)');
    }
}
