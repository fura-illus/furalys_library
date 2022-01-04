<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

class HandleArtist
{
    private $manager;
    
    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function addArtist($artist) 
    {
        $this->manager->persist($artist);
        $this->manager->flush();
    }
}