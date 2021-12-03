<?php

namespace App\Entity;
class PropertySearch{
    private $ref_match;


    public function getRefMatch(): ?string
    {
        return $this->ref_match;
    }
    public function setRefMatch(string $ref_match): self
    {
        $this->ref_match = $ref_match;

        return $this;
    }


}