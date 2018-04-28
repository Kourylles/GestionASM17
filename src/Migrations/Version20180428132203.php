<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180428132203 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE coordonnees (id INT AUTO_INCREMENT NOT NULL, ligne_adr1 VARCHAR(255) DEFAULT NULL, ligne_adr2 VARCHAR(255) DEFAULT NULL, ligne_adr3 VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(10) NOT NULL, ville VARCHAR(255) NOT NULL, pays VARCHAR(255) DEFAULT NULL, telephone1 VARCHAR(50) DEFAULT NULL, telephone2 VARCHAR(50) DEFAULT NULL, email1 VARCHAR(255) DEFAULT NULL, email2 VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE donateur (id INT AUTO_INCREMENT NOT NULL, nom_donateur VARCHAR(255) NOT NULL, prenom_donateur VARCHAR(255) NOT NULL, observations_donateur LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE exercice_comptable_en_cours (id INT AUTO_INCREMENT NOT NULL, exercice_en_cours VARCHAR(4) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fonction_ca (id INT AUTO_INCREMENT NOT NULL, fonction_dans_le_ca VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lien_parente (id INT AUTO_INCREMENT NOT NULL, lien_de_parente VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE membre (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom_membre VARCHAR(255) NOT NULL, fonction_ca VARCHAR(50) DEFAULT NULL, observations_membre LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mode_paiement (id INT AUTO_INCREMENT NOT NULL, mode_de_paiement VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professionnel (id INT AUTO_INCREMENT NOT NULL, nom_professionnel VARCHAR(255) NOT NULL, prenom_professionnel VARCHAR(255) NOT NULL, fonction_professionnel VARCHAR(255) DEFAULT NULL, observations_professionnel LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recette (id INT AUTO_INCREMENT NOT NULL, exercice_comptable_recette VARCHAR(4) NOT NULL, description_recette VARCHAR(255) DEFAULT NULL, date_paiement_recette DATE NOT NULL, montant_recette DOUBLE PRECISION NOT NULL, num_titre_paiement_recette VARCHAR(255) NOT NULL, num_remise_de_cheque_recette VARCHAR(255) DEFAULT NULL, etat_rapprochement_recette TINYINT(1) NOT NULL, num_releve_compte_recette VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE smith (id INT AUTO_INCREMENT NOT NULL, prenom_smith VARCHAR(255) NOT NULL, date_naissance_smith DATE DEFAULT NULL, observations_smith LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_recette (id INT AUTO_INCREMENT NOT NULL, type_de_recette VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE coordonnees');
        $this->addSql('DROP TABLE donateur');
        $this->addSql('DROP TABLE exercice_comptable_en_cours');
        $this->addSql('DROP TABLE fonction_ca');
        $this->addSql('DROP TABLE lien_parente');
        $this->addSql('DROP TABLE membre');
        $this->addSql('DROP TABLE mode_paiement');
        $this->addSql('DROP TABLE professionnel');
        $this->addSql('DROP TABLE recette');
        $this->addSql('DROP TABLE smith');
        $this->addSql('DROP TABLE type_recette');
    }
}
