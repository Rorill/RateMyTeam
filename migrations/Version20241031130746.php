<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241031130746 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE game (id INT AUTO_INCREMENT NOT NULL, team_home_id INT NOT NULL, team_away_id INT NOT NULL, date DATETIME DEFAULT NULL, score_home INT DEFAULT NULL, score_away INT DEFAULT NULL, matchday INT NOT NULL, stage VARCHAR(255) NOT NULL, api_match_id INT NOT NULL, INDEX IDX_232B318CD7B4B9AB (team_home_id), INDEX IDX_232B318C729679A8 (team_away_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ligue1_teams (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, display_name VARCHAR(255) NOT NULL, stadium VARCHAR(255) NOT NULL, coach VARCHAR(255) NOT NULL, api_id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE players (id INT AUTO_INCREMENT NOT NULL, team_id INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, birthday DATETIME NOT NULL, position VARCHAR(255) NOT NULL, number INT NOT NULL, INDEX IDX_264E43A6296CD8AE (team_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, selected_team_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, is_verified TINYINT(1) NOT NULL, INDEX IDX_8D93D649C128A630 (selected_team_id), UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318CD7B4B9AB FOREIGN KEY (team_home_id) REFERENCES ligue1_teams (id)');
        $this->addSql('ALTER TABLE game ADD CONSTRAINT FK_232B318C729679A8 FOREIGN KEY (team_away_id) REFERENCES ligue1_teams (id)');
        $this->addSql('ALTER TABLE players ADD CONSTRAINT FK_264E43A6296CD8AE FOREIGN KEY (team_id) REFERENCES ligue1_teams (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649C128A630 FOREIGN KEY (selected_team_id) REFERENCES ligue1_teams (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318CD7B4B9AB');
        $this->addSql('ALTER TABLE game DROP FOREIGN KEY FK_232B318C729679A8');
        $this->addSql('ALTER TABLE players DROP FOREIGN KEY FK_264E43A6296CD8AE');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649C128A630');
        $this->addSql('DROP TABLE game');
        $this->addSql('DROP TABLE ligue1_teams');
        $this->addSql('DROP TABLE players');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
