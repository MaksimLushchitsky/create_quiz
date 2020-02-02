<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191217121639 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE answer DROP FOREIGN KEY FK_DADD4A254FAF8F53');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494E8337E7D7');
        $this->addSql('DROP TABLE answer');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE quiz');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE answer (id INT AUTO_INCREMENT NOT NULL, question_id_id INT NOT NULL, answers VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, is_true TINYINT(1) NOT NULL, INDEX IDX_DADD4A254FAF8F53 (question_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, quiz_id_id INT NOT NULL, questions VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_B6F7494E8337E7D7 (quiz_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE quiz (id INT AUTO_INCREMENT NOT NULL, quiz VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE answer ADD CONSTRAINT FK_DADD4A254FAF8F53 FOREIGN KEY (question_id_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494E8337E7D7 FOREIGN KEY (quiz_id_id) REFERENCES quiz (id)');
    }
}
