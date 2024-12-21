<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240910190541 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cmsmail CHANGE footer footer VARCHAR(50000) DEFAULT NULL');
        $this->addSql('ALTER TABLE cmstest_result ADD customer_email VARCHAR(10000) DEFAULT NULL');
        $this->addSql('ALTER TABLE notarize_type CHANGE details details VARCHAR(50000) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cmsmail CHANGE footer footer MEDIUMTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE cmstest_result DROP customer_email');
        $this->addSql('ALTER TABLE notarize_type CHANGE details details MEDIUMTEXT DEFAULT NULL');
    }
}
