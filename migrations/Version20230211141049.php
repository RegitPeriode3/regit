<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230211141049 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE clearence (id INT AUTO_INCREMENT NOT NULL, role VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD clearence_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6494C6EABB0 FOREIGN KEY (clearence_id) REFERENCES clearence (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6494C6EABB0 ON user (clearence_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6494C6EABB0');
        $this->addSql('DROP TABLE clearence');
        $this->addSql('DROP INDEX IDX_8D93D6494C6EABB0 ON user');
        $this->addSql('ALTER TABLE user DROP clearence_id');
    }
}
