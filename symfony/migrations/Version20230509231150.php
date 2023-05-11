<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230509231150 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_8A8E26E9EA3686FA ON conversation');
        $this->addSql('DROP INDEX IDX_8A8E26E95B09067D ON conversation');
        $this->addSql('ALTER TABLE conversation ADD idconv_user VARCHAR(255) NOT NULL, ADD idconv_user2 VARCHAR(255) NOT NULL, DROP idconv_user_id, DROP idconv_user2_id');
        $this->addSql('DROP INDEX IDX_B6BD307FA15E2332 ON message');
        $this->addSql('DROP INDEX IDX_B6BD307F2130303A ON message');
        $this->addSql('ALTER TABLE message ADD from_user VARCHAR(255) NOT NULL, ADD to_conv VARCHAR(255) NOT NULL, DROP from_user_id, DROP to_conv_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conversation ADD idconv_user_id INT NOT NULL, ADD idconv_user2_id INT NOT NULL, DROP idconv_user, DROP idconv_user2');
        $this->addSql('CREATE INDEX IDX_8A8E26E9EA3686FA ON conversation (idconv_user2_id)');
        $this->addSql('CREATE INDEX IDX_8A8E26E95B09067D ON conversation (idconv_user_id)');
        $this->addSql('ALTER TABLE message ADD from_user_id INT NOT NULL, ADD to_conv_id INT NOT NULL, DROP from_user, DROP to_conv');
        $this->addSql('CREATE INDEX IDX_B6BD307FA15E2332 ON message (to_conv_id)');
        $this->addSql('CREATE INDEX IDX_B6BD307F2130303A ON message (from_user_id)');
    }
}
