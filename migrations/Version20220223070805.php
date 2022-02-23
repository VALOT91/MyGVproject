<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220223070805 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE recette (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, image_path VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        // $this->addSql('DROP INDEX UNIQ_1F452A28F347EFB ON produit_conditionnement');
        // $this->addSql('CREATE UNIQUE INDEX UNIQ_1F452A28F347EFB ON produit_conditionnement (produit_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE recette');
        $this->addSql('ALTER TABLE category CHANGE nom nom VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE description description VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE image_path_1 image_path_1 VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE image_path_2 image_path_2 VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE image_path_3 image_path_3 VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE conditionnement CHANGE reference reference VARCHAR(50) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE designation designation VARCHAR(50) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE image_path image_path VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE product CHANGE designation designation VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE description description VARCHAR(500) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE accroche accroche VARCHAR(255) DEFAULT NULL COLLATE `utf8_unicode_ci`, CHANGE composition composition VARCHAR(500) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE reco_dose reco_dose VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE reco_usage reco_usage VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE reco_duree reco_duree VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE video_path video_path VARCHAR(255) DEFAULT NULL COLLATE `utf8_unicode_ci`, CHANGE origine origine VARCHAR(50) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE role role VARCHAR(255) DEFAULT NULL COLLATE `utf8_unicode_ci`, CHANGE resume resume VARCHAR(500) DEFAULT NULL COLLATE `utf8_unicode_ci`');
        // $this->addSql('DROP INDEX UNIQ_1F452A28F347EFB ON produit_conditionnement');
        $this->addSql('ALTER TABLE produit_conditionnement CHANGE reference reference VARCHAR(50) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE image_path image_path VARCHAR(255) DEFAULT NULL COLLATE `utf8_unicode_ci`');
        // $this->addSql('CREATE INDEX UNIQ_1F452A28F347EFB ON produit_conditionnement (produit_id)');
        $this->addSql('ALTER TABLE tarif CHANGE type_prix type_prix VARCHAR(50) NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8_unicode_ci` COMMENT \'(DC2Type:json)\', CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE adresse adresse VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE complement complement VARCHAR(255) DEFAULT NULL COLLATE `utf8_unicode_ci`, CHANGE nom nom VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE prenom prenom VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE telephone telephone VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE ville ville VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE pays pays VARCHAR(4) DEFAULT NULL COLLATE `utf8_unicode_ci`, CHANGE rang_fidelite rang_fidelite VARCHAR(20) DEFAULT NULL COLLATE `utf8_unicode_ci`, CHANGE kbis kbis VARCHAR(255) DEFAULT NULL COLLATE `utf8_unicode_ci`');
    }
}
