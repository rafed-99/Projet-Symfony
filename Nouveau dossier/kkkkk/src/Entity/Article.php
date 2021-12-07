<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * /**
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your ref article must be at least {{ limit }} characters long",
     *      maxMessage = "Your ref article cannot be longer than {{ limit }} characters"
     * )
     * @Assert\NotBlank
     */


    private $refarticle;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Your nom article must be at least {{ limit }} characters long",
     *      maxMessage = "Your nom article cannot be longer than {{ limit }} characters"
     * )
     * @Assert\NotBlank
     */
    private $nomarticle;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(
     *      min = 1,
     *      max = 3,
     *      minMessage = "Your taille must be at least {{ limit }} characters long",
     *      maxMessage = "Your taille cannot be longer than {{ limit }} characters"
     * )
     * @Assert\NotBlank
     */
    private $taille;

    /**
     * @ORM\Column(type="float")
     * @Assert\NotBlank
     * @Assert\NotEqualTo(000,000)
     */
    private $prix;

    /**
     * @ORM\ManyToOne(targetEntity=Magasin::class, inversedBy="articles")
     *
     */
    private $magasin;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRefarticle(): ?string
    {
        return $this->refarticle;
    }

    public function setRefarticle(string $refarticle): self
    {
        $this->refarticle = $refarticle;

        return $this;
    }

    public function getNomarticle(): ?string
    {
        return $this->nomarticle;
    }

    public function setNomarticle(string $nomarticle): self
    {
        $this->nomarticle = $nomarticle;

        return $this;
    }

    public function getTaille(): ?string
    {
        return $this->taille;
    }

    public function setTaille(string $taille): self
    {
        $this->taille = $taille;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getMagasin(): ?Magasin
    {
        return $this->magasin;
    }

    public function setMagasin(?Magasin $magasin): self
    {
        $this->magasin = $magasin;

        return $this;
    }
}
