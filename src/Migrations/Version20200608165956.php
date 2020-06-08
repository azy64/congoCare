<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200608165956 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE appointments (id INT AUTO_INCREMENT NOT NULL, hopital_id INT NOT NULL, docteur_id INT NOT NULL, patient_id INT NOT NULL, date_a DATETIME NOT NULL, heure VARCHAR(6) NOT NULL, etat VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_6A41727ACC0FBF92 (hopital_id), UNIQUE INDEX UNIQ_6A41727ACF22540A (docteur_id), UNIQUE INDEX UNIQ_6A41727A6B899279 (patient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patients (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, telephone VARCHAR(12) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, birthday DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hopitaux (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, localisation VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medecins (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, specialite VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, adress VARCHAR(255) DEFAULT NULL, telephone VARCHAR(12) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messages (id INT AUTO_INCREMENT NOT NULL, patient_id INT NOT NULL, docteur_id INT NOT NULL, date DATETIME NOT NULL, message LONGTEXT NOT NULL, INDEX IDX_DB021E966B899279 (patient_id), INDEX IDX_DB021E96CF22540A (docteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE appointments ADD CONSTRAINT FK_6A41727ACC0FBF92 FOREIGN KEY (hopital_id) REFERENCES hopitaux (id)');
        $this->addSql('ALTER TABLE appointments ADD CONSTRAINT FK_6A41727ACF22540A FOREIGN KEY (docteur_id) REFERENCES medecins (id)');
        $this->addSql('ALTER TABLE appointments ADD CONSTRAINT FK_6A41727A6B899279 FOREIGN KEY (patient_id) REFERENCES patients (id)');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT FK_DB021E966B899279 FOREIGN KEY (patient_id) REFERENCES patients (id)');
        $this->addSql('ALTER TABLE messages ADD CONSTRAINT FK_DB021E96CF22540A FOREIGN KEY (docteur_id) REFERENCES medecins (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE appointments DROP FOREIGN KEY FK_6A41727A6B899279');
        $this->addSql('ALTER TABLE messages DROP FOREIGN KEY FK_DB021E966B899279');
        $this->addSql('ALTER TABLE appointments DROP FOREIGN KEY FK_6A41727ACC0FBF92');
        $this->addSql('ALTER TABLE appointments DROP FOREIGN KEY FK_6A41727ACF22540A');
        $this->addSql('ALTER TABLE messages DROP FOREIGN KEY FK_DB021E96CF22540A');
        $this->addSql('DROP TABLE appointments');
        $this->addSql('DROP TABLE patients');
        $this->addSql('DROP TABLE hopitaux');
        $this->addSql('DROP TABLE medecins');
        $this->addSql('DROP TABLE messages');
    }
}
