<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211128150659 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE post_image');
        $this->addSql('DROP TABLE post_video');
        $this->addSql('ALTER TABLE artist ADD avatar VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD post_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F4B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_C53D045F4B89032C ON image (post_id)');
        $this->addSql('ALTER TABLE video ADD post_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2C4B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_7CC7DA2C4B89032C ON video (post_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE post_image (post_id INT NOT NULL, image_id INT NOT NULL, INDEX IDX_522688B03DA5256D (image_id), INDEX IDX_522688B04B89032C (post_id), PRIMARY KEY(post_id, image_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE post_video (post_id INT NOT NULL, video_id INT NOT NULL, INDEX IDX_EBDC56C329C1004E (video_id), INDEX IDX_EBDC56C34B89032C (post_id), PRIMARY KEY(post_id, video_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE post_image ADD CONSTRAINT FK_522688B03DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post_image ADD CONSTRAINT FK_522688B04B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post_video ADD CONSTRAINT FK_EBDC56C329C1004E FOREIGN KEY (video_id) REFERENCES video (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE post_video ADD CONSTRAINT FK_EBDC56C34B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist DROP avatar');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F4B89032C');
        $this->addSql('DROP INDEX IDX_C53D045F4B89032C ON image');
        $this->addSql('ALTER TABLE image DROP post_id');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2C4B89032C');
        $this->addSql('DROP INDEX IDX_7CC7DA2C4B89032C ON video');
        $this->addSql('ALTER TABLE video DROP post_id');
    }
}
