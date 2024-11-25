<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241120161559 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE players_rating (id INT AUTO_INCREMENT NOT NULL, player_id INT DEFAULT NULL, user_id INT DEFAULT NULL, relation_id INT DEFAULT NULL, INDEX IDX_EE9749FD99E6F5DF (player_id), INDEX IDX_EE9749FDA76ED395 (user_id), INDEX IDX_EE9749FD3256915B (relation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE players_rating ADD CONSTRAINT FK_EE9749FD99E6F5DF FOREIGN KEY (player_id) REFERENCES players (id)');
        $this->addSql('ALTER TABLE players_rating ADD CONSTRAINT FK_EE9749FDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE players_rating ADD CONSTRAINT FK_EE9749FD3256915B FOREIGN KEY (relation_id) REFERENCES game (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE players_rating DROP FOREIGN KEY FK_EE9749FD99E6F5DF');
        $this->addSql('ALTER TABLE players_rating DROP FOREIGN KEY FK_EE9749FDA76ED395');
        $this->addSql('ALTER TABLE players_rating DROP FOREIGN KEY FK_EE9749FD3256915B');
        $this->addSql('DROP TABLE players_rating');
    }
}
