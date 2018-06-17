<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180616125655 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE adherent ADD smith_lie_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE adherent ADD CONSTRAINT FK_90D3F0609B831069 FOREIGN KEY (smith_lie_id) REFERENCES smith (id)');
        $this->addSql('CREATE INDEX IDX_90D3F0609B831069 ON adherent (smith_lie_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE adherent DROP FOREIGN KEY FK_90D3F0609B831069');
        $this->addSql('DROP INDEX IDX_90D3F0609B831069 ON adherent');
        $this->addSql('ALTER TABLE adherent DROP smith_lie_id');
    }
}
