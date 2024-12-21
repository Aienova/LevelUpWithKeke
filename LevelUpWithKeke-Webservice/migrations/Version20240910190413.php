<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240910190413 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cmstest_result (id INT AUTO_INCREMENT NOT NULL, test_id INT DEFAULT NULL, customer MEDIUMTEXT DEFAULT NULL, date_result DATETIME DEFAULT NULL, content LONGTEXT DEFAULT NULL, deadline_response DATETIME DEFAULT NULL, response MEDIUMTEXT DEFAULT NULL, INDEX IDX_D4384DC01E5D0459 (test_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cmstest_result ADD CONSTRAINT FK_D4384DC01E5D0459 FOREIGN KEY (test_id) REFERENCES cmstest (id)');
        $this->addSql('ALTER TABLE cmsmail CHANGE footer footer VARCHAR(50000) DEFAULT NULL');
        $this->addSql('ALTER TABLE notarize_type CHANGE details details VARCHAR(50000) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cmstest_result DROP FOREIGN KEY FK_D4384DC01E5D0459');
        $this->addSql('DROP TABLE cmstest_result');
        $this->addSql('ALTER TABLE cmsmail CHANGE footer footer MEDIUMTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE notarize_type CHANGE details details MEDIUMTEXT DEFAULT NULL');
    }
}
