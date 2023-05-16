<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230516094519 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE departement (id INT AUTO_INCREMENT NOT NULL, nom_departement VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, expediteur_id_id INT NOT NULL, destinataire_id_id INT NOT NULL, msg LONGTEXT NOT NULL, INDEX IDX_B6BD307FADA744BA (expediteur_id_id), INDEX IDX_B6BD307FE08F0A5A (destinataire_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE place (id INT AUTO_INCREMENT NOT NULL, voy_id_id INT NOT NULL, user_id_id INT NOT NULL, num_place INT NOT NULL, prix_place INT NOT NULL, UNIQUE INDEX UNIQ_741D53CD51355A76 (voy_id_id), UNIQUE INDEX UNIQ_741D53CD9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vehicule (id INT AUTO_INCREMENT NOT NULL, immatriculation VARCHAR(255) NOT NULL, marque VARCHAR(255) NOT NULL, modele VARCHAR(255) NOT NULL, couleur VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ville (id INT AUTO_INCREMENT NOT NULL, code_departement_id INT NOT NULL, nom_ville VARCHAR(255) NOT NULL, INDEX IDX_43C3D9C387C027E4 (code_departement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE voyage (id INT AUTO_INCREMENT NOT NULL, code_ville_depart_id INT NOT NULL, code_ville_arrive_id INT DEFAULT NULL, vehicule_id_id INT NOT NULL, user_id_id INT NOT NULL, nb_place INT NOT NULL, heure_depart DATETIME NOT NULL, heure_arrive DATETIME NOT NULL, INDEX IDX_3F9D8955145B1063 (code_ville_depart_id), INDEX IDX_3F9D89554E5B6860 (code_ville_arrive_id), INDEX IDX_3F9D89554F9D6605 (vehicule_id_id), INDEX IDX_3F9D89559D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FADA744BA FOREIGN KEY (expediteur_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FE08F0A5A FOREIGN KEY (destinataire_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE place ADD CONSTRAINT FK_741D53CD51355A76 FOREIGN KEY (voy_id_id) REFERENCES voyage (id)');
        $this->addSql('ALTER TABLE place ADD CONSTRAINT FK_741D53CD9D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE ville ADD CONSTRAINT FK_43C3D9C387C027E4 FOREIGN KEY (code_departement_id) REFERENCES departement (id)');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D8955145B1063 FOREIGN KEY (code_ville_depart_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D89554E5B6860 FOREIGN KEY (code_ville_arrive_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D89554F9D6605 FOREIGN KEY (vehicule_id_id) REFERENCES vehicule (id)');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D89559D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE user CHANGE num_tel num_tel INT NOT NULL, CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ville DROP FOREIGN KEY FK_43C3D9C387C027E4');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D89554F9D6605');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D8955145B1063');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D89554E5B6860');
        $this->addSql('ALTER TABLE place DROP FOREIGN KEY FK_741D53CD51355A76');
        $this->addSql('DROP TABLE departement');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE place');
        $this->addSql('DROP TABLE vehicule');
        $this->addSql('DROP TABLE ville');
        $this->addSql('DROP TABLE voyage');
        $this->addSql('ALTER TABLE `user` CHANGE created_at created_at DATETIME DEFAULT CURRENT_TIMESTAMP, CHANGE num_tel num_tel VARCHAR(248) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
