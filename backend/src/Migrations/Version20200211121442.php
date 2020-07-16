<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200211121442 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            $this->connection->getDatabasePlatform()->getName() !== 'postgresql',
            'Migration can only be executed safely on \'postgresql\'.'
        );

        $this->addSql('CREATE TABLE users (id UUID NOT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, email VARCHAR(255) DEFAULT NULL, role VARCHAR(255) NOT NULL, password_hash VARCHAR(255) DEFAULT NULL, confirm_token VARCHAR(255) DEFAULT NULL, new_email VARCHAR(255) DEFAULT NULL, new_email_token VARCHAR(255) DEFAULT NULL, status VARCHAR(16) NOT NULL, name_first VARCHAR(255) NOT NULL, name_last VARCHAR(255) NOT NULL, name_patronymic VARCHAR(255) DEFAULT NULL, reset_token_token VARCHAR(255) DEFAULT NULL, reset_token_expires TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9E7927C74 ON users (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E986EC69F0 ON users (reset_token_token)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1483A5E9A8C9AA51 ON users (confirm_token)');
        $this->addSql('COMMENT ON COLUMN users.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN users.created IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN users.email IS \'(DC2Type:user_email)\'');
        $this->addSql('COMMENT ON COLUMN users.role IS \'(DC2Type:user_role)\'');
        $this->addSql('COMMENT ON COLUMN users.new_email IS \'(DC2Type:user_email)\'');
        $this->addSql('COMMENT ON COLUMN users.reset_token_expires IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE user_networks (id UUID NOT NULL, user_id UUID NOT NULL, name VARCHAR(255) NOT NULL, identity VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3934502BA76ED395 ON user_networks (user_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_3934502B5E237E066A95E9C4 ON user_networks (name, identity)');
        $this->addSql('COMMENT ON COLUMN user_networks.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN user_networks.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('CREATE TABLE node_field (id UUID NOT NULL, node_id UUID NOT NULL, title VARCHAR(255) NOT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, modified TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_425ED7A4460D9FD7 ON node_field (node_id)');
        $this->addSql('COMMENT ON COLUMN node_field.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN node_field.node_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN node_field.created IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN node_field.modified IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE nodes (id UUID NOT NULL, process_id UUID DEFAULT NULL, department_id UUID DEFAULT NULL, title VARCHAR(255) NOT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, modified TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, position_top INT NOT NULL, position_left INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_1D3D05FC7EC2F574 ON nodes (process_id)');
        $this->addSql('CREATE INDEX IDX_1D3D05FCAE80F5DF ON nodes (department_id)');
        $this->addSql('COMMENT ON COLUMN nodes.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN nodes.process_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN nodes.department_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN nodes.created IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN nodes.modified IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE process (id UUID NOT NULL, owner_id UUID DEFAULT NULL, start_node_id UUID DEFAULT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_861D18967E3C61F9 ON process (owner_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_861D1896B6C8C304 ON process (start_node_id)');
        $this->addSql('COMMENT ON COLUMN process.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN process.owner_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN process.start_node_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN process.created IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE routes (id UUID NOT NULL, process_id UUID DEFAULT NULL, source_id UUID DEFAULT NULL, target_id UUID DEFAULT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_32D5C2B37EC2F574 ON routes (process_id)');
        $this->addSql('CREATE INDEX IDX_32D5C2B3953C1C61 ON routes (source_id)');
        $this->addSql('CREATE INDEX IDX_32D5C2B3158E0B66 ON routes (target_id)');
        $this->addSql('COMMENT ON COLUMN routes.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN routes.process_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN routes.source_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN routes.target_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN routes.created IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE companies (id UUID NOT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN companies.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN companies.created IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE departments (id UUID NOT NULL, company_id UUID DEFAULT NULL, parent_id UUID DEFAULT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, modified TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, title TEXT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_16AEB8D4979B1AD6 ON departments (company_id)');
        $this->addSql('CREATE INDEX IDX_16AEB8D4727ACA70 ON departments (parent_id)');
        $this->addSql('COMMENT ON COLUMN departments.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN departments.company_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN departments.parent_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN departments.created IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN departments.modified IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE employees (id UUID NOT NULL, company_id UUID DEFAULT NULL, department_id UUID DEFAULT NULL, created TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, email VARCHAR(255) DEFAULT NULL, position VARCHAR(255) NOT NULL, name_first VARCHAR(255) NOT NULL, name_last VARCHAR(255) NOT NULL, name_patronymic VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BA82C300979B1AD6 ON employees (company_id)');
        $this->addSql('CREATE INDEX IDX_BA82C300AE80F5DF ON employees (department_id)');
        $this->addSql('COMMENT ON COLUMN employees.id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN employees.company_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN employees.department_id IS \'(DC2Type:uuid)\'');
        $this->addSql('COMMENT ON COLUMN employees.created IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN employees.email IS \'(DC2Type:employee_email)\'');
        $this->addSql('CREATE TABLE oauth2_refresh_token (identifier CHAR(80) NOT NULL, access_token CHAR(80) DEFAULT NULL, expiry TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, revoked BOOLEAN NOT NULL, PRIMARY KEY(identifier))');
        $this->addSql('CREATE INDEX IDX_4DD90732B6A2DD68 ON oauth2_refresh_token (access_token)');
        $this->addSql('COMMENT ON COLUMN oauth2_refresh_token.expiry IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE oauth2_client (identifier VARCHAR(32) NOT NULL, secret VARCHAR(128) NOT NULL, redirect_uris TEXT DEFAULT NULL, grants TEXT DEFAULT NULL, scopes TEXT DEFAULT NULL, active BOOLEAN NOT NULL, PRIMARY KEY(identifier))');
        $this->addSql('COMMENT ON COLUMN oauth2_client.redirect_uris IS \'(DC2Type:oauth2_redirect_uri)\'');
        $this->addSql('COMMENT ON COLUMN oauth2_client.grants IS \'(DC2Type:oauth2_grant)\'');
        $this->addSql('COMMENT ON COLUMN oauth2_client.scopes IS \'(DC2Type:oauth2_scope)\'');
        $this->addSql('CREATE TABLE oauth2_authorization_code (identifier CHAR(80) NOT NULL, client VARCHAR(32) NOT NULL, expiry TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, user_identifier VARCHAR(128) DEFAULT NULL, scopes TEXT DEFAULT NULL, revoked BOOLEAN NOT NULL, PRIMARY KEY(identifier))');
        $this->addSql('CREATE INDEX IDX_509FEF5FC7440455 ON oauth2_authorization_code (client)');
        $this->addSql('COMMENT ON COLUMN oauth2_authorization_code.expiry IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN oauth2_authorization_code.scopes IS \'(DC2Type:oauth2_scope)\'');
        $this->addSql('CREATE TABLE oauth2_access_token (identifier CHAR(80) NOT NULL, client VARCHAR(32) NOT NULL, expiry TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, user_identifier VARCHAR(128) DEFAULT NULL, scopes TEXT DEFAULT NULL, revoked BOOLEAN NOT NULL, PRIMARY KEY(identifier))');
        $this->addSql('CREATE INDEX IDX_454D9673C7440455 ON oauth2_access_token (client)');
        $this->addSql('COMMENT ON COLUMN oauth2_access_token.expiry IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN oauth2_access_token.scopes IS \'(DC2Type:oauth2_scope)\'');
        $this->addSql('ALTER TABLE user_networks ADD CONSTRAINT FK_3934502BA76ED395 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE node_field ADD CONSTRAINT FK_425ED7A4460D9FD7 FOREIGN KEY (node_id) REFERENCES nodes (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE nodes ADD CONSTRAINT FK_1D3D05FC7EC2F574 FOREIGN KEY (process_id) REFERENCES process (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE nodes ADD CONSTRAINT FK_1D3D05FCAE80F5DF FOREIGN KEY (department_id) REFERENCES departments (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE process ADD CONSTRAINT FK_861D18967E3C61F9 FOREIGN KEY (owner_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE process ADD CONSTRAINT FK_861D1896B6C8C304 FOREIGN KEY (start_node_id) REFERENCES nodes (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE routes ADD CONSTRAINT FK_32D5C2B37EC2F574 FOREIGN KEY (process_id) REFERENCES process (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE routes ADD CONSTRAINT FK_32D5C2B3953C1C61 FOREIGN KEY (source_id) REFERENCES nodes (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE routes ADD CONSTRAINT FK_32D5C2B3158E0B66 FOREIGN KEY (target_id) REFERENCES nodes (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE departments ADD CONSTRAINT FK_16AEB8D4979B1AD6 FOREIGN KEY (company_id) REFERENCES companies (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE departments ADD CONSTRAINT FK_16AEB8D4727ACA70 FOREIGN KEY (parent_id) REFERENCES departments (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE employees ADD CONSTRAINT FK_BA82C300979B1AD6 FOREIGN KEY (company_id) REFERENCES companies (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE employees ADD CONSTRAINT FK_BA82C300AE80F5DF FOREIGN KEY (department_id) REFERENCES departments (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE oauth2_refresh_token ADD CONSTRAINT FK_4DD90732B6A2DD68 FOREIGN KEY (access_token) REFERENCES oauth2_access_token (identifier) ON DELETE SET NULL NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE oauth2_authorization_code ADD CONSTRAINT FK_509FEF5FC7440455 FOREIGN KEY (client) REFERENCES oauth2_client (identifier) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE oauth2_access_token ADD CONSTRAINT FK_454D9673C7440455 FOREIGN KEY (client) REFERENCES oauth2_client (identifier) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE user_networks DROP CONSTRAINT FK_3934502BA76ED395');
        $this->addSql('ALTER TABLE process DROP CONSTRAINT FK_861D18967E3C61F9');
        $this->addSql('ALTER TABLE node_field DROP CONSTRAINT FK_425ED7A4460D9FD7');
        $this->addSql('ALTER TABLE process DROP CONSTRAINT FK_861D1896B6C8C304');
        $this->addSql('ALTER TABLE routes DROP CONSTRAINT FK_32D5C2B3953C1C61');
        $this->addSql('ALTER TABLE routes DROP CONSTRAINT FK_32D5C2B3158E0B66');
        $this->addSql('ALTER TABLE nodes DROP CONSTRAINT FK_1D3D05FC7EC2F574');
        $this->addSql('ALTER TABLE routes DROP CONSTRAINT FK_32D5C2B37EC2F574');
        $this->addSql('ALTER TABLE departments DROP CONSTRAINT FK_16AEB8D4979B1AD6');
        $this->addSql('ALTER TABLE employees DROP CONSTRAINT FK_BA82C300979B1AD6');
        $this->addSql('ALTER TABLE nodes DROP CONSTRAINT FK_1D3D05FCAE80F5DF');
        $this->addSql('ALTER TABLE departments DROP CONSTRAINT FK_16AEB8D4727ACA70');
        $this->addSql('ALTER TABLE employees DROP CONSTRAINT FK_BA82C300AE80F5DF');
        $this->addSql('ALTER TABLE oauth2_authorization_code DROP CONSTRAINT FK_509FEF5FC7440455');
        $this->addSql('ALTER TABLE oauth2_access_token DROP CONSTRAINT FK_454D9673C7440455');
        $this->addSql('ALTER TABLE oauth2_refresh_token DROP CONSTRAINT FK_4DD90732B6A2DD68');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE user_networks');
        $this->addSql('DROP TABLE node_field');
        $this->addSql('DROP TABLE nodes');
        $this->addSql('DROP TABLE process');
        $this->addSql('DROP TABLE routes');
        $this->addSql('DROP TABLE companies');
        $this->addSql('DROP TABLE departments');
        $this->addSql('DROP TABLE employees');
        $this->addSql('DROP TABLE oauth2_refresh_token');
        $this->addSql('DROP TABLE oauth2_client');
        $this->addSql('DROP TABLE oauth2_authorization_code');
        $this->addSql('DROP TABLE oauth2_access_token');
    }
}
