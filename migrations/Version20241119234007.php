<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241119234007 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lineup_players DROP FOREIGN KEY FK_C9F2C2A2D347A7DE');
        $this->addSql('ALTER TABLE lineup_players DROP FOREIGN KEY FK_C9F2C2A2F1849495');
        $this->addSql('DROP TABLE lineup_players');
        $this->addSql('ALTER TABLE player_rating DROP commentary');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lineup_players (lineup_id INT NOT NULL, players_id INT NOT NULL, INDEX IDX_C9F2C2A2D347A7DE (lineup_id), INDEX IDX_C9F2C2A2F1849495 (players_id), PRIMARY KEY(lineup_id, players_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE lineup_players ADD CONSTRAINT FK_C9F2C2A2D347A7DE FOREIGN KEY (lineup_id) REFERENCES lineup (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lineup_players ADD CONSTRAINT FK_C9F2C2A2F1849495 FOREIGN KEY (players_id) REFERENCES players (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE player_rating ADD commentary VARCHAR(255) DEFAULT NULL');
    }
}
