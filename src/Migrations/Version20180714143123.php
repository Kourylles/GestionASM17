<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180714143123 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE donateur (id INT AUTO_INCREMENT NOT NULL, coordonnees_id INT NOT NULL, nom_donateur VARCHAR(255) NOT NULL, prenom_donateur VARCHAR(255) NOT NULL, observations_donateur LONGTEXT DEFAULT NULL, don_ok TINYINT(1) NOT NULL, date_creation DATETIME NOT NULL, date_modif DATETIME NOT NULL, INDEX IDX_9CD3DE505853DEDF (coordonnees_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE membre (id INT AUTO_INCREMENT NOT NULL, coordonnees_id INT NOT NULL, lien_parente_id INT DEFAULT NULL, fonction_ca_id INT DEFAULT NULL, smith_lie_id INT DEFAULT NULL, nom_membre VARCHAR(255) NOT NULL, prenom_membre VARCHAR(255) NOT NULL, observations_membre LONGTEXT DEFAULT NULL, coti_ok TINYINT(1) DEFAULT NULL, date_creation DATETIME NOT NULL, date_modif DATETIME NOT NULL, INDEX IDX_F6B4FB295853DEDF (coordonnees_id), INDEX IDX_F6B4FB29EA94B6D6 (lien_parente_id), INDEX IDX_F6B4FB2960825155 (fonction_ca_id), INDEX IDX_F6B4FB299B831069 (smith_lie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE professionnel (id INT AUTO_INCREMENT NOT NULL, coordonnees_id INT DEFAULT NULL, nom_professionnel VARCHAR(255) NOT NULL, prenom_professionnel VARCHAR(255) NOT NULL, fonction_professionnel VARCHAR(255) DEFAULT NULL, observations_professionnel LONGTEXT DEFAULT NULL, titre_professionnel VARCHAR(50) DEFAULT NULL, date_creation DATETIME NOT NULL, date_modif DATETIME NOT NULL, INDEX IDX_7A28C10F5853DEDF (coordonnees_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE donateur ADD CONSTRAINT FK_9CD3DE505853DEDF FOREIGN KEY (coordonnees_id) REFERENCES coordonnees (id)');
        $this->addSql('ALTER TABLE membre ADD CONSTRAINT FK_F6B4FB295853DEDF FOREIGN KEY (coordonnees_id) REFERENCES coordonnees (id)');
        $this->addSql('ALTER TABLE membre ADD CONSTRAINT FK_F6B4FB29EA94B6D6 FOREIGN KEY (lien_parente_id) REFERENCES lien_parente (id)');
        $this->addSql('ALTER TABLE membre ADD CONSTRAINT FK_F6B4FB2960825155 FOREIGN KEY (fonction_ca_id) REFERENCES fonction_ca (id)');
        $this->addSql('ALTER TABLE membre ADD CONSTRAINT FK_F6B4FB299B831069 FOREIGN KEY (smith_lie_id) REFERENCES smith (id)');
        $this->addSql('ALTER TABLE professionnel ADD CONSTRAINT FK_7A28C10F5853DEDF FOREIGN KEY (coordonnees_id) REFERENCES coordonnees (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE donateur');
        $this->addSql('DROP TABLE membre');
        $this->addSql('DROP TABLE professionnel');
    }
}
