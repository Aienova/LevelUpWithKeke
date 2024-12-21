<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240910183624 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cmstest (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(500) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cmstest_answer (id INT AUTO_INCREMENT NOT NULL, question_id INT DEFAULT NULL, INDEX IDX_1D8FC6F61E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cmstest_question (id INT AUTO_INCREMENT NOT NULL, test_id INT DEFAULT NULL, content LONGTEXT DEFAULT NULL, INDEX IDX_F8ECD7CB1E5D0459 (test_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cmstest_answer ADD CONSTRAINT FK_1D8FC6F61E27F6BF FOREIGN KEY (question_id) REFERENCES cmstest_question (id)');
        $this->addSql('ALTER TABLE cmstest_question ADD CONSTRAINT FK_F8ECD7CB1E5D0459 FOREIGN KEY (test_id) REFERENCES cmstest (id)');
        $this->addSql('ALTER TABLE cmsmail CHANGE footer footer VARCHAR(50000) DEFAULT NULL');
        $this->addSql('ALTER TABLE notarize_type CHANGE details details VARCHAR(50000) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cmstest_answer DROP FOREIGN KEY FK_1D8FC6F61E27F6BF');
        $this->addSql('ALTER TABLE cmstest_question DROP FOREIGN KEY FK_F8ECD7CB1E5D0459');
        $this->addSql('DROP TABLE cmstest');
        $this->addSql('DROP TABLE cmstest_answer');
        $this->addSql('DROP TABLE cmstest_question');
        $this->addSql('ALTER TABLE cmsmail CHANGE footer footer MEDIUMTEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE notarize_type CHANGE details details MEDIUMTEXT DEFAULT NULL');
    }
}
