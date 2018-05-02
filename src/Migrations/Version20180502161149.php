<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180502161149 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE depense ADD mode_paiement_depense_id INT NOT NULL');
        $this->addSql('ALTER TABLE depense ADD CONSTRAINT FK_34059757640EC3EF FOREIGN KEY (mode_paiement_depense_id) REFERENCES mode_paiement (id)');
        $this->addSql('CREATE INDEX IDX_34059757640EC3EF ON depense (mode_paiement_depense_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE depense DROP FOREIGN KEY FK_34059757640EC3EF');
        $this->addSql('DROP INDEX IDX_34059757640EC3EF ON depense');
        $this->addSql('ALTER TABLE depense DROP mode_paiement_depense_id');
    }
}
