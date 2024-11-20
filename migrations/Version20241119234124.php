<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241119234124 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE players_lineup (players_id INT NOT NULL, lineup_id INT NOT NULL, INDEX IDX_FB606115F1849495 (players_id), INDEX IDX_FB606115D347A7DE (lineup_id), PRIMARY KEY(players_id, lineup_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE players_lineup ADD CONSTRAINT FK_FB606115F1849495 FOREIGN KEY (players_id) REFERENCES players (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE players_lineup ADD CONSTRAINT FK_FB606115D347A7DE FOREIGN KEY (lineup_id) REFERENCES lineup (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE players_lineup DROP FOREIGN KEY FK_FB606115F1849495');
        $this->addSql('ALTER TABLE players_lineup DROP FOREIGN KEY FK_FB606115D347A7DE');
        $this->addSql('DROP TABLE players_lineup');
    }
}
