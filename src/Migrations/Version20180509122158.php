<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180509122158 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE donateur ADD coordonnees_id INT NOT NULL');
        $this->addSql('ALTER TABLE donateur ADD CONSTRAINT FK_9CD3DE505853DEDF FOREIGN KEY (coordonnees_id) REFERENCES coordonnees (id)');
        $this->addSql('CREATE INDEX IDX_9CD3DE505853DEDF ON donateur (coordonnees_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE donateur DROP FOREIGN KEY FK_9CD3DE505853DEDF');
        $this->addSql('DROP INDEX IDX_9CD3DE505853DEDF ON donateur');
        $this->addSql('ALTER TABLE donateur DROP coordonnees_id');
    }
}
