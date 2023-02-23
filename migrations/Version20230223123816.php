<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230223123816 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE action DROP FOREIGN KEY FK_47CC8C922989F1FD');
        $this->addSql('ALTER TABLE action DROP FOREIGN KEY FK_47CC8C92979B1AD6');
        $this->addSql('ALTER TABLE action DROP FOREIGN KEY FK_47CC8C92A76ED395');
        $this->addSql('ALTER TABLE action DROP FOREIGN KEY FK_47CC8C92F1C13CD2');
        $this->addSql('DROP TABLE action');
        $this->addSql('ALTER TABLE user CHANGE adress address VARCHAR(70) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE action (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, activitiy_id INT NOT NULL, invoice_id INT DEFAULT NULL, company_id INT NOT NULL, date DATE NOT NULL, description VARCHAR(500) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, hourly_cost DOUBLE PRECISION DEFAULT NULL, time DOUBLE PRECISION NOT NULL, deleted TINYINT(1) DEFAULT NULL, INDEX IDX_47CC8C92A76ED395 (user_id), INDEX IDX_47CC8C92F1C13CD2 (activitiy_id), INDEX IDX_47CC8C922989F1FD (invoice_id), INDEX IDX_47CC8C92979B1AD6 (company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE action ADD CONSTRAINT FK_47CC8C922989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE action ADD CONSTRAINT FK_47CC8C92979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE action ADD CONSTRAINT FK_47CC8C92A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE action ADD CONSTRAINT FK_47CC8C92F1C13CD2 FOREIGN KEY (activitiy_id) REFERENCES activity (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE user CHANGE address adress VARCHAR(70) DEFAULT NULL');
    }
}
