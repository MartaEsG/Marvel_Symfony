<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230828131411 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE characters_weakness (characters_id INT NOT NULL, weakness_id INT NOT NULL, INDEX IDX_9379394CC70F0E28 (characters_id), INDEX IDX_9379394C908130BC (weakness_id), PRIMARY KEY(characters_id, weakness_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE characters_weakness ADD CONSTRAINT FK_9379394CC70F0E28 FOREIGN KEY (characters_id) REFERENCES characters (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE characters_weakness ADD CONSTRAINT FK_9379394C908130BC FOREIGN KEY (weakness_id) REFERENCES weakness (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE characters_weakness DROP FOREIGN KEY FK_9379394CC70F0E28');
        $this->addSql('ALTER TABLE characters_weakness DROP FOREIGN KEY FK_9379394C908130BC');
        $this->addSql('DROP TABLE characters_weakness');
    }
}
