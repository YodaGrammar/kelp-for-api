<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180319093849 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE kelp_packaging (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE kelp_product CHANGE storage_id storage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE kelp_storage CHANGE user_id user_id INT DEFAULT NULL, CHANGE type_storage_id type_storage_id INT DEFAULT NULL');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE kelp_packaging');
        $this->addSql('ALTER TABLE kelp_product CHANGE storage_id storage_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE kelp_storage CHANGE user_id user_id INT DEFAULT NULL, CHANGE type_storage_id type_storage_id INT DEFAULT NULL');
    }
}
