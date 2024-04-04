<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240402204340 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE slide DROP FOREIGN KEY FK_72EFEE622CCC9638');
        $this->addSql('ALTER TABLE slider DROP FOREIGN KEY FK_CFC71007C375B8D2');
        $this->addSql('DROP TABLE slider');
        $this->addSql('DROP INDEX IDX_72EFEE622CCC9638 ON slide');
        $this->addSql('ALTER TABLE slide DROP slider_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE slider (id INT AUTO_INCREMENT NOT NULL, last_update_by_id INT DEFAULT NULL, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_CFC71007C375B8D2 (last_update_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE slider ADD CONSTRAINT FK_CFC71007C375B8D2 FOREIGN KEY (last_update_by_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE slide ADD slider_id INT NOT NULL');
        $this->addSql('ALTER TABLE slide ADD CONSTRAINT FK_72EFEE622CCC9638 FOREIGN KEY (slider_id) REFERENCES slider (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_72EFEE622CCC9638 ON slide (slider_id)');
    }
}
