<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180425180100 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cotisation ADD cotisation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cotisation ADD CONSTRAINT FK_AE64D2ED3EAA84B1 FOREIGN KEY (cotisation_id) REFERENCES membre (id)');
        $this->addSql('CREATE INDEX IDX_AE64D2ED3EAA84B1 ON cotisation (cotisation_id)');
        $this->addSql('ALTER TABLE membre ADD smith_lie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE membre ADD CONSTRAINT FK_F6B4FB299B831069 FOREIGN KEY (smith_lie_id) REFERENCES smith (id)');
        $this->addSql('CREATE INDEX IDX_F6B4FB299B831069 ON membre (smith_lie_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cotisation DROP FOREIGN KEY FK_AE64D2ED3EAA84B1');
        $this->addSql('DROP INDEX IDX_AE64D2ED3EAA84B1 ON cotisation');
        $this->addSql('ALTER TABLE cotisation DROP cotisation_id');
        $this->addSql('ALTER TABLE membre DROP FOREIGN KEY FK_F6B4FB299B831069');
        $this->addSql('DROP INDEX IDX_F6B4FB299B831069 ON membre');
        $this->addSql('ALTER TABLE membre DROP smith_lie_id');
    }
}
