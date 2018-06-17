<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180616133212 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB6390128E4D14');
        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB6390EAAC4B6D');
        $this->addSql('DROP INDEX IDX_49BB6390EAAC4B6D ON recette');
        $this->addSql('DROP INDEX IDX_49BB6390128E4D14 ON recette');
        $this->addSql('ALTER TABLE recette DROP id_membre_id, DROP id_donateur_id, CHANGE description_recette description_recette LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE recette ADD id_membre_id INT DEFAULT NULL, ADD id_donateur_id INT DEFAULT NULL, CHANGE description_recette description_recette VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB6390128E4D14 FOREIGN KEY (id_donateur_id) REFERENCES donateur (id)');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB6390EAAC4B6D FOREIGN KEY (id_membre_id) REFERENCES membre (id)');
        $this->addSql('CREATE INDEX IDX_49BB6390EAAC4B6D ON recette (id_membre_id)');
        $this->addSql('CREATE INDEX IDX_49BB6390128E4D14 ON recette (id_donateur_id)');
    }
}
