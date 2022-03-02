<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220302115216 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product ADD reference VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE produit_conditionnement CHANGE conditionnement_id conditionnement_id INT DEFAULT NULL, CHANGE image_path image_path VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE produit_conditionnement ADD CONSTRAINT FK_1F452A28A222637 FOREIGN KEY (conditionnement_id) REFERENCES conditionnement (id)');
        $this->addSql('ALTER TABLE produit_conditionnement ADD CONSTRAINT FK_1F452A28F347EFB FOREIGN KEY (produit_id) REFERENCES product (id)');
        $this->addSql('CREATE INDEX IDX_1F452A28A222637 ON produit_conditionnement (conditionnement_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1F452A28F347EFB ON produit_conditionnement (produit_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category CHANGE nom nom VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE description description VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE image_path_1 image_path_1 VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE image_path_2 image_path_2 VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE image_path_3 image_path_3 VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE command_shop_line CHANGE conditionnement conditionnement VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE conditionnement CHANGE reference reference VARCHAR(50) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE designation designation VARCHAR(50) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE image_path image_path VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE delivery_address CHANGE country country VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE city city VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE postal_code postal_code VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE street street VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE complement complement VARCHAR(255) DEFAULT NULL COLLATE `utf8_unicode_ci`, CHANGE commentary commentary VARCHAR(255) DEFAULT NULL COLLATE `utf8_unicode_ci`, CHANGE raison_soc raison_soc VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE product DROP reference, CHANGE designation designation VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE description description VARCHAR(500) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE accroche accroche VARCHAR(255) DEFAULT NULL COLLATE `utf8_unicode_ci`, CHANGE composition composition VARCHAR(500) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE reco_dose reco_dose VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE reco_usage reco_usage VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE reco_duree reco_duree VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE video_path video_path VARCHAR(255) DEFAULT NULL COLLATE `utf8_unicode_ci`, CHANGE origine origine VARCHAR(50) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE role role VARCHAR(255) DEFAULT NULL COLLATE `utf8_unicode_ci`, CHANGE resume resume VARCHAR(500) DEFAULT NULL COLLATE `utf8_unicode_ci`, CHANGE reco_temp reco_temp VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE produit_conditionnement DROP FOREIGN KEY FK_1F452A28A222637');
        $this->addSql('ALTER TABLE produit_conditionnement DROP FOREIGN KEY FK_1F452A28F347EFB');
        $this->addSql('DROP INDEX IDX_1F452A28A222637 ON produit_conditionnement');
        $this->addSql('DROP INDEX UNIQ_1F452A28F347EFB ON produit_conditionnement');
        $this->addSql('ALTER TABLE produit_conditionnement CHANGE conditionnement_id conditionnement_id INT NOT NULL, CHANGE reference reference VARCHAR(50) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE image_path image_path VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE recette CHANGE nom nom VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE description description VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE image_path image_path VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE tarif CHANGE type_prix type_prix VARCHAR(50) NOT NULL COLLATE `utf8_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8_unicode_ci` COMMENT \'(DC2Type:json)\', CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE adresse adresse VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE complement complement VARCHAR(255) DEFAULT NULL COLLATE `utf8_unicode_ci`, CHANGE nom nom VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE prenom prenom VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE telephone telephone VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE ville ville VARCHAR(255) NOT NULL COLLATE `utf8_unicode_ci`, CHANGE pays pays VARCHAR(4) DEFAULT NULL COLLATE `utf8_unicode_ci`, CHANGE rang_fidelite rang_fidelite VARCHAR(20) DEFAULT NULL COLLATE `utf8_unicode_ci`, CHANGE kbis kbis VARCHAR(255) DEFAULT NULL COLLATE `utf8_unicode_ci`');
    }
}
