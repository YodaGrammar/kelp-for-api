<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180423201649 extends AbstractMigration
{
    /**
     * {@inheritdoc}
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE kelp_product (id INT AUTO_INCREMENT NOT NULL, packaging_id INT NOT NULL, storage_id INT NOT NULL, quantity INT NOT NULL, label VARCHAR(50) NOT NULL, date_peremption DATETIME NOT NULL, date_add DATETIME NOT NULL, is_active TINYINT(1) NOT NULL, INDEX IDX_FACE29814E7B3801 (packaging_id), INDEX IDX_FACE29815CC5DB90 (storage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kelp_user (id INT AUTO_INCREMENT NOT NULL, full_name VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, roles JSON NOT NULL, is_active TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_F194DF17F85E0677 (username), UNIQUE INDEX UNIQ_F194DF17E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kelp_type_storage (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(50) NOT NULL, comment LONGTEXT NOT NULL, class VARCHAR(50) NOT NULL, is_active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kelp_storage (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, type_storage_id INT NOT NULL, label VARCHAR(50) NOT NULL, is_active TINYINT(1) NOT NULL, INDEX IDX_7DFE3618A76ED395 (user_id), INDEX IDX_7DFE361841C60DB5 (type_storage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kelp_packaging (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(50) NOT NULL, is_active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kelp_type_product (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(50) NOT NULL, unit VARCHAR(50) NOT NULL, is_active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE kelp_product ADD CONSTRAINT FK_FACE29814E7B3801 FOREIGN KEY (packaging_id) REFERENCES kelp_packaging (id)');
        $this->addSql('ALTER TABLE kelp_product ADD CONSTRAINT FK_FACE29815CC5DB90 FOREIGN KEY (storage_id) REFERENCES kelp_storage (id)');
        $this->addSql('ALTER TABLE kelp_storage ADD CONSTRAINT FK_7DFE3618A76ED395 FOREIGN KEY (user_id) REFERENCES kelp_user (id)');
        $this->addSql('ALTER TABLE kelp_storage ADD CONSTRAINT FK_7DFE361841C60DB5 FOREIGN KEY (type_storage_id) REFERENCES kelp_type_storage (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE kelp_storage DROP FOREIGN KEY FK_7DFE3618A76ED395');
        $this->addSql('ALTER TABLE kelp_storage DROP FOREIGN KEY FK_7DFE361841C60DB5');
        $this->addSql('ALTER TABLE kelp_product DROP FOREIGN KEY FK_FACE29815CC5DB90');
        $this->addSql('ALTER TABLE kelp_product DROP FOREIGN KEY FK_FACE29814E7B3801');
        $this->addSql('DROP TABLE kelp_product');
        $this->addSql('DROP TABLE kelp_user');
        $this->addSql('DROP TABLE kelp_type_storage');
        $this->addSql('DROP TABLE kelp_storage');
        $this->addSql('DROP TABLE kelp_packaging');
        $this->addSql('DROP TABLE kelp_type_product');
    }
}
