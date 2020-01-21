<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200121104841 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE friend DROP FOREIGN KEY FK_55EEAC6179F37AE5');
        $this->addSql('DROP INDEX IDX_55EEAC6179F37AE5 ON friend');
        $this->addSql('ALTER TABLE friend ADD friend_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\', CHANGE id_user_id user_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('ALTER TABLE friend ADD CONSTRAINT FK_55EEAC61A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE friend ADD CONSTRAINT FK_55EEAC616A5458E8 FOREIGN KEY (friend_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_55EEAC61A76ED395 ON friend (user_id)');
        $this->addSql('CREATE INDEX IDX_55EEAC616A5458E8 ON friend (friend_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE friend DROP FOREIGN KEY FK_55EEAC61A76ED395');
        $this->addSql('ALTER TABLE friend DROP FOREIGN KEY FK_55EEAC616A5458E8');
        $this->addSql('DROP INDEX UNIQ_55EEAC61A76ED395 ON friend');
        $this->addSql('DROP INDEX IDX_55EEAC616A5458E8 ON friend');
        $this->addSql('ALTER TABLE friend ADD id_user_id CHAR(36) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:guid)\', DROP user_id, DROP friend_id');
        $this->addSql('ALTER TABLE friend ADD CONSTRAINT FK_55EEAC6179F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_55EEAC6179F37AE5 ON friend (id_user_id)');
    }
}
