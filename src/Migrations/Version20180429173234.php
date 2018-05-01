<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180429173234 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE membre ADD coordonnees_id INT NOT NULL');
        $this->addSql('ALTER TABLE membre ADD CONSTRAINT FK_F6B4FB295853DEDF FOREIGN KEY (coordonnees_id) REFERENCES coordonnees (id)');
        $this->addSql('CREATE INDEX IDX_F6B4FB295853DEDF ON membre (coordonnees_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE membre DROP FOREIGN KEY FK_F6B4FB295853DEDF');
        $this->addSql('DROP INDEX IDX_F6B4FB295853DEDF ON membre');
        $this->addSql('ALTER TABLE membre DROP coordonnees_id');
    }
}
