<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201121044305 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bsu_user (id UUID NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN bsu_user.id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE bsu_user_task (id UUID NOT NULL, user_id UUID DEFAULT NULL, description TEXT NOT NULL, state VARCHAR(20) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3B93DAA5A76ED395 ON bsu_user_task (user_id)');
        $this->addSql('COMMENT ON COLUMN bsu_user_task.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN bsu_user_task.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN bsu_user_task.state IS \'(DC2Type:App\\Entity\\UserTaskState)\'');
        $this->addSql('ALTER TABLE bsu_user_task ADD CONSTRAINT FK_3B93DAA5A76ED395 FOREIGN KEY (user_id) REFERENCES bsu_user (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bsu_user_task DROP CONSTRAINT FK_3B93DAA5A76ED395');
        $this->addSql('DROP TABLE bsu_user');
        $this->addSql('DROP TABLE bsu_user_task');
    }
}
