<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;



    class CardController extends AbstractController
    {


        private $entityManager;

public function __construct(EntityManagerInterface $entityManager) {

    $this->entityManager = $entityManager;
}

        #[Route('/card', name: 'cuid_card')]

        public function index(): Response
        {
            if(isset($_SESSION["token"])){

                $connected=1;
            }else{

                $connected=0;

            }


           /* $entity = $this->entityManager->getRepository(Candidate::class)->find($id); */

            return $this->render('card.html.twig', [

                'connection' => $connected,
    
            ]);
        }
    }
