<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200312202757 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE notes ADD matiere_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE notes ADD CONSTRAINT FK_11BA68CF46CD258 FOREIGN KEY (matiere_id) REFERENCES matieres (id)');
        $this->addSql('CREATE INDEX IDX_11BA68CF46CD258 ON notes (matiere_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE notes DROP FOREIGN KEY FK_11BA68CF46CD258');
        $this->addSql('DROP INDEX IDX_11BA68CF46CD258 ON notes');
        $this->addSql('ALTER TABLE notes DROP matiere_id');
    }
}
