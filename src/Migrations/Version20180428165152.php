<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180428165152 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE montant_cotisation (id INT AUTO_INCREMENT NOT NULL, montant_cotisation INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE membre DROP fonction_ca, CHANGE nom nom_membre VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE montant_cotisation');
        $this->addSql('ALTER TABLE membre ADD fonction_ca VARCHAR(50) DEFAULT NULL COLLATE utf8mb4_unicode_ci, CHANGE nom_membre nom VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
