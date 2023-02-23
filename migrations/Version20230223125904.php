<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230223125904 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE hour_registration (id INT AUTO_INCREMENT NOT NULL, employee_id INT NOT NULL, invoice_id INT DEFAULT NULL, activity_id INT NOT NULL, date DATE NOT NULL, description VARCHAR(500) DEFAULT NULL, hourly_cost DOUBLE PRECISION NOT NULL, time DOUBLE PRECISION DEFAULT NULL, deleted TINYINT(1) DEFAULT NULL, INDEX IDX_E2EC93D38C03F15C (employee_id), INDEX IDX_E2EC93D32989F1FD (invoice_id), INDEX IDX_E2EC93D381C06096 (activity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE hour_registration ADD CONSTRAINT FK_E2EC93D38C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id)');
        $this->addSql('ALTER TABLE hour_registration ADD CONSTRAINT FK_E2EC93D32989F1FD FOREIGN KEY (invoice_id) REFERENCES invoice (id)');
        $this->addSql('ALTER TABLE hour_registration ADD CONSTRAINT FK_E2EC93D381C06096 FOREIGN KEY (activity_id) REFERENCES activity (id)');
        $this->addSql('ALTER TABLE company ADD invoice_address VARCHAR(255) DEFAULT NULL, ADD address VARCHAR(255) DEFAULT NULL, DROP invoice_adress, DROP adress');
        $this->addSql('ALTER TABLE employee ADD user_id INT NOT NULL, ADD company_id INT NOT NULL');
        $this->addSql('ALTER TABLE employee ADD CONSTRAINT FK_5D9F75A1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE employee ADD CONSTRAINT FK_5D9F75A1979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('CREATE INDEX IDX_5D9F75A1A76ED395 ON employee (user_id)');
        $this->addSql('CREATE INDEX IDX_5D9F75A1979B1AD6 ON employee (company_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hour_registration DROP FOREIGN KEY FK_E2EC93D38C03F15C');
        $this->addSql('ALTER TABLE hour_registration DROP FOREIGN KEY FK_E2EC93D32989F1FD');
        $this->addSql('ALTER TABLE hour_registration DROP FOREIGN KEY FK_E2EC93D381C06096');
        $this->addSql('DROP TABLE hour_registration');
        $this->addSql('ALTER TABLE employee DROP FOREIGN KEY FK_5D9F75A1A76ED395');
        $this->addSql('ALTER TABLE employee DROP FOREIGN KEY FK_5D9F75A1979B1AD6');
        $this->addSql('DROP INDEX IDX_5D9F75A1A76ED395 ON employee');
        $this->addSql('DROP INDEX IDX_5D9F75A1979B1AD6 ON employee');
        $this->addSql('ALTER TABLE employee DROP user_id, DROP company_id');
        $this->addSql('ALTER TABLE company ADD invoice_adress VARCHAR(255) DEFAULT NULL, ADD adress VARCHAR(255) DEFAULT NULL, DROP invoice_address, DROP address');
    }
}
