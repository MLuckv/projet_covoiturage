<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230525112723 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F10335F61');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FA4F84F6E');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F10335F61 FOREIGN KEY (expediteur_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FA4F84F6E FOREIGN KEY (destinataire_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE place DROP FOREIGN KEY FK_741D53CDA76ED395');
        $this->addSql('ALTER TABLE place DROP FOREIGN KEY FK_741D53CDF8EC5CD7');
        $this->addSql('ALTER TABLE place ADD CONSTRAINT FK_741D53CDA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE place ADD CONSTRAINT FK_741D53CDF8EC5CD7 FOREIGN KEY (voy_id) REFERENCES voyage (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1DA76ED395');
        $this->addSql('ALTER TABLE vehicule CHANGE user_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1DA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ville DROP FOREIGN KEY FK_43C3D9C3CCF9E01E');
        $this->addSql('ALTER TABLE ville ADD CONSTRAINT FK_43C3D9C3CCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F10335F61');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FA4F84F6E');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F10335F61 FOREIGN KEY (expediteur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FA4F84F6E FOREIGN KEY (destinataire_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE place DROP FOREIGN KEY FK_741D53CDF8EC5CD7');
        $this->addSql('ALTER TABLE place DROP FOREIGN KEY FK_741D53CDA76ED395');
        $this->addSql('ALTER TABLE place ADD CONSTRAINT FK_741D53CDF8EC5CD7 FOREIGN KEY (voy_id) REFERENCES voyage (id)');
        $this->addSql('ALTER TABLE place ADD CONSTRAINT FK_741D53CDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE vehicule DROP FOREIGN KEY FK_292FFF1DA76ED395');
        $this->addSql('ALTER TABLE vehicule CHANGE user_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vehicule ADD CONSTRAINT FK_292FFF1DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ville DROP FOREIGN KEY FK_43C3D9C3CCF9E01E');
        $this->addSql('ALTER TABLE ville ADD CONSTRAINT FK_43C3D9C3CCF9E01E FOREIGN KEY (departement_id) REFERENCES departement (id)');
    }
}
