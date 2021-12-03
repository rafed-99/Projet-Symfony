<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;


use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
{


    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id_reservation;

    /**
     * @ORM\Column(type="integer")
     */
    private $cin_client;


    protected $captchaCode;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\NotEqualTo("00000000")
     */
    private $ref_match;

    /**
     * @ORM\Column(type="string", length=20)

     * @Assert\NotBlank
     */
    private $num_ticket;

    /**
     * @ORM\Column(type="date")

     */
    private $date_reservation;



    public function getIdReservation(): ?int
    {
        return $this->id_reservation;
    }

    public function setIdReservation(int $id_reservation): self
    {
        $this->id_reservation = $id_reservation;

        return $this;
    }

    public function getCinClient(): ?int
    {
        return $this->cin_client;
    }

    public function setCinClient(int $cin_client): self
    {
        $this->cin_client = $cin_client;

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

    public function getNumTicket(): ?string
    {
        return $this->num_ticket;
    }

    public function setNumTicket(string $num_ticket): self
    {
        $this->num_ticket = $num_ticket;

        return $this;
    }

    public function getDateReservation(): ?\DateTimeInterface
    {
        return $this->date_reservation;
    }

    public function setDateReservation(\DateTimeInterface $date_reservation): self
    {
        $this->date_reservation = $date_reservation;

        return $this;
    }

    public function getCaptchaCode()
    {
        return $this->captchaCode;
    }

    public function setCaptchaCode($captchaCode)
    {
        $this->captchaCode = $captchaCode;
    }

}
