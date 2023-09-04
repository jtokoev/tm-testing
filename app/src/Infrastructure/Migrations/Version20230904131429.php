<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230904131429 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE testtt_id_seq CASCADE');
        $this->addSql('CREATE SEQUENCE member_response_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE member_response_answer_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE member_response (id INT NOT NULL, member_id INT NOT NULL, question_id INT NOT NULL, correct BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_C9A6A8117597D3FE ON member_response (member_id)');
        $this->addSql('CREATE INDEX IDX_C9A6A8111E27F6BF ON member_response (question_id)');
        $this->addSql('CREATE TABLE member_response_answer (id INT NOT NULL, response_id INT NOT NULL, answer_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E32A62E5FBF32840 ON member_response_answer (response_id)');
        $this->addSql('CREATE INDEX IDX_E32A62E5AA334807 ON member_response_answer (answer_id)');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE member_response ADD CONSTRAINT FK_C9A6A8117597D3FE FOREIGN KEY (member_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE member_response ADD CONSTRAINT FK_C9A6A8111E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE member_response_answer ADD CONSTRAINT FK_E32A62E5FBF32840 FOREIGN KEY (response_id) REFERENCES member_response (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE member_response_answer ADD CONSTRAINT FK_E32A62E5AA334807 FOREIGN KEY (answer_id) REFERENCES answer (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE testtt');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE member_response_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE member_response_answer_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('CREATE SEQUENCE testtt_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE testtt (id INT NOT NULL, text VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE member_response DROP CONSTRAINT FK_C9A6A8117597D3FE');
        $this->addSql('ALTER TABLE member_response DROP CONSTRAINT FK_C9A6A8111E27F6BF');
        $this->addSql('ALTER TABLE member_response_answer DROP CONSTRAINT FK_E32A62E5FBF32840');
        $this->addSql('ALTER TABLE member_response_answer DROP CONSTRAINT FK_E32A62E5AA334807');
        $this->addSql('DROP TABLE member_response');
        $this->addSql('DROP TABLE member_response_answer');
        $this->addSql('DROP TABLE "user"');
    }
}
