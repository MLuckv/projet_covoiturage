<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230525112229 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D895513784AA5');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D8955497832A6');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D89554A4A3511');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D8955A76ED395');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D895513784AA5 FOREIGN KEY (ville_arrive_id) REFERENCES ville (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D8955497832A6 FOREIGN KEY (ville_depart_id) REFERENCES ville (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D89554A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D8955A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D8955497832A6');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D895513784AA5');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D89554A4A3511');
        $this->addSql('ALTER TABLE voyage DROP FOREIGN KEY FK_3F9D8955A76ED395');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D8955497832A6 FOREIGN KEY (ville_depart_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D895513784AA5 FOREIGN KEY (ville_arrive_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D89554A4A3511 FOREIGN KEY (vehicule_id) REFERENCES vehicule (id)');
        $this->addSql('ALTER TABLE voyage ADD CONSTRAINT FK_3F9D8955A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }
}
