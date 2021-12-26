<?php

namespace App\Service;

class AddArtist
{
    public function addArtist($artist) 
    {
        $this->manager->persist($artist);
        $this->manager->flush();
    }
}