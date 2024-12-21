<?php

namespace App\Controller\CustomerArea\Actions;

use App\Entity\Customer;
use App\Entity\Notarize;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Security\Security;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityManagerInterface;


            class ActionNotarizeInfosController extends AbstractController {
                private $security;
                private $entityManager;
            
                public function __construct(Security $security,EntityManagerInterface $entityManager ) {
            
                    $this->security = $security;
                    $this->entityManager = $entityManager;
            
                }
            
                #[Route('/notarize/{id}', name: 'action_notarize')]
                public function index($id,Request $request,SessionInterface $session): Response
                {

                 $notarize = $this->entityManager->getRepository(Notarize::class)->find($id);




                    return $this->render('notarize.html.twig',[

                        'notarize'=>$notarize,

            
                    ]);
            
                }

                
            }
