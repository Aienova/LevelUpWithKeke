<?php

namespace App\Controller\CustomerArea\Pages;

use App\Entity\CMSgraphics;
use App\Entity\CMSWebsite;
use App\Entity\Customer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Security\Security;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityManagerInterface;


            class CustomerFirstTimeController extends AbstractController {
                private $security;
                private $entityManager;
            
                public function __construct(Security $security,EntityManagerInterface $entityManager ) {
            
                    $this->security = $security;
                    $this->entityManager = $entityManager;
            
                }
            
                #[Route('/bienvenu', name: 'cuid_first_time')]
                public function index(Request $request,SessionInterface $session): Response
                {
                   /*  Start All Pages with this CODE */   $this->security->SecurityCheck($session); 
            
                 $part="customer-area";
                 $user=$session->get("user");
                 $userid=$user->getId();
            
                 $customer = $this->entityManager->getRepository(Customer::class)->find($userid);
                 $graphics = $this->entityManager->getRepository(CMSgraphics::class)->find(1);
                 $user=$session->set("user",$customer);
            
                    return $this->render($part.'/firstTime.html.twig',[
            
                        'part' => $part,
                        'customer' => $customer,
                        'graphics' => $graphics,
                        'customer' => $customer,
                        "website"=> $this->entityManager->getRepository(CMSWebsite::class)->find(1),
                        'title' => "Espace Client"
                        
            
                    ]);
            
                }

                
            }
