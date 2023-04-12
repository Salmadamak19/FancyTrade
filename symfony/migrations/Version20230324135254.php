<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230324135254 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC4B89032C');
        $this->addSql('ALTER TABLE commentairee DROP FOREIGN KEY fk_id_userr');
        $this->addSql('ALTER TABLE commentairee DROP FOREIGN KEY fk_poste');
        $this->addSql('ALTER TABLE conv DROP FOREIGN KEY fk_iduser2');
        $this->addSql('ALTER TABLE conv DROP FOREIGN KEY fk_iduser1');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY fk_conv');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY fk_sender');
        $this->addSql('ALTER TABLE poste DROP FOREIGN KEY fk_user');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY ezadaz');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY zadzad');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE commentairee');
        $this->addSql('DROP TABLE conv');
        $this->addSql('DROP TABLE echange');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE poste');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE rating');
        $this->addSql('DROP TABLE reclamation');
        $this->addSql('DROP TABLE reclamation_category');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE utilisateur');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, post_id INT DEFAULT NULL, nomuser VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, imagec VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, descriptionc VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, datec VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'CURRENT_TIMESTAMP\' NOT NULL COLLATE `utf8mb4_unicode_ci`, analyse_co VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, datec_ts DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX IDX_67F068BC4B89032C (post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE commentairee (id INT AUTO_INCREMENT NOT NULL, id_poste INT NOT NULL, id_user INT NOT NULL, description VARCHAR(500) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, date DATE NOT NULL, INDEX fk_c_user (id_user), INDEX fk_c_poste (id_poste), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE conv (id INT AUTO_INCREMENT NOT NULL, idconv_user INT NOT NULL, idconv_user2 INT NOT NULL, INDEX fk_iduser2 (idconv_user2), INDEX fk_iduser1 (idconv_user), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE echange (ID_echange INT AUTO_INCREMENT NOT NULL, ID_produit INT NOT NULL, ID_user INT NOT NULL, Statut VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, Date d\'échange DATE NOT NULL, INDEX fk_Id (ID_user, ID_produit), PRIMARY KEY(ID_echange)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE message (id_message INT AUTO_INCREMENT NOT NULL, from_user INT NOT NULL, to_conv INT NOT NULL, message_text TEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, date_time DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, INDEX fk_conv (to_conv), INDEX fk_sender (from_user), PRIMARY KEY(id_message)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, sujet VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, nbr_jaime INT NOT NULL, image VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, nom_user VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_p DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, communaute VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, analyse_po VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, liked INT DEFAULT 0, badlevel INT DEFAULT 0, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE poste (id INT AUTO_INCREMENT NOT NULL, id_user INT NOT NULL, titre VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, img VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, categorie VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, date DATE NOT NULL, INDEX fk_id_user (id_user), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE produit (ID_produit INT AUTO_INCREMENT NOT NULL, ID_user INT NOT NULL, Categorie VARCHAR(255) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, Valeur INT NOT NULL, INDEX fk_Iduser (ID_user), PRIMARY KEY(ID_produit)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = MyISAM COMMENT = \'\' ');
        $this->addSql('CREATE TABLE rating (id_Rating INT AUTO_INCREMENT NOT NULL, id_post INT NOT NULL, id_user INT NOT NULL, rating DOUBLE PRECISION NOT NULL, PRIMARY KEY(id_Rating)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reclamation (id INT AUTO_INCREMENT NOT NULL, reclamation_category_id INT NOT NULL, id_user INT NOT NULL, reclamation_type VARCHAR(30) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, reclamation_Date DATE NOT NULL, contenu VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, objet VARCHAR(20) CHARACTER SET utf8 DEFAULT NULL COLLATE `utf8_general_ci`, INDEX zadzad (id_user), INDEX ezadaz (reclamation_category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE reclamation_category (category_id INT NOT NULL, name VARCHAR(25) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, description_cat VARCHAR(50) CHARACTER SET utf8 NOT NULL COLLATE `utf8_general_ci`, PRIMARY KEY(category_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE user (id_user INT AUTO_INCREMENT NOT NULL, nom VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, prenom VARCHAR(20) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, date_naiss DATE NOT NULL, email VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, mot_de_passe VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, type VARCHAR(10) CHARACTER SET utf8mb4 DEFAULT \'Normal\' NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(id_user)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, prenom VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, email VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, age INT NOT NULL, mdp VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, role VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, verification_code VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC4B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE commentairee ADD CONSTRAINT fk_id_userr FOREIGN KEY (id_user) REFERENCES user (id_user) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commentairee ADD CONSTRAINT fk_poste FOREIGN KEY (id_poste) REFERENCES poste (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE conv ADD CONSTRAINT fk_iduser2 FOREIGN KEY (idconv_user2) REFERENCES utilisateur (id) ON UPDATE CASCADE ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE conv ADD CONSTRAINT fk_iduser1 FOREIGN KEY (idconv_user) REFERENCES utilisateur (id) ON UPDATE CASCADE ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT fk_conv FOREIGN KEY (to_conv) REFERENCES conv (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT fk_sender FOREIGN KEY (from_user) REFERENCES utilisateur (id) ON UPDATE CASCADE ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE poste ADD CONSTRAINT fk_user FOREIGN KEY (id_user) REFERENCES utilisateur (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT ezadaz FOREIGN KEY (reclamation_category_id) REFERENCES reclamation_category (category_id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT zadzad FOREIGN KEY (id_user) REFERENCES utilisateur (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
