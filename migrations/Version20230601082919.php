<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230601082919 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F5F0218B');
        $this->addSql('DROP INDEX IDX_B6BD307F5F0218B ON message');
        $this->addSql('ALTER TABLE message ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', DROP created_at_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE message ADD created_at_id INT NOT NULL, DROP created_at');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F5F0218B FOREIGN KEY (created_at_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_B6BD307F5F0218B ON message (created_at_id)');
    }
}
