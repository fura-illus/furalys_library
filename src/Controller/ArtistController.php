<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Form\ArtistType;
use App\Service\HandleArtist;
use App\Repository\ArtistRepository;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArtistController extends AbstractController
{
    private $artistRepository;
    private $slugger;

    public function __construct(ArtistRepository $artistRepository, SluggerInterface $slugger)
    {
        $this->artistRepository = $artistRepository;
        $this->slugger = $slugger;
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
    public function addArtist(Request $request, HandleArtist $handleArtist): Response
    {
        $artist = new Artist();

        $form = $this->createForm(ArtistType::class, $artist)->handleRequest($request);
        if ($form->isSubmitted()){
            $artist->setSlug($this->slugger->slug($artist->getName())->lower()->toString());
            if ($form->isValid()){
                $handleArtist->addArtist($artist);
                return $this->redirectToRoute('artist_show');
            }
            $form->get('name')->addError(new FormError('This artist has already been registered'));
        }

        return $this->render('artist/addArtist.html.twig', [
            'artistForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/artist/{slug}", name="artist_infos")
     */
    public function artistInfos(Artist $artist): Response
    {
        return $this->render('artist/artistInfos.html.twig', [
            'artist' => $artist,
            'slug' => $artist->getSlug(),
        ]);
    }
}
