<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180425173533 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE valeur_cotisation (id INT AUTO_INCREMENT NOT NULL, montant_cotisation SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EFDF7768B5 FOREIGN KEY (type_parente_id) REFERENCES parente (id)');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EF60825155 FOREIGN KEY (fonction_ca_id) REFERENCES fonction_ca (id)');
        $this->addSql('CREATE INDEX IDX_FCEC9EF60825155 ON personne (fonction_ca_id)');
        $this->addSql('DROP INDEX fk_fcec9efdf7768b5 ON personne');
        $this->addSql('CREATE INDEX IDX_FCEC9EFDF7768B5 ON personne (type_parente_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE valeur_cotisation');
        $this->addSql('ALTER TABLE personne DROP FOREIGN KEY FK_FCEC9EFDF7768B5');
        $this->addSql('ALTER TABLE personne DROP FOREIGN KEY FK_FCEC9EF60825155');
        $this->addSql('DROP INDEX IDX_FCEC9EF60825155 ON personne');
        $this->addSql('ALTER TABLE personne DROP FOREIGN KEY FK_FCEC9EFDF7768B5');
        $this->addSql('DROP INDEX idx_fcec9efdf7768b5 ON personne');
        $this->addSql('CREATE INDEX FK_FCEC9EFDF7768B5 ON personne (type_parente_id)');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EFDF7768B5 FOREIGN KEY (type_parente_id) REFERENCES parente (id)');
    }
}
