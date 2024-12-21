<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240906153801 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cmsarticle_tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(500) DEFAULT NULL, title VARCHAR(500) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cmsarticle ADD tag_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cmsarticle ADD CONSTRAINT FK_C9FFF69DBAD26311 FOREIGN KEY (tag_id) REFERENCES cmsarticle_tag (id)');
        $this->addSql('CREATE INDEX IDX_C9FFF69DBAD26311 ON cmsarticle (tag_id)');
        $this->addSql('ALTER TABLE cmsmail CHANGE footer footer VARCHAR(50000) DEFAULT NULL');
        $this->addSql('ALTER TABLE notarize_type CHANGE details details VARCHAR(50000) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cmsarticle DROP FOREIGN KEY FK_C9FFF69DBAD26311');
        $this->addSql('DROP TABLE cmsarticle_tag');
        $this->addSql('DROP INDEX IDX_C9FFF69DBAD26311 ON cmsarticle');
        $this->addSql('ALTER TABLE cmsarticle DROP tag_id');
        $this->addSql('ALTER TABLE cmsmail CHANGE footer footer MEDIUMTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE notarize_type CHANGE details details MEDIUMTEXT DEFAULT NULL');
    }
}
