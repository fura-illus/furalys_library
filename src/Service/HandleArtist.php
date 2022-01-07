<?php

namespace App\Service;

use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class HandleArtist
{
    private $manager;
    
    public function __construct(SluggerInterface $slugger, EntityManagerInterface $manager, FlashBagInterface $flashBag)
    {
        $this->slugger = $slugger;
        $this->manager = $manager;
        $this->flashBag = $flashBag;
    }

    public function addArtist($artist) 
    {
        $uploadedFile = $artist->getAvatarFile();
        $destination = __DIR__.'/../../public/img/uploads/artists-avatar';

        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $newFilename = $safeFilename.'-'.uniqid().'.'.$uploadedFile->guessExtension();

        $uploadedFile->move(
            $destination,
            $newFilename
        );

        $artist->setAvatar($newFilename);

        $this->manager->persist($artist);
        $this->manager->flush();
        $this->flashBag->add('success', 'The artist has successfully be added');
    }
}