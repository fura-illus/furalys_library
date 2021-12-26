<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Form\ArtistType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\AddArtist;

class ArtistController extends AbstractController
{
    /**
     * @Route("/artist", name="artist_show")
     */
    public function showArtist(Request $request): Response
    {
        return $this->render('artist/showArtist.html.twig', [
        ]);
    }

    /**
     * @Route("/artist/new", name="artist_add")
     */
    public function addArtist(Request $request, AddArtist $illustrator): Response
    {
        $artist = new Artist();
        $form = $this->createForm(ArtistType::class, $artist)->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $illustrator->addArtist($artist);
            return $this->redirectToRoute('artist_show');
        }

        return $this->render('artist/addArtist.html.twig', [
            'artistForm' => $form->createView(),
        ]);
    }
}
