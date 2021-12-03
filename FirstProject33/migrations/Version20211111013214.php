<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211111013214 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE match_foot (ref_match VARCHAR(20) NOT NULL, date_match VARCHAR(20) NOT NULL, nom_stade VARCHAR(20) NOT NULL, nbr_spectateur INT NOT NULL, PRIMARY KEY(ref_match)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id_reservation INT AUTO_INCREMENT NOT NULL, cin_client INT NOT NULL, ref_match VARCHAR(20) NOT NULL, num_ticket VARCHAR(20) NOT NULL, date_reservation DATE NOT NULL, PRIMARY KEY(id_reservation)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket (num_ticket VARCHAR(20) NOT NULL, ref_match VARCHAR(20) NOT NULL, num_place VARCHAR(20) NOT NULL, disp VARCHAR(10) NOT NULL, PRIMARY KEY(num_ticket)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE match_foot');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE ticket');
    }
}
