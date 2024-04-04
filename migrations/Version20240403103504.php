<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240403103504 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE label DROP FOREIGN KEY FK_EA750E8E40BF570');
        $this->addSql('DROP INDEX IDX_EA750E8E40BF570 ON label');
        $this->addSql('ALTER TABLE label CHANGE last_modifed_by_id last_modified_by_id INT NOT NULL');
        $this->addSql('ALTER TABLE label ADD CONSTRAINT FK_EA750E8F703974A FOREIGN KEY (last_modified_by_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_EA750E8F703974A ON label (last_modified_by_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE label DROP FOREIGN KEY FK_EA750E8F703974A');
        $this->addSql('DROP INDEX IDX_EA750E8F703974A ON label');
        $this->addSql('ALTER TABLE label CHANGE last_modified_by_id last_modifed_by_id INT NOT NULL');
        $this->addSql('ALTER TABLE label ADD CONSTRAINT FK_EA750E8E40BF570 FOREIGN KEY (last_modifed_by_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_EA750E8E40BF570 ON label (last_modifed_by_id)');
    }
}
