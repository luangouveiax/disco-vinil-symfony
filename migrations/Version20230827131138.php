<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230827131138 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE disco_vinil ADD created_at DATETIME NOT NULL, ADD updated_at DATETIME NOT NULL, DROP criado');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE disco_vinil ADD criado DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', DROP created_at, DROP updated_at');
    }
}
