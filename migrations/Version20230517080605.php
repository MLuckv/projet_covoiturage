<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230517080605 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reset_password_request (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, selector VARCHAR(20) NOT NULL, hashed_token VARCHAR(100) NOT NULL, requested_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7CE748AA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reset_password_request ADD CONSTRAINT FK_7CE748AA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FADA744BA FOREIGN KEY (expediteur_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FE08F0A5A FOREIGN KEY (destinataire_id_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_B6BD307FADA744BA ON message (expediteur_id_id)');
        $this->addSql('CREATE INDEX IDX_B6BD307FE08F0A5A ON message (destinataire_id_id)');
        $this->addSql('ALTER TABLE place DROP FOREIGN KEY FK_741D53CD51355A76');
        $this->addSql('ALTER TABLE place DROP FOREIGN KEY FK_741D53CD9D86650F');
        $this->addSql('DROP INDEX IDX_741D53CD9D86650F ON place');
        $this->addSql('DROP INDEX IDX_741D53CD51355A76 ON place');
        $this->addSql('ALTER TABLE place ADD voy_id_id INT NOT NULL, ADD user_id_id INT NOT NULL, DROP voy_id, DROP user_id');
        $this->addSql('ALTER TABLE place ADD CONSTRAINT FK_741D53CD51355A76 FOREIGN KEY (voy_id_id) REFERENCES voyage (id)');
        $this->addSql('ALTER TABLE place ADD CONSTRAINT FK_741D53CD9D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_741D53CD9D86650F ON place (user_id_id)');
        $this->addSql('CREATE INDEX IDX_741D53CD51355A76 ON place (voy_id_id)');
        $this->addSql('ALTER TABLE ville DROP FOREIGN KEY FK_43C3D9C387C027E4');
        $this->addSql('DROP INDEX IDX_43C3D9C387C027E4 ON ville');
        $this->addSql('ALTER TABLE ville CHANGE departement_id code_departement_id INT NOT NULL');
        $this->addSql('ALTER TABLE ville ADD CONSTRAINT FK_43C3D9C387C027E4 FOREIGN KEY (code_departement_id) REFERENCES departement (id)');
        $this->addSql('CREATE INDEX IDX_43C3D9C387C027E4 ON ville (code_departement_id)');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D8955145B1063');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D89554E5B6860');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D89554F9D6605');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D89559D86650F');
        $this->addSql('DROP INDEX IDX_3F9D89554E5B6860 ON voyage');
        $this->addSql('DROP INDEX IDX_3F9D89559D86650F ON voyage');
        $this->addSql('DROP INDEX IDX_3F9D8955145B1063 ON voyage');
        $this->addSql('DROP INDEX IDX_3F9D89554F9D6605 ON voyage');
        $this->addSql('ALTER TABLE voyage ADD code_ville_depart_id INT NOT NULL, ADD vehicule_id_id INT NOT NULL, ADD user_id_id INT NOT NULL, DROP ville_depart_id, DROP vehicule_id, DROP user_id, CHANGE ville_arrive_id code_ville_arrive_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D8955145B1063 FOREIGN KEY (code_ville_depart_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D89554E5B6860 FOREIGN KEY (code_ville_arrive_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D89554F9D6605 FOREIGN KEY (vehicule_id_id) REFERENCES vehicule (id)');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D89559D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_3F9D89554E5B6860 ON voyage (code_ville_arrive_id)');
        $this->addSql('CREATE INDEX IDX_3F9D89559D86650F ON voyage (user_id_id)');
        $this->addSql('CREATE INDEX IDX_3F9D8955145B1063 ON voyage (code_ville_depart_id)');
        $this->addSql('CREATE INDEX IDX_3F9D89554F9D6605 ON voyage (vehicule_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE reset_password_request');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FADA744BA');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FE08F0A5A');
        $this->addSql('DROP INDEX IDX_B6BD307FADA744BA ON message');
        $this->addSql('DROP INDEX IDX_B6BD307FE08F0A5A ON message');
        $this->addSql('ALTER TABLE place DROP FOREIGN KEY FK_741D53CD51355A76');
        $this->addSql('ALTER TABLE place DROP FOREIGN KEY FK_741D53CD9D86650F');
        $this->addSql('DROP INDEX IDX_741D53CD51355A76 ON place');
        $this->addSql('DROP INDEX IDX_741D53CD9D86650F ON place');
        $this->addSql('ALTER TABLE place ADD voy_id INT NOT NULL, ADD user_id INT NOT NULL, DROP voy_id_id, DROP user_id_id');
        $this->addSql('ALTER TABLE place ADD CONSTRAINT FK_741D53CD51355A76 FOREIGN KEY (voy_id) REFERENCES voyage (id)');
        $this->addSql('ALTER TABLE place ADD CONSTRAINT FK_741D53CD9D86650F FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_741D53CD51355A76 ON place (voy_id)');
        $this->addSql('CREATE INDEX IDX_741D53CD9D86650F ON place (user_id)');
        $this->addSql('ALTER TABLE ville DROP FOREIGN KEY FK_43C3D9C387C027E4');
        $this->addSql('DROP INDEX IDX_43C3D9C387C027E4 ON ville');
        $this->addSql('ALTER TABLE ville CHANGE code_departement_id departement_id INT NOT NULL');
        $this->addSql('ALTER TABLE ville ADD CONSTRAINT FK_43C3D9C387C027E4 FOREIGN KEY (departement_id) REFERENCES departement (id)');
        $this->addSql('CREATE INDEX IDX_43C3D9C387C027E4 ON ville (departement_id)');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D8955145B1063');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D89554E5B6860');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D89554F9D6605');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D89559D86650F');
        $this->addSql('DROP INDEX IDX_3F9D8955145B1063 ON voyage');
        $this->addSql('DROP INDEX IDX_3F9D89554E5B6860 ON voyage');
        $this->addSql('DROP INDEX IDX_3F9D89554F9D6605 ON voyage');
        $this->addSql('DROP INDEX IDX_3F9D89559D86650F ON voyage');
        $this->addSql('ALTER TABLE voyage ADD ville_depart_id INT NOT NULL, ADD vehicule_id INT NOT NULL, ADD user_id INT NOT NULL, DROP code_ville_depart_id, DROP vehicule_id_id, DROP user_id_id, CHANGE code_ville_arrive_id ville_arrive_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D8955145B1063 FOREIGN KEY (ville_depart_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D89554E5B6860 FOREIGN KEY (ville_arrive_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D89554F9D6605 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id)');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D89559D86650F FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_3F9D8955145B1063 ON voyage (ville_depart_id)');
        $this->addSql('CREATE INDEX IDX_3F9D89554E5B6860 ON voyage (ville_arrive_id)');
        $this->addSql('CREATE INDEX IDX_3F9D89554F9D6605 ON voyage (vehicule_id)');
        $this->addSql('CREATE INDEX IDX_3F9D89559D86650F ON voyage (user_id)');
    }
}
