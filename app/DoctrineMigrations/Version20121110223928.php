<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20121110223928 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is autogenerated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        
        $this->addSql("CREATE TABLE CapAchievement (id INT AUTO_INCREMENT NOT NULL, runner_id INT DEFAULT NULL, goal_id INT DEFAULT NULL, date DATE NOT NULL, INDEX IDX_602468083C7FB593 (runner_id), INDEX IDX_60246808667D1AFE (goal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE CapAchievement ADD CONSTRAINT FK_602468083C7FB593 FOREIGN KEY (runner_id) REFERENCES CapRunner (id)");
        $this->addSql("ALTER TABLE CapAchievement ADD CONSTRAINT FK_60246808667D1AFE FOREIGN KEY (goal_id) REFERENCES CapGoal (id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is autogenerated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql");
        
        $this->addSql("DROP TABLE CapAchievement");
    }
}
