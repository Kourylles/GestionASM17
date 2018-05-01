<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180429222823 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE membre ADD fonction_ca_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE membre ADD CONSTRAINT FK_F6B4FB2960825155 FOREIGN KEY (fonction_ca_id) REFERENCES fonction_ca (id)');
        $this->addSql('CREATE INDEX IDX_F6B4FB2960825155 ON membre (fonction_ca_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE membre DROP FOREIGN KEY FK_F6B4FB2960825155');
        $this->addSql('DROP INDEX IDX_F6B4FB2960825155 ON membre');
        $this->addSql('ALTER TABLE membre DROP fonction_ca_id');
    }
}
