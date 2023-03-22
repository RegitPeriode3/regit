<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230321182633 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE company CHANGE configuration_id configuration_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE hour_registration DROP FOREIGN KEY FK_E2EC93D38C03F15C');
        $this->addSql('DROP INDEX IDX_E2EC93D38C03F15C ON hour_registration');
        $this->addSql('ALTER TABLE hour_registration ADD company_id INT DEFAULT NULL, ADD user_id INT DEFAULT NULL, ADD project_id INT DEFAULT NULL, DROP employee_id');
        $this->addSql('ALTER TABLE hour_registration ADD CONSTRAINT FK_E2EC93D3979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE hour_registration ADD CONSTRAINT FK_E2EC93D3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE hour_registration ADD CONSTRAINT FK_E2EC93D3166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('CREATE INDEX IDX_E2EC93D3979B1AD6 ON hour_registration (company_id)');
        $this->addSql('CREATE INDEX IDX_E2EC93D3A76ED395 ON hour_registration (user_id)');
        $this->addSql('CREATE INDEX IDX_E2EC93D3166D1F9C ON hour_registration (project_id)');
        $this->addSql('ALTER TABLE invoice ADD invoice_number VARCHAR(25) DEFAULT NULL');
        $this->addSql('ALTER TABLE project ADD deleted TINYINT(1) NOT NULL, CHANGE company_id company_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EE979B1AD6');
        $this->addSql('ALTER TABLE project DROP deleted, CHANGE company_id company_id INT NOT NULL');
        $this->addSql('ALTER TABLE company CHANGE configuration_id configuration_id INT NOT NULL');
        $this->addSql('ALTER TABLE hour_registration DROP FOREIGN KEY FK_E2EC93D3979B1AD6');
        $this->addSql('ALTER TABLE hour_registration DROP FOREIGN KEY FK_E2EC93D3A76ED395');
        $this->addSql('ALTER TABLE hour_registration DROP FOREIGN KEY FK_E2EC93D3166D1F9C');
        $this->addSql('DROP INDEX IDX_E2EC93D3979B1AD6 ON hour_registration');
        $this->addSql('DROP INDEX IDX_E2EC93D3A76ED395 ON hour_registration');
        $this->addSql('DROP INDEX IDX_E2EC93D3166D1F9C ON hour_registration');
        $this->addSql('ALTER TABLE hour_registration ADD employee_id INT NOT NULL, DROP company_id, DROP user_id, DROP project_id');
        $this->addSql('ALTER TABLE hour_registration ADD CONSTRAINT FK_E2EC93D38C03F15C FOREIGN KEY (employee_id) REFERENCES employee (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_E2EC93D38C03F15C ON hour_registration (employee_id)');
        $this->addSql('ALTER TABLE invoice DROP invoice_number');
    }
}
