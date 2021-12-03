<?php

namespace App\Entity;

use App\Repository\TournoiRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TournoiRepository::class)
 */
class Tournoi
{


    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @Assert\NotEqualTo("00000000")
     * @Assert\Length(
     *      min = 2,
     *      max = 8,
     *      minMessage = "Your id must be at least {{ limit }} characters long",
     *      maxMessage = "Your id cannot be longer than {{ limit }} characters"
     * )
     * @Assert\NotBlank
     */
    private $idtournoi;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\Length(
     *      min = 2,
     *      max = 30,
     *      minMessage = "Name tournoi must be at least {{ limit }} characters long",
     *      maxMessage = "Name tournoi cannot be longer than {{ limit }} characters"
     * )
     * @Assert\NotBlank
     */
    private $nomtournoi;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank
     * @Assert\Positive
     * @Assert\GreaterThan(1)
     * @Assert\Length(
     *      max = 2,
     *      maxMessage = "Nombre equipes cannot be longer than {{ limit }} characters"
     * )
     */
    private $nbrequipes;

    /**
     * @ORM\Column(type="date")
     */
    private $datedebuttournoi;

    /**
     * @ORM\Column(type="date")
     */
    private $datefintournoi;

    /**
     * @ORM\Column(type="time")
     */
    private $heurematchtournoi;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Positive
     * @Assert\NotBlank
     * @Assert\Length(
     *      max = 2,
     *      maxMessage = "Nombre poules cannot be longer than {{ limit }} characters"
     * )
     */
    private $nbrpoules;

    public function getIdtournoi(): ?int
    {
        return $this->idtournoi;
    }

    public function setIdtournoi(int $idtournoi): self
    {
        $this->idtournoi = $idtournoi;

        return $this;
    }

    public function getNomtournoi(): ?string
    {
        return $this->nomtournoi;
    }

    public function setNomtournoi(string $nomtournoi): self
    {
        $this->nomtournoi = $nomtournoi;

        return $this;
    }

    public function getNbrequipes(): ?int
    {
        return $this->nbrequipes;
    }

    public function setNbrequipes(int $nbrequipes): self
    {
        $this->nbrequipes = $nbrequipes;

        return $this;
    }

    public function getDatedebuttournoi(): ?\DateTimeInterface
    {
        return $this->datedebuttournoi;
    }

    public function setDatedebuttournoi(\DateTimeInterface $datedebuttournoi): self
    {
        $this->datedebuttournoi = $datedebuttournoi;

        return $this;
    }

    public function getDatefintournoi(): ?\DateTimeInterface
    {
        return $this->datefintournoi;
    }

    public function setDatefintournoi(\DateTimeInterface $datefintournoi): self
    {
        $this->datefintournoi = $datefintournoi;

        return $this;
    }

    public function getHeurematchtournoi(): ?\DateTimeInterface
    {
        return $this->heurematchtournoi;
    }

    public function setHeurematchtournoi(\DateTimeInterface $heurematchtournoi): self
    {
        $this->heurematchtournoi = $heurematchtournoi;

        return $this;
    }

    public function getNbrpoules(): ?int
    {
        return $this->nbrpoules;
    }

    public function setNbrpoules(int $nbrpoules): self
    {
        $this->nbrpoules = $nbrpoules;

        return $this;
    }
}
