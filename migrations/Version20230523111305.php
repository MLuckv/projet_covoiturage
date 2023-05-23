<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230523111305 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F10335F61 FOREIGN KEY (expediteur_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FA4F84F6E FOREIGN KEY (destinataire_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_B6BD307F10335F61 ON message (expediteur_id)');
        $this->addSql('CREATE INDEX IDX_B6BD307FA4F84F6E ON message (destinataire_id)');
        $this->addSql('ALTER TABLE place DROP FOREIGN KEY FK_741D53CD51355A76');
        $this->addSql('ALTER TABLE place DROP FOREIGN KEY FK_741D53CD9D86650F');
        $this->addSql('DROP INDEX IDX_741D53CD9D86650F ON place');
        $this->addSql('DROP INDEX IDX_741D53CD51355A76 ON place');
        $this->addSql('ALTER TABLE place ADD voy_id_id INT NOT NULL, ADD user_id_id INT NOT NULL, DROP voy_id, DROP user_id');
        $this->addSql('ALTER TABLE place ADD CONSTRAINT FK_741D53CD51355A76 FOREIGN KEY (voy_id_id) REFERENCES voyage (id)');
        $this->addSql('ALTER TABLE place ADD CONSTRAINT FK_741D53CD9D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_741D53CD9D86650F ON place (user_id_id)');
        $this->addSql('CREATE INDEX IDX_741D53CD51355A76 ON place (voy_id_id)');
        $this->addSql('ALTER TABLE reset_password_request CHANGE requested_at requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE expires_at expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE ville RENAME INDEX idx_43c3d9c387c027e4 TO IDX_43C3D9C3CCF9E01E');
        $this->addSql('ALTER TABLE voyage ADD description LONGTEXT DEFAULT NULL, CHANGE ville_arrive_id ville_arrive_id INT NOT NULL, CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE voyage RENAME INDEX idx_3f9d8955145b1063 TO IDX_3F9D8955497832A6');
        $this->addSql('ALTER TABLE voyage RENAME INDEX idx_3f9d89554e5b6860 TO IDX_3F9D895513784AA5');
        $this->addSql('ALTER TABLE voyage RENAME INDEX idx_3f9d89554f9d6605 TO IDX_3F9D89554A4A3511');
        $this->addSql('ALTER TABLE voyage RENAME INDEX idx_3f9d89559d86650f TO IDX_3F9D8955A76ED395');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F10335F61');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FA4F84F6E');
        $this->addSql('DROP INDEX IDX_B6BD307F10335F61 ON message');
        $this->addSql('DROP INDEX IDX_B6BD307FA4F84F6E ON message');
        $this->addSql('ALTER TABLE place DROP FOREIGN KEY FK_741D53CD51355A76');
        $this->addSql('ALTER TABLE place DROP FOREIGN KEY FK_741D53CD9D86650F');
        $this->addSql('DROP INDEX IDX_741D53CD51355A76 ON place');
        $this->addSql('DROP INDEX IDX_741D53CD9D86650F ON place');
        $this->addSql('ALTER TABLE place ADD voy_id INT NOT NULL, ADD user_id INT NOT NULL, DROP voy_id_id, DROP user_id_id');
        $this->addSql('ALTER TABLE place ADD CONSTRAINT FK_741D53CD51355A76 FOREIGN KEY (voy_id) REFERENCES voyage (id)');
        $this->addSql('ALTER TABLE place ADD CONSTRAINT FK_741D53CD9D86650F FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_741D53CD51355A76 ON place (voy_id)');
        $this->addSql('CREATE INDEX IDX_741D53CD9D86650F ON place (user_id)');
        $this->addSql('ALTER TABLE reset_password_request CHANGE requested_at requested_at DATETIME NOT NULL, CHANGE expires_at expires_at DATETIME NOT NULL');
        $this->addSql('ALTER TABLE ville RENAME INDEX idx_43c3d9c3ccf9e01e TO IDX_43C3D9C387C027E4');
        $this->addSql('ALTER TABLE voyage DROP description, CHANGE ville_arrive_id ville_arrive_id INT DEFAULT NULL, CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE voyage RENAME INDEX idx_3f9d895513784aa5 TO IDX_3F9D89554E5B6860');
        $this->addSql('ALTER TABLE voyage RENAME INDEX idx_3f9d8955a76ed395 TO IDX_3F9D89559D86650F');
        $this->addSql('ALTER TABLE voyage RENAME INDEX idx_3f9d8955497832a6 TO IDX_3F9D8955145B1063');
        $this->addSql('ALTER TABLE voyage RENAME INDEX idx_3f9d89554a4a3511 TO IDX_3F9D89554F9D6605');
    }
}
