<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230530080301 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE place DROP FOREIGN KEY FK_741D53CDF8EC5CD7');
        $this->addSql('DROP INDEX IDX_741D53CDF8EC5CD7 ON place');
        $this->addSql('ALTER TABLE place ADD voyage_id INT DEFAULT NULL, DROP voy_id');
        $this->addSql('ALTER TABLE place ADD CONSTRAINT FK_741D53CD68C9E5AF FOREIGN KEY (voyage_id) REFERENCES voyage (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_741D53CD68C9E5AF ON place (voyage_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE place DROP FOREIGN KEY FK_741D53CD68C9E5AF');
        $this->addSql('DROP INDEX IDX_741D53CD68C9E5AF ON place');
        $this->addSql('ALTER TABLE place ADD voy_id INT NOT NULL, DROP voyage_id');
        $this->addSql('ALTER TABLE place ADD CONSTRAINT FK_741D53CDF8EC5CD7 FOREIGN KEY (voy_id) REFERENCES voyage (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_741D53CDF8EC5CD7 ON place (voy_id)');
    }
}
