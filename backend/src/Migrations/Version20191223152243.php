<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191223152243 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'postgresql',
            'Migration can only be executed safely on \'postgresql\'.'
        );

        $this->addSql('CREATE TABLE user_networks (
            id UUID NOT NULL,
            user_id UUID NOT NULL,
            name VARCHAR(255) NOT NULL,
            identity VARCHAR(255) NOT NULL, PRIMARY KEY(id)
        )');
        $this->addSql('CREATE INDEX IDX_3934502BA76ED395 ON user_networks (user_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3934502B5E237E066A95E9C4 ON user_networks (name, identity)');
        $this->addSql('COMMENT ON COLUMN user_networks.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN user_networks.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE users (
            id UUID NOT NULL,
            created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL,
            email VARCHAR(255) DEFAULT NULL,
            role VARCHAR(255) NOT NULL,
            password_hash VARCHAR(255) DEFAULT NULL,
            confirm_token VARCHAR(255) DEFAULT NULL,
            status VARCHAR(16) NOT NULL,
            name_first VARCHAR(255) NOT NULL,
            name_last VARCHAR(255) NOT NULL,
            name_patronymic VARCHAR(255) NOT NULL,
            reset_token_token VARCHAR(255) DEFAULT NULL,
            reset_token_expires TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL,
            PRIMARY KEY(id)
        )');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON users (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E986EC69F0 ON users (reset_token_token)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9A8C9AA51 ON users (confirm_token)');
        $this->addSql('COMMENT ON COLUMN users.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN users.created IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN users.reset_token_expires IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE user_networks ADD CONSTRAINT FK_3934502BA76ED395 
            FOREIGN KEY (user_id) REFERENCES users (id)
            ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'postgresql',
            'Migration can only be executed safely on \'postgresql\'.'
        );

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE user_networks DROP CONSTRAINT FK_3934502BA76ED395');
        $this->addSql('DROP TABLE user_networks');
        $this->addSql('DROP TABLE users');
    }
}
