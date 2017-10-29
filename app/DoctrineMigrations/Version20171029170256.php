<?php declare(strict_types = 1);

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171029170256 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category_comment DROP FOREIGN KEY FK_53AC12124B89032C');
        $this->addSql('DROP INDEX IDX_53AC12124B89032C ON category_comment');
        $this->addSql('ALTER TABLE category_comment CHANGE post_id category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE category_comment ADD CONSTRAINT FK_53AC121212469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_53AC121212469DE2 ON category_comment (category_id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE category_comment DROP FOREIGN KEY FK_53AC121212469DE2');
        $this->addSql('DROP INDEX IDX_53AC121212469DE2 ON category_comment');
        $this->addSql('ALTER TABLE category_comment CHANGE category_id post_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE category_comment ADD CONSTRAINT FK_53AC12124B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_53AC12124B89032C ON category_comment (post_id)');
    }
}
