<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240901172632 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cmsarticle ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cmsarticle ADD CONSTRAINT FK_C9FFF69D12469DE2 FOREIGN KEY (category_id) REFERENCES cmsarticle_category (id)');
        $this->addSql('CREATE INDEX IDX_C9FFF69D12469DE2 ON cmsarticle (category_id)');
        $this->addSql('ALTER TABLE cmsmail CHANGE footer footer VARCHAR(50000) DEFAULT NULL');
        $this->addSql('ALTER TABLE notarize_type CHANGE details details VARCHAR(50000) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cmsarticle DROP FOREIGN KEY FK_C9FFF69D12469DE2');
        $this->addSql('DROP INDEX IDX_C9FFF69D12469DE2 ON cmsarticle');
        $this->addSql('ALTER TABLE cmsarticle DROP category_id');
        $this->addSql('ALTER TABLE cmsmail CHANGE footer footer MEDIUMTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE notarize_type CHANGE details details MEDIUMTEXT DEFAULT NULL');
    }
}
