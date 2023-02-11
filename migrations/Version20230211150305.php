<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230211150305 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE action (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, activitiy_id INT NOT NULL, invoice_id INT DEFAULT NULL, company_id INT NOT NULL, date DATE NOT NULL, description VARCHAR(500) DEFAULT NULL, hourly_cost DOUBLE PRECISION DEFAULT NULL, time DOUBLE PRECISION NOT NULL, deleted TINYINT(1) DEFAULT NULL, INDEX IDX_47CC8C92A76ED395 (user_id), INDEX IDX_47CC8C92F1C13CD2 (activitiy_id), INDEX IDX_47CC8C922989F1FD (invoice_id), INDEX IDX_47CC8C92979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE activity (id INT AUTO_INCREMENT NOT NULL, activity VARCHAR(255) NOT NULL, invoice_description VARCHAR(255) DEFAULT NULL, deleted TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, configuration_id INT NOT NULL, account_nr VARCHAR(255) DEFAULT NULL, invoice_adress VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, country VARCHAR(30) DEFAULT NULL, adress VARCHAR(255) DEFAULT NULL, phone_nr VARCHAR(20) DEFAULT NULL, zipcode VARCHAR(15) DEFAULT NULL, location VARCHAR(30) DEFAULT NULL, active TINYINT(1) DEFAULT NULL, deleted TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_4FBF094F73F32DD8 (configuration_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE configuration (id INT AUTO_INCREMENT NOT NULL, name_sender VARCHAR(50) DEFAULT NULL, email_sender VARCHAR(60) NOT NULL, smtp_server VARCHAR(255) DEFAULT NULL, smtp_port VARCHAR(255) DEFAULT NULL, username VARCHAR(255) DEFAULT NULL, password VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invoice (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, btw DOUBLE PRECISION DEFAULT NULL, doc_link VARCHAR(255) DEFAULT NULL, deleted TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE action ADD CONSTRAINT FK_47CC8C92A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE action ADD CONSTRAINT FK_47CC8C92F1C13CD2 FOREIGN KEY (activitiy_id) REFERENCES activity (id)');
        $this->addSql('ALTER TABLE action ADD CONSTRAINT FK_47CC8C922989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id)');
        $this->addSql('ALTER TABLE action ADD CONSTRAINT FK_47CC8C92979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F73F32DD8 FOREIGN KEY (configuration_id) REFERENCES configuration (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE action DROP FOREIGN KEY FK_47CC8C92A76ED395');
        $this->addSql('ALTER TABLE action DROP FOREIGN KEY FK_47CC8C92F1C13CD2');
        $this->addSql('ALTER TABLE action DROP FOREIGN KEY FK_47CC8C922989F1FD');
        $this->addSql('ALTER TABLE action DROP FOREIGN KEY FK_47CC8C92979B1AD6');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094F73F32DD8');
        $this->addSql('DROP TABLE action');
        $this->addSql('DROP TABLE activity');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE configuration');
        $this->addSql('DROP TABLE invoice');
    }
}
