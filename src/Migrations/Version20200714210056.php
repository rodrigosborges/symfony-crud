<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200714210056 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE marca (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carro (id INT AUTO_INCREMENT NOT NULL, modelo_id INT NOT NULL, proprietario VARCHAR(100) NOT NULL, placa VARCHAR(8) NOT NULL, INDEX IDX_C5BB165C3A9576E (modelo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE modelo (id INT AUTO_INCREMENT NOT NULL, marca_id INT NOT NULL, nome VARCHAR(100) NOT NULL, INDEX IDX_F0D76C4681EF0041 (marca_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE carro ADD CONSTRAINT FK_C5BB165C3A9576E FOREIGN KEY (modelo_id) REFERENCES modelo (id)');
        $this->addSql('ALTER TABLE modelo ADD CONSTRAINT FK_F0D76C4681EF0041 FOREIGN KEY (marca_id) REFERENCES marca (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE modelo DROP FOREIGN KEY FK_F0D76C4681EF0041');
        $this->addSql('ALTER TABLE carro DROP FOREIGN KEY FK_C5BB165C3A9576E');
        $this->addSql('DROP TABLE marca');
        $this->addSql('DROP TABLE carro');
        $this->addSql('DROP TABLE modelo');
    }
}
