<?php

namespace App\Entity;

class PSearch
{

   private $nomequipe;

   
   public function getNomequipe(): ?string
   {
       return $this->nomequipe;
   }

   public function setNomequipe(string $nomequipe): self
   {
       $this->nomequipe = $nomequipe;

       return $this;
   }
}