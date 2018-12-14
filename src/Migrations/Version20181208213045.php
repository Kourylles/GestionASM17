<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181208213045 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE adherent ADD est_aussi_donateur TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE professionnel ADD titre VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE recette DROP id_banque_id, CHANGE etat_rapprochement_recette etat_rapprochement_recette TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE smith CHANGE prenom_smith prenom_smith VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE adherent DROP est_aussi_donateur');
        $this->addSql('ALTER TABLE professionnel DROP titre');
        $this->addSql('ALTER TABLE recette ADD id_banque_id INT NOT NULL, CHANGE etat_rapprochement_recette etat_rapprochement_recette TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE smith CHANGE prenom_smith prenom_smith VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
    }
}
