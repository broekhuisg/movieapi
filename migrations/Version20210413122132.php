<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210413122132 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cast (id INT AUTO_INCREMENT NOT NULL, person_id INT NOT NULL, media_id INT NOT NULL, role VARCHAR(255) NOT NULL, INDEX IDX_12B8B9F6217BBB47 (person_id), INDEX IDX_12B8B9F6EA9FDD75 (media_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, poster_path VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movie (id INT NOT NULL, duration VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tv_show (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, poster_path VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tv_show_episode (id INT NOT NULL, season_id INT DEFAULT NULL, duration INT NOT NULL, episode_number INT NOT NULL, INDEX IDX_A68951C94EC001D1 (season_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tv_show_season (id INT AUTO_INCREMENT NOT NULL, tv_show_id INT DEFAULT NULL, season_number INT NOT NULL, INDEX IDX_6282E6635E3A35BB (tv_show_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cast ADD CONSTRAINT FK_12B8B9F6217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE cast ADD CONSTRAINT FK_12B8B9F6EA9FDD75 FOREIGN KEY (media_id) REFERENCES media (id)');
        $this->addSql('ALTER TABLE movie ADD CONSTRAINT FK_1D5EF26FBF396750 FOREIGN KEY (id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tv_show_episode ADD CONSTRAINT FK_A68951C94EC001D1 FOREIGN KEY (season_id) REFERENCES tv_show_season (id)');
        $this->addSql('ALTER TABLE tv_show_episode ADD CONSTRAINT FK_A68951C9BF396750 FOREIGN KEY (id) REFERENCES media (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tv_show_season ADD CONSTRAINT FK_6282E6635E3A35BB FOREIGN KEY (tv_show_id) REFERENCES tv_show (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cast DROP FOREIGN KEY FK_12B8B9F6EA9FDD75');
        $this->addSql('ALTER TABLE movie DROP FOREIGN KEY FK_1D5EF26FBF396750');
        $this->addSql('ALTER TABLE tv_show_episode DROP FOREIGN KEY FK_A68951C9BF396750');
        $this->addSql('ALTER TABLE cast DROP FOREIGN KEY FK_12B8B9F6217BBB47');
        $this->addSql('ALTER TABLE tv_show_season DROP FOREIGN KEY FK_6282E6635E3A35BB');
        $this->addSql('ALTER TABLE tv_show_episode DROP FOREIGN KEY FK_A68951C94EC001D1');
        $this->addSql('DROP TABLE cast');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE movie');
        $this->addSql('DROP TABLE person');
        $this->addSql('DROP TABLE tv_show');
        $this->addSql('DROP TABLE tv_show_episode');
        $this->addSql('DROP TABLE tv_show_season');
    }
}
