<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180510094519 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE donateur ADD CONSTRAINT FK_9CD3DE505853DEDF FOREIGN KEY (coordonnees_id) REFERENCES coordonnees (id)');
        $this->addSql('CREATE INDEX IDX_9CD3DE505853DEDF ON donateur (coordonnees_id)');
        $this->addSql('ALTER TABLE recette ADD id_donateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB6390128E4D14 FOREIGN KEY (id_donateur_id) REFERENCES donateur (id)');
        $this->addSql('CREATE INDEX IDX_49BB6390128E4D14 ON recette (id_donateur_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE donateur DROP FOREIGN KEY FK_9CD3DE505853DEDF');
        $this->addSql('DROP INDEX IDX_9CD3DE505853DEDF ON donateur');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB6390128E4D14');
        $this->addSql('DROP INDEX IDX_49BB6390128E4D14 ON recette');
        $this->addSql('ALTER TABLE recette DROP id_donateur_id');
    }
}
