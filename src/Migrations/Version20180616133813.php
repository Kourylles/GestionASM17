<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180616133813 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE recette ADD adherent_id INT NOT NULL');
        $this->addSql('ALTER TABLE recette ADD CONSTRAINT FK_49BB639025F06C53 FOREIGN KEY (adherent_id) REFERENCES adherent (id)');
        $this->addSql('CREATE INDEX IDX_49BB639025F06C53 ON recette (adherent_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE recette DROP FOREIGN KEY FK_49BB639025F06C53');
        $this->addSql('DROP INDEX IDX_49BB639025F06C53 ON recette');
        $this->addSql('ALTER TABLE recette DROP adherent_id');
    }
}
