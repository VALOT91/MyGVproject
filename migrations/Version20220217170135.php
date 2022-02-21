<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220217170135 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, image_path_1 VARCHAR(255) NOT NULL, image_path_2 VARCHAR(255) NOT NULL, image_path_3 VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE conditionnement (id INT AUTO_INCREMENT NOT NULL, reference VARCHAR(50) NOT NULL, designation VARCHAR(50) NOT NULL, poids INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, designation VARCHAR(255) NOT NULL, description VARCHAR(500) NOT NULL, accroche VARCHAR(255) DEFAULT NULL, composition VARCHAR(500) NOT NULL, reco_dose VARCHAR(255) NOT NULL, reco_usage VARCHAR(255) NOT NULL, reco_duree VARCHAR(255) NOT NULL, video_path VARCHAR(255) DEFAULT NULL, is_bio TINYINT(1) NOT NULL, origine VARCHAR(50) NOT NULL, role VARCHAR(255) DEFAULT NULL, resume VARCHAR(500) DEFAULT NULL, parent TINYINT(1) DEFAULT NULL, INDEX IDX_D34A04AD12469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit_conditionnement (id INT AUTO_INCREMENT NOT NULL, conditionnement_id INT NOT NULL, produit_id INT NOT NULL, reference VARCHAR(50) NOT NULL, image_path VARCHAR(255) DEFAULT NULL, quantite_stock INT DEFAULT NULL, INDEX IDX_1F452A28A222637 (conditionnement_id), UNIQUE INDEX UNIQ_1F452A28F347EFB (produit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tarif (id INT AUTO_INCREMENT NOT NULL, produit_conditionnement_id INT NOT NULL, prix_unitaire INT DEFAULT NULL, type_prix VARCHAR(50) NOT NULL, INDEX IDX_E7189C939C2AB40 (produit_conditionnement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, code_postal INT NOT NULL, complement VARCHAR(255) DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, ville VARCHAR(255) NOT NULL, points_fidelite INT DEFAULT NULL, pays VARCHAR(4) DEFAULT NULL, rang_fidelite VARCHAR(20) DEFAULT NULL, kbis VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE produit_conditionnement ADD CONSTRAINT FK_1F452A28A222637 FOREIGN KEY (conditionnement_id) REFERENCES conditionnement (id)');
        $this->addSql('ALTER TABLE produit_conditionnement ADD CONSTRAINT FK_1F452A28F347EFB FOREIGN KEY (produit_id) REFERENCES product (id)');
        $this->addSql('ALTER TABLE tarif ADD CONSTRAINT FK_E7189C939C2AB40 FOREIGN KEY (produit_conditionnement_id) REFERENCES produit_conditionnement (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD12469DE2');
        $this->addSql('ALTER TABLE produit_conditionnement DROP FOREIGN KEY FK_1F452A28A222637');
        $this->addSql('ALTER TABLE produit_conditionnement DROP FOREIGN KEY FK_1F452A28F347EFB');
        $this->addSql('ALTER TABLE tarif DROP FOREIGN KEY FK_E7189C939C2AB40');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE conditionnement');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE produit_conditionnement');
        $this->addSql('DROP TABLE tarif');
        $this->addSql('DROP TABLE user');
    }
}
