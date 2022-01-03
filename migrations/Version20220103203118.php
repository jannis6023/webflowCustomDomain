<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220103203118 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F85E0677 ON user (username)');
        $this->addSql('ALTER TABLE site ADD COLUMN redirect_url VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TEMPORARY TABLE __temp__site AS SELECT id, host, webflow_address FROM site');
        $this->addSql('DROP TABLE site');
        $this->addSql('CREATE TABLE site (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, host VARCHAR(255) NOT NULL, webflow_address VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO site (id, host, webflow_address) SELECT id, host, webflow_address FROM __temp__site');
        $this->addSql('DROP TABLE __temp__site');
    }
}
