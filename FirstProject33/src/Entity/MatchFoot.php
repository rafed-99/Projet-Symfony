<?php

namespace App\Entity;

use App\Repository\MatchFootRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=MatchFootRepository::class)
 */
class MatchFoot
{


    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=20)
     *  @Assert\NotEqualTo("0000000000")
     * @Assert\NotBlank
     * @Assert\Length(
     *      min = 2,
     *      max = 10,
     *      minMessage = "Your ref match must be at least {{ limit }} characters long",
     *      maxMessage = "Your ref match cannot be longer than {{ limit }} characters"
     * )
     */
    private $ref_match;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank
     */
    private $date_match;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank
     *  @Assert\Length(
     *      max = 30,
     *      maxMessage = "Your date match cannot be longer than {{ limit }} characters"
     * )
     */
    private $nom_stade;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     */
    private $nbr_spectateur;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRefMatch(): ?string
    {
        return $this->ref_match;
    }

    public function setRefMatch(string $ref_match): self
    {
        $this->ref_match = $ref_match;

        return $this;
    }

    public function getDateMatch(): ?string
    {
        return $this->date_match;
    }

    public function setDateMatch(string $date_match): self
    {
        $this->date_match = $date_match;

        return $this;
    }

    public function getNomStade(): ?string
    {
        return $this->nom_stade;
    }

    public function setNomStade(string $nom_stade): self
    {
        $this->nom_stade = $nom_stade;

        return $this;
    }

    public function getNbrSpectateur(): ?int
    {
        return $this->nbr_spectateur;
    }

    public function setNbrSpectateur(int $nbr_spectateur): self
    {
        $this->nbr_spectateur = $nbr_spectateur;

        return $this;
    }
}
