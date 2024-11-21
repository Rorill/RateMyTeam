<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241106185419 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE player_rating (id INT AUTO_INCREMENT NOT NULL, player_id INT DEFAULT NULL, game_id INT DEFAULT NULL, user_id INT DEFAULT NULL, rating INT NOT NULL, INDEX IDX_4789B0FC99E6F5DF (player_id), INDEX IDX_4789B0FCE48FD905 (game_id), INDEX IDX_4789B0FCA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE player_rating ADD CONSTRAINT FK_4789B0FC99E6F5DF FOREIGN KEY (player_id) REFERENCES players (id)');
        $this->addSql('ALTER TABLE player_rating ADD CONSTRAINT FK_4789B0FCE48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE player_rating ADD CONSTRAINT FK_4789B0FCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE player_rating DROP FOREIGN KEY FK_4789B0FC99E6F5DF');
        $this->addSql('ALTER TABLE player_rating DROP FOREIGN KEY FK_4789B0FCE48FD905');
        $this->addSql('ALTER TABLE player_rating DROP FOREIGN KEY FK_4789B0FCA76ED395');
        $this->addSql('DROP TABLE player_rating');
    }
}
