<?php
namespace App\Controller;

use App\Entity\Annonce;
use App\Repository\AnnonceRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class AnnonceController extends AbstractController
{
    /**
     * @Route("/", name="annonce-list")
     * @param AnnonceRepository $repository
     * @param PaginatorInterface $paginator
     * @param Request $request
     * @return Response
     */
    public function index(AnnonceRepository $repository, PaginatorInterface $paginator, Request $request)
    {
        $annonceList = $paginator->paginate(
            $repository->getAll(),
            $request->query->getInt('page', 1),
            5
        );
        return $this->render('annonce/index.html.twig', [
            'annonceList' => $annonceList,
        ]);
    }

    /**
     * @route("/{slug}-{id}", name="annonce.show", requirements={"slug"= "[a-z0-9\-]*"})
     * @param Annonce $annonce
     * @return Response
     */

    public function show(Annonce $annonce, string $slug ): Response
    {
        if($annonce->getSlug() !== $slug) {
            return $this->redirectToRoute('annonce.show', [
                'id' => $annonce->getId(),
                'slug' => $annonce->getSlug()
            ], 301);
        }
        return $this->render('annonce/show.html.twig', [
            'annonce' => $annonce,
        ]);

    }
}