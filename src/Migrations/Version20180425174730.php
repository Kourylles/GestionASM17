<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180425174730 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE membre (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE personne DROP FOREIGN KEY FK_FCEC9EFDF7768B5');
        $this->addSql('DROP INDEX fk_fcec9efdf7768b5 ON personne');
        $this->addSql('CREATE INDEX IDX_FCEC9EFDF7768B5 ON personne (type_parente_id)');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EFDF7768B5 FOREIGN KEY (type_parente_id) REFERENCES parente (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE membre');
        $this->addSql('ALTER TABLE personne DROP FOREIGN KEY FK_FCEC9EFDF7768B5');
        $this->addSql('DROP INDEX idx_fcec9efdf7768b5 ON personne');
        $this->addSql('CREATE INDEX FK_FCEC9EFDF7768B5 ON personne (type_parente_id)');
        $this->addSql('ALTER TABLE personne ADD CONSTRAINT FK_FCEC9EFDF7768B5 FOREIGN KEY (type_parente_id) REFERENCES parente (id)');
    }
}
