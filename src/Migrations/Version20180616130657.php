<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180616130657 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE adherent ADD fonction_au_ca_id INT NOT NULL');
        $this->addSql('ALTER TABLE adherent ADD CONSTRAINT FK_90D3F060FAF021 FOREIGN KEY (fonction_au_ca_id) REFERENCES fonction_ca (id)');
        $this->addSql('CREATE INDEX IDX_90D3F060FAF021 ON adherent (fonction_au_ca_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE adherent DROP FOREIGN KEY FK_90D3F060FAF021');
        $this->addSql('DROP INDEX IDX_90D3F060FAF021 ON adherent');
        $this->addSql('ALTER TABLE adherent DROP fonction_au_ca_id');
    }
}
