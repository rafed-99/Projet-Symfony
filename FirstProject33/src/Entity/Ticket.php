<?php

namespace App\Entity;

use App\Repository\TicketRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TicketRepository::class)
 */
class Ticket
{


    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=20)
     */
    private $num_ticket;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $ref_match;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $num_place;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $disp;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumTicket(): ?string
    {
        return $this->num_ticket;
    }

    public function setNumTicket(string $num_ticket): self
    {
        $this->num_ticket = $num_ticket;

        return $this;
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

    public function getNumPlace(): ?string
    {
        return $this->num_place;
    }

    public function setNumPlace(string $num_place): self
    {
        $this->num_place = $num_place;

        return $this;
    }

    public function getDisp(): ?string
    {
        return $this->disp;
    }

    public function setDisp(string $disp): self
    {
        $this->disp = $disp;

        return $this;
    }
}
