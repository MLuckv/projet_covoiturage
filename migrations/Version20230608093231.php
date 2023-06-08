<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230608093231 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conducteur ADD ville_user_id INT NOT NULL, ADD age INT NOT NULL');
        $this->addSql('ALTER TABLE conducteur ADD CONSTRAINT FK_23677143917B7A29 FOREIGN KEY (ville_user_id) REFERENCES ville (id)');
        $this->addSql('CREATE INDEX IDX_23677143917B7A29 ON conducteur (ville_user_id)');
        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1DA76ED395');
        $this->addSql('DROP INDEX IDX_292FFF1DA76ED395 ON vehicule');
        $this->addSql('ALTER TABLE vehicule ADD conducteur_id INT DEFAULT NULL, DROP user_id');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1DF16F4AC6 FOREIGN KEY (conducteur_id) REFERENCES conducteur (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_292FFF1DF16F4AC6 ON vehicule (conducteur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conducteur DROP FOREIGN KEY FK_23677143917B7A29');
        $this->addSql('DROP INDEX IDX_23677143917B7A29 ON conducteur');
        $this->addSql('ALTER TABLE conducteur DROP ville_user_id, DROP age');
        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1DF16F4AC6');
        $this->addSql('DROP INDEX IDX_292FFF1DF16F4AC6 ON vehicule');
        $this->addSql('ALTER TABLE vehicule ADD user_id INT NOT NULL, DROP conducteur_id');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_292FFF1DA76ED395 ON vehicule (user_id)');
    }
}
