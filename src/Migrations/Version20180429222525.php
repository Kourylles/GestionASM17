<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180429222525 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE membre ADD lien_parente_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE membre ADD CONSTRAINT FK_F6B4FB29EA94B6D6 FOREIGN KEY (lien_parente_id) REFERENCES lien_parente (id)');
        $this->addSql('CREATE INDEX IDX_F6B4FB29EA94B6D6 ON membre (lien_parente_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE membre DROP FOREIGN KEY FK_F6B4FB29EA94B6D6');
        $this->addSql('DROP INDEX IDX_F6B4FB29EA94B6D6 ON membre');
        $this->addSql('ALTER TABLE membre DROP lien_parente_id');
    }
}
