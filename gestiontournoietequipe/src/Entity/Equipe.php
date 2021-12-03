<?php

namespace App\Entity;

use App\Repository\EquipeRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=EquipeRepository::class)
 */
class Equipe
{


    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @Assert\NotEqualTo("00000000")
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 8,
     *      minMessage = "Your id must be at least {{ limit }} characters long",
     *      maxMessage = "Your id cannot be longer than {{ limit }} characters"
     * )
     */
    private $idequipe;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\Length(
     *      min = 2,
     *      max = 30,
     *      minMessage = "Name Equipe must be at least {{ limit }} characters long",
     *      maxMessage = "Name Equipe cannot be longer than {{ limit }} characters"
     * )
     * @Assert\NotBlank
     */
    private $nomequipe;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     * @Assert\Positive
     * @Assert\GreaterThan(10)
     * @Assert\LessThan(30)
     */
    private $nbreffectif;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\Length(
     *      min = 2,
     *      max = 30,
     *      minMessage = "Name President Equipe must be at least {{ limit }} characters long",
     *      maxMessage = "Name President Equipe cannot be longer than {{ limit }} characters"
     * )
     * @Assert\NotBlank
     */
    private $nompresidentequipe;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\Length(
     *      min = 2,
     *      max = 30,
     *      minMessage = "Name Capitaine Equipe must be at least {{ limit }} characters long",
     *      maxMessage = "Name Entraineur Equipe cannot be longer than {{ limit }} characters"
     * )
     * @Assert\NotBlank
     */
    private $nomentrqineurequipe;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\Length(
     *      min = 2,
     *      max = 30,
     *      minMessage = "Name Capitaine Equipe must be at least {{ limit }} characters long",
     *      maxMessage = "Name Capitaine Equipe cannot be longer than {{ limit }} characters"
     * )
     * @Assert\NotBlank
     */
    private $nomcapitaineesuipe;


    public function getIdequipe(): ?int
    {
        return $this->idequipe;
    }

    public function setIdequipe(int $idequipe): self
    {
        $this->idequipe = $idequipe;

        return $this;
    }

    public function getNomequipe(): ?string
    {
        return $this->nomequipe;
    }

    public function setNomequipe(string $nomequipe): self
    {
        $this->nomequipe = $nomequipe;

        return $this;
    }

    public function getNbreffectif(): ?int
    {
        return $this->nbreffectif;
    }

    public function setNbreffectif(int $nbreffectif): self
    {
        $this->nbreffectif = $nbreffectif;

        return $this;
    }

    public function getNompresidentequipe(): ?string
    {
        return $this->nompresidentequipe;
    }

    public function setNompresidentequipe(string $nompresidentequipe): self
    {
        $this->nompresidentequipe = $nompresidentequipe;

        return $this;
    }

    public function getNomentrqineurequipe(): ?string
    {
        return $this->nomentrqineurequipe;
    }

    public function setNomentrqineurequipe(string $nomentrqineurequipe): self
    {
        $this->nomentrqineurequipe = $nomentrqineurequipe;

        return $this;
    }

    public function getNomcapitaineesuipe(): ?string
    {
        return $this->nomcapitaineesuipe;
    }

    public function setNomcapitaineesuipe(string $nomcapitaineesuipe): self
    {
        $this->nomcapitaineesuipe = $nomcapitaineesuipe;

        return $this;
    }
}
