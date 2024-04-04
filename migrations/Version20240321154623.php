<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240321154623 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE page ADD CONSTRAINT FK_140AB6205DA0FB8 FOREIGN KEY (template_id) REFERENCES template (id)');
        $this->addSql('CREATE INDEX IDX_140AB6205DA0FB8 ON page (template_id)');
        $this->addSql('ALTER TABLE slide ADD slider_id INT NOT NULL');
        $this->addSql('ALTER TABLE slide ADD CONSTRAINT FK_72EFEE622CCC9638 FOREIGN KEY (slider_id) REFERENCES slider (id)');
        $this->addSql('CREATE INDEX IDX_72EFEE622CCC9638 ON slide (slider_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE slide DROP FOREIGN KEY FK_72EFEE622CCC9638');
        $this->addSql('DROP INDEX IDX_72EFEE622CCC9638 ON slide');
        $this->addSql('ALTER TABLE slide DROP slider_id');
        $this->addSql('ALTER TABLE page DROP FOREIGN KEY FK_140AB6205DA0FB8');
        $this->addSql('DROP INDEX IDX_140AB6205DA0FB8 ON page');
    }
}
