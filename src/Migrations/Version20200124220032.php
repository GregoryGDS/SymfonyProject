<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200124220032 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE video_game ADD game_editor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE video_game ADD CONSTRAINT FK_24BC6C50BB336D4E FOREIGN KEY (game_editor_id) REFERENCES editor (id)');
        $this->addSql('CREATE INDEX IDX_24BC6C50BB336D4E ON video_game (game_editor_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE video_game DROP FOREIGN KEY FK_24BC6C50BB336D4E');
        $this->addSql('DROP INDEX IDX_24BC6C50BB336D4E ON video_game');
        $this->addSql('ALTER TABLE video_game DROP game_editor_id');
    }
}
