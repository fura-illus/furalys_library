<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Form\ArtistType;
use App\Service\AddArtist;
use App\Repository\ArtistRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArtistController extends AbstractController
{
    private $artistRepository;

    public function __construct(ArtistRepository $artistRepository)
    {
        $this->artistRepository = $artistRepository;
    }

    /**
     * @Route("/artist", name="artist_show")
     */
    public function showArtist(): Response
    {
        return $this->render('artist/showArtist.html.twig', [
            'artists' => $this->artistRepository->findAll()
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

    /**
     * @Route("/artist/{name}", name="artist_infos")
     */
    public function artistInfos(Artist $artist): Response
    {
        return $this->render('artist/artistInfos.html.twig', [
            'artist' => $artist,
        ]);
    }
}
