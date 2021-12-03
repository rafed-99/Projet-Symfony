<?php

namespace App\Entity;

class PropertySearch
{

   private $nomtournoi;

   
   public function getNomtournoi(): ?string
   {
       return $this->nomtournoi;
   }

   public function setNomtournoi(string $nomtournoi): self
   {
       $this->nomtournoi = $nomtournoi;

       return $this;
   }
}