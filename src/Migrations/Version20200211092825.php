<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200211092825 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE motivation (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, text LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statistic (id INT AUTO_INCREMENT NOT NULL, user_stat_id INT DEFAULT NULL, money_economised DOUBLE PRECISION NOT NULL, cigarettes_saved INT NOT NULL, since INT NOT NULL, lifetime_saved INT NOT NULL, level VARCHAR(255) DEFAULT NULL, INDEX IDX_649B469C515D3101 (user_stat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE statistic ADD CONSTRAINT FK_649B469C515D3101 FOREIGN KEY (user_stat_id) REFERENCES user_stat (id)');
        $this->addSql('ALTER TABLE user_stat DROP FOREIGN KEY FK_5A39B3E89D86650F');
        $this->addSql('DROP INDEX UNIQ_5A39B3E89D86650F ON user_stat');
        $this->addSql('ALTER TABLE user_stat DROP money_economised, DROP cigarettes_saved, DROP since, DROP time_saved, DROP lifetime_saved, CHANGE user_id_id user_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:guid)\'');
        $this->addSql('ALTER TABLE user_stat ADD CONSTRAINT FK_5A39B3E8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_5A39B3E8A76ED395 ON user_stat (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE motivation');
        $this->addSql('DROP TABLE statistic');
        $this->addSql('ALTER TABLE user_stat DROP FOREIGN KEY FK_5A39B3E8A76ED395');
        $this->addSql('DROP INDEX IDX_5A39B3E8A76ED395 ON user_stat');
        $this->addSql('ALTER TABLE user_stat ADD money_economised DOUBLE PRECISION NOT NULL, ADD cigarettes_saved INT NOT NULL, ADD since INT NOT NULL, ADD time_saved DOUBLE PRECISION NOT NULL, ADD lifetime_saved INT NOT NULL, CHANGE user_id user_id_id CHAR(36) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:guid)\'');
        $this->addSql('ALTER TABLE user_stat ADD CONSTRAINT FK_5A39B3E89D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5A39B3E89D86650F ON user_stat (user_id_id)');
    }
}
