<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180616124231 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE adherent ADD coordonnees_id INT NOT NULL');
        $this->addSql('ALTER TABLE adherent ADD CONSTRAINT FK_90D3F0605853DEDF FOREIGN KEY (coordonnees_id) REFERENCES coordonnees (id)');
        $this->addSql('CREATE INDEX IDX_90D3F0605853DEDF ON adherent (coordonnees_id)');
       
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE adherent DROP FOREIGN KEY FK_90D3F0605853DEDF');
        $this->addSql('DROP INDEX IDX_90D3F0605853DEDF ON adherent');
        $this->addSql('ALTER TABLE adherent DROP coordonnees_id');
        
    }
}
