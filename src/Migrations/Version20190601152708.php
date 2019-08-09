<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190601152708 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE question_qcm_user (question_qcm_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_7E70E5D8F83F6EAE (question_qcm_id), INDEX IDX_7E70E5D8A76ED395 (user_id), PRIMARY KEY(question_qcm_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE question_qcm_user ADD CONSTRAINT FK_7E70E5D8F83F6EAE FOREIGN KEY (question_qcm_id) REFERENCES question_qcm (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE question_qcm_user ADD CONSTRAINT FK_7E70E5D8A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE question_qcm DROP user_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE question_qcm_user');
        $this->addSql('ALTER TABLE proposition DROP FOREIGN KEY FK_C7CDC3531E27F6BF');
        $this->addSql('ALTER TABLE question_qcm ADD user_id INT NOT NULL');
    }
}
