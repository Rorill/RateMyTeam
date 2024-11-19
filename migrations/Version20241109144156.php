<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241109144156 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE lineup (id INT AUTO_INCREMENT NOT NULL, game_id INT DEFAULT NULL, team_id INT DEFAULT NULL, is_starter TINYINT(1) NOT NULL, INDEX IDX_CD7E0ECAE48FD905 (game_id), INDEX IDX_CD7E0ECA296CD8AE (team_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lineup_players (lineup_id INT NOT NULL, players_id INT NOT NULL, INDEX IDX_C9F2C2A2D347A7DE (lineup_id), INDEX IDX_C9F2C2A2F1849495 (players_id), PRIMARY KEY(lineup_id, players_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lineup ADD CONSTRAINT FK_CD7E0ECAE48FD905 FOREIGN KEY (game_id) REFERENCES game (id)');
        $this->addSql('ALTER TABLE lineup ADD CONSTRAINT FK_CD7E0ECA296CD8AE FOREIGN KEY (team_id) REFERENCES ligue1_teams (id)');
        $this->addSql('ALTER TABLE lineup_players ADD CONSTRAINT FK_C9F2C2A2D347A7DE FOREIGN KEY (lineup_id) REFERENCES lineup (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lineup_players ADD CONSTRAINT FK_C9F2C2A2F1849495 FOREIGN KEY (players_id) REFERENCES players (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lineup DROP FOREIGN KEY FK_CD7E0ECAE48FD905');
        $this->addSql('ALTER TABLE lineup DROP FOREIGN KEY FK_CD7E0ECA296CD8AE');
        $this->addSql('ALTER TABLE lineup_players DROP FOREIGN KEY FK_C9F2C2A2D347A7DE');
        $this->addSql('ALTER TABLE lineup_players DROP FOREIGN KEY FK_C9F2C2A2F1849495');
        $this->addSql('DROP TABLE lineup');
        $this->addSql('DROP TABLE lineup_players');
    }
}
