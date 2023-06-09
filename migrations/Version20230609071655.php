<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230609071655 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conducteur DROP FOREIGN KEY FK_23677143A76ED395');
        $this->addSql('DROP INDEX UNIQ_23677143A76ED395 ON conducteur');
        $this->addSql('ALTER TABLE conducteur DROP user_id');
        $this->addSql('ALTER TABLE user ADD driver_id INT DEFAULT NULL, DROP is_driver');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649C3423909 FOREIGN KEY (driver_id) REFERENCES conducteur (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649C3423909 ON user (driver_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conducteur ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE conducteur ADD CONSTRAINT FK_23677143A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_23677143A76ED395 ON conducteur (user_id)');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649C3423909');
        $this->addSql('DROP INDEX UNIQ_8D93D649C3423909 ON `user`');
        $this->addSql('ALTER TABLE `user` ADD is_driver TINYINT(1) NOT NULL, DROP driver_id');
    }
}
