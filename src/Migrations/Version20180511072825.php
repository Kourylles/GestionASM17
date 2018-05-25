<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180511072825 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE professionnel ADD coordonnees_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE professionnel ADD CONSTRAINT FK_7A28C10F5853DEDF FOREIGN KEY (coordonnees_id) REFERENCES coordonnees (id)');
        $this->addSql('CREATE INDEX IDX_7A28C10F5853DEDF ON professionnel (coordonnees_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE professionnel DROP FOREIGN KEY FK_7A28C10F5853DEDF');
        $this->addSql('DROP INDEX IDX_7A28C10F5853DEDF ON professionnel');
        $this->addSql('ALTER TABLE professionnel DROP coordonnees_id');
    }
}
