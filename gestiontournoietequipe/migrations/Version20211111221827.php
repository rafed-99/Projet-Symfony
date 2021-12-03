<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211111221827 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE equipe (idequipe INT NOT NULL, nomequipe VARCHAR(30) NOT NULL, nbreffectif INT NOT NULL, nompresidentequipe VARCHAR(30) NOT NULL, nomentrqineurequipe VARCHAR(30) NOT NULL, nomcapitaineesuipe VARCHAR(30) NOT NULL, PRIMARY KEY(idequipe)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tournoi (idtournoi INT NOT NULL, nomtournoi VARCHAR(30) NOT NULL, nbrequipes INT NOT NULL, datedebuttournoi DATE NOT NULL, datefintournoi DATE NOT NULL, heurematchtournoi TIME NOT NULL, nbrpoules INT NOT NULL, PRIMARY KEY(idtournoi)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE equipe');
        $this->addSql('DROP TABLE tournoi');
    }
}
