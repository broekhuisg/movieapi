<?php

namespace App\Controller;

use App\Entity\Media;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PersonController extends AbstractController
{
    #[Route('/person', name: 'person')]
    public function index(): Response
    {
        $show = $this->getDoctrine()->getRepository(Media::class)->findPersonsByMediaId(1);
        dump($show);

        return $this->render('person/index.html.twig', [
            'controller_name' => 'PersonController',
        ]);
    }
}
