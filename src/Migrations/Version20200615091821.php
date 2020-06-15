<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200615091821 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cars (id INT AUTO_INCREMENT NOT NULL, vendor_id INT NOT NULL, title VARCHAR(255) NOT NULL, is_new TINYINT(1) NOT NULL, production_date DATE NOT NULL, price INT DEFAULT NULL, is_rain_sensor TINYINT(1) NOT NULL, mileage INT NOT NULL, INDEX IDX_95C71D14F603EE73 (vendor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vendors (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cars ADD CONSTRAINT FK_95C71D14F603EE73 FOREIGN KEY (vendor_id) REFERENCES vendors (id)');
        $this->addSql('ALTER TABLE vendors ADD CONSTRAINT FK_4F25BA11BF396750 FOREIGN KEY (id) REFERENCES cars (vendor_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE vendors DROP FOREIGN KEY FK_4F25BA11BF396750');
        $this->addSql('ALTER TABLE cars DROP FOREIGN KEY FK_95C71D14F603EE73');
        $this->addSql('DROP TABLE cars');
        $this->addSql('DROP TABLE vendors');
    }
}
