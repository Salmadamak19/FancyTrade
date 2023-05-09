<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230504215605 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, publication_id INT DEFAULT NULL, user_id INT DEFAULT NULL, content VARCHAR(255) NOT NULL, date DATE NOT NULL, INDEX IDX_9474526C38B217A7 (publication_id), INDEX IDX_9474526CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, post_id INT NOT NULL, imagec VARCHAR(255) DEFAULT \'NULL\', descriptionc VARCHAR(255) NOT NULL, datec DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, analyse_co VARCHAR(255) DEFAULT \'NULL\', datec_ts DATETIME DEFAULT CURRENT_TIMESTAMP, INDEX IDX_67F068BCA76ED395 (user_id), INDEX IDX_67F068BC4B89032C (post_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE echange (id INT AUTO_INCREMENT NOT NULL, produit_id INT DEFAULT NULL, user_id INT DEFAULT NULL, user_request_id INT DEFAULT NULL, produit_request_id INT DEFAULT NULL, statut VARCHAR(255) NOT NULL, date_echange DATE NOT NULL, INDEX IDX_B577E3BFF347EFB (produit_id), INDEX IDX_B577E3BFA76ED395 (user_id), INDEX IDX_B577E3BFE5197E49 (user_request_id), INDEX IDX_B577E3BFEB4681A8 (produit_request_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, place_id INT DEFAULT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, image VARCHAR(255) NOT NULL, dateand_time DATETIME NOT NULL, organiser VARCHAR(255) NOT NULL, INDEX IDX_3BAE0AA7DA6A219 (place_id), INDEX IDX_3BAE0AA7A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event_place (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE post (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, sujet VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, nbr_jaime INT NOT NULL, image VARCHAR(255) DEFAULT \'NULL\', date_p DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, communaute VARCHAR(255) NOT NULL, analyse_po VARCHAR(255) DEFAULT \'NULL\', liked INT DEFAULT NULL, badlevel INT DEFAULT NULL, INDEX IDX_5A8A6C8DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, categorie VARCHAR(255) NOT NULL, valeur INT NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_29A5EC27A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE publication (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, content VARCHAR(255) NOT NULL, date DATE NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_AF3C6779A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reclamation (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, category_id INT NOT NULL, message VARCHAR(180) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', status TINYINT(1) NOT NULL, image VARCHAR(200) DEFAULT NULL, INDEX IDX_CE606404A76ED395 (user_id), INDEX IDX_CE60640412469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reclamation_category (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(180) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reponse (id INT AUTO_INCREMENT NOT NULL, reclamation_id INT NOT NULL, user_id INT DEFAULT NULL, message VARCHAR(180) NOT NULL, UNIQUE INDEX UNIQ_5FB6DEC72D6BA2D9 (reclamation_id), INDEX IDX_5FB6DEC7A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id_user INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(20) NOT NULL, prenom VARCHAR(20) NOT NULL, date_naiss DATE NOT NULL, enabled TINYINT(1) DEFAULT 1 NOT NULL, token VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id_user)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C38B217A7 FOREIGN KEY (publication_id) REFERENCES publication (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCA76ED395 FOREIGN KEY (user_id) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC4B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('ALTER TABLE echange ADD CONSTRAINT FK_B577E3BFF347EFB FOREIGN KEY (produit_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE echange ADD CONSTRAINT FK_B577E3BFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE echange ADD CONSTRAINT FK_B577E3BFE5197E49 FOREIGN KEY (user_request_id) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE echange ADD CONSTRAINT FK_B577E3BFEB4681A8 FOREIGN KEY (produit_request_id) REFERENCES produit (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7DA6A219 FOREIGN KEY (place_id) REFERENCES event_place (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27A76ED395 FOREIGN KEY (user_id) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE publication ADD CONSTRAINT FK_AF3C6779A76ED395 FOREIGN KEY (user_id) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE606404A76ED395 FOREIGN KEY (user_id) REFERENCES user (id_user)');
        $this->addSql('ALTER TABLE reclamation ADD CONSTRAINT FK_CE60640412469DE2 FOREIGN KEY (category_id) REFERENCES reclamation_category (id)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC72D6BA2D9 FOREIGN KEY (reclamation_id) REFERENCES reclamation (id)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC7A76ED395 FOREIGN KEY (user_id) REFERENCES user (id_user)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C38B217A7');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CA76ED395');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCA76ED395');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC4B89032C');
        $this->addSql('ALTER TABLE echange DROP FOREIGN KEY FK_B577E3BFF347EFB');
        $this->addSql('ALTER TABLE echange DROP FOREIGN KEY FK_B577E3BFA76ED395');
        $this->addSql('ALTER TABLE echange DROP FOREIGN KEY FK_B577E3BFE5197E49');
        $this->addSql('ALTER TABLE echange DROP FOREIGN KEY FK_B577E3BFEB4681A8');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7DA6A219');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7A76ED395');
        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8DA76ED395');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27A76ED395');
        $this->addSql('ALTER TABLE publication DROP FOREIGN KEY FK_AF3C6779A76ED395');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE606404A76ED395');
        $this->addSql('ALTER TABLE reclamation DROP FOREIGN KEY FK_CE60640412469DE2');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC72D6BA2D9');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC7A76ED395');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE echange');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE event_place');
        $this->addSql('DROP TABLE post');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE publication');
        $this->addSql('DROP TABLE reclamation');
        $this->addSql('DROP TABLE reclamation_category');
        $this->addSql('DROP TABLE reponse');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
