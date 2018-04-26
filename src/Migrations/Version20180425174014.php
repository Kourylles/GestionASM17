<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180425174014 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cotisation ADD montant_cotisation_id INT NOT NULL');
        $this->addSql('ALTER TABLE cotisation ADD CONSTRAINT FK_AE64D2EDC5B789DF FOREIGN KEY (montant_cotisation_id) REFERENCES valeur_cotisation (id)');
        $this->addSql('CREATE INDEX IDX_AE64D2EDC5B789DF ON cotisation (montant_cotisation_id)');
        $this->addSql('ALTER TABLE personne DROP FOREIGN KEY FK_FCEC9EFDF7768B5');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EF60825155 FOREIGN KEY (fonction_ca_id) REFERENCES fonction_ca (id)');
        $this->addSql('CREATE INDEX IDX_FCEC9EF60825155 ON personne (fonction_ca_id)');
        $this->addSql('DROP INDEX fk_fcec9efdf7768b5 ON personne');
        $this->addSql('CREATE INDEX IDX_FCEC9EFDF7768B5 ON personne (type_parente_id)');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EFDF7768B5 FOREIGN KEY (type_parente_id) REFERENCES parente (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cotisation DROP FOREIGN KEY FK_AE64D2EDC5B789DF');
        $this->addSql('DROP INDEX IDX_AE64D2EDC5B789DF ON cotisation');
        $this->addSql('ALTER TABLE cotisation DROP montant_cotisation_id');
        $this->addSql('ALTER TABLE personne DROP FOREIGN KEY FK_FCEC9EF60825155');
        $this->addSql('DROP INDEX IDX_FCEC9EF60825155 ON personne');
        $this->addSql('ALTER TABLE personne DROP FOREIGN KEY FK_FCEC9EFDF7768B5');
        $this->addSql('DROP INDEX idx_fcec9efdf7768b5 ON personne');
        $this->addSql('CREATE INDEX FK_FCEC9EFDF7768B5 ON personne (type_parente_id)');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EFDF7768B5 FOREIGN KEY (type_parente_id) REFERENCES parente (id)');
    }
}
