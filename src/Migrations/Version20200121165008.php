<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200121165008 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_stat DROP FOREIGN KEY FK_5A39B3E89D86650F');
        $this->addSql('DROP INDEX UNIQ_5A39B3E89D86650F ON user_stat');
        $this->addSql('ALTER TABLE user_stat CHANGE user_id_id user_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('ALTER TABLE user_stat ADD CONSTRAINT FK_5A39B3E8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_5A39B3E8A76ED395 ON user_stat (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_stat DROP FOREIGN KEY FK_5A39B3E8A76ED395');
        $this->addSql('DROP INDEX IDX_5A39B3E8A76ED395 ON user_stat');
        $this->addSql('ALTER TABLE user_stat CHANGE user_id user_id_id CHAR(36) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:guid)\'');
        $this->addSql('ALTER TABLE user_stat ADD CONSTRAINT FK_5A39B3E89D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5A39B3E89D86650F ON user_stat (user_id_id)');
    }
}
