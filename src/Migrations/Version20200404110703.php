<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200404110703 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE motivation (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, text LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, image VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statistics (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, money_economised DOUBLE PRECISION NOT NULL, lifetime_saved VARCHAR(255) NOT NULL, unsmoked_cigarette INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_stat DROP INDEX UNIQ_5A39B3E8A76ED395, ADD INDEX IDX_5A39B3E8A76ED395 (user_id)');
        $this->addSql('ALTER TABLE user_stat ADD statistic_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_stat ADD CONSTRAINT FK_5A39B3E853B6268F FOREIGN KEY (statistic_id) REFERENCES statistics (id)');
        $this->addSql('CREATE INDEX IDX_5A39B3E853B6268F ON user_stat (statistic_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_stat DROP FOREIGN KEY FK_5A39B3E853B6268F');
        $this->addSql('DROP TABLE motivation');
        $this->addSql('DROP TABLE statistics');
        $this->addSql('ALTER TABLE user_stat DROP INDEX IDX_5A39B3E8A76ED395, ADD UNIQUE INDEX UNIQ_5A39B3E8A76ED395 (user_id)');
        $this->addSql('DROP INDEX IDX_5A39B3E853B6268F ON user_stat');
        $this->addSql('ALTER TABLE user_stat DROP statistic_id');
    }
}
