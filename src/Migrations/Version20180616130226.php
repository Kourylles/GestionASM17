<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180616130226 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE adherent ADD lien_parente_id INT NOT NULL');
        $this->addSql('ALTER TABLE adherent ADD CONSTRAINT FK_90D3F060EA94B6D6 FOREIGN KEY (lien_parente_id) REFERENCES lien_parente (id)');
        $this->addSql('CREATE INDEX IDX_90D3F060EA94B6D6 ON adherent (lien_parente_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE adherent DROP FOREIGN KEY FK_90D3F060EA94B6D6');
        $this->addSql('DROP INDEX IDX_90D3F060EA94B6D6 ON adherent');
        $this->addSql('ALTER TABLE adherent DROP lien_parente_id');
    }
}
