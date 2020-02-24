<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200129084320 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_stat DROP money_economised, DROP cigarettes_saved, DROP since, DROP time_saved, DROP lifetime_saved, DROP level');
        $this->addSql('ALTER TABLE statistic ADD user_stat_id INT DEFAULT NULL, ADD money_economised DOUBLE PRECISION NOT NULL, ADD cigarettes_saved INT NOT NULL, ADD since INT NOT NULL, ADD time_saved DOUBLE PRECISION NOT NULL, ADD lifetime_saved INT NOT NULL, ADD level VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE statistic ADD CONSTRAINT FK_649B469C515D3101 FOREIGN KEY (user_stat_id) REFERENCES user_stat (id)');
        $this->addSql('CREATE INDEX IDX_649B469C515D3101 ON statistic (user_stat_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE statistic DROP FOREIGN KEY FK_649B469C515D3101');
        $this->addSql('DROP INDEX IDX_649B469C515D3101 ON statistic');
        $this->addSql('ALTER TABLE statistic DROP user_stat_id, DROP money_economised, DROP cigarettes_saved, DROP since, DROP time_saved, DROP lifetime_saved, DROP level');
        $this->addSql('ALTER TABLE user_stat ADD money_economised DOUBLE PRECISION NOT NULL, ADD cigarettes_saved INT NOT NULL, ADD since INT NOT NULL, ADD time_saved DOUBLE PRECISION NOT NULL, ADD lifetime_saved INT NOT NULL, ADD level VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
