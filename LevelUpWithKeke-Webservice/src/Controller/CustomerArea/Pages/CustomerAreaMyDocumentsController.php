<?php

namespace App\Controller\CustomerArea\Pages;

use App\Entity\CMSgraphics;
use App\Entity\CMSmenu;
use App\Entity\CMSsocialmedia;
use App\Entity\CMSWebsite;
use App\Entity\Customer;
use App\Entity\Form;
use App\Entity\NotarizeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Security\Security;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityManagerInterface;


            class CustomerAreaMyDocumentsController extends AbstractController {
                private $security;
                private $entityManager;
            
                public function __construct(Security $security,EntityManagerInterface $entityManager ) {
            
                    $this->security = $security;
                    $this->entityManager = $entityManager;
            
                }
            
                #[Route('/service-en-ligne/choisir-un-document', name: 'cuid_customer_area_my_documents')]
                public function index(Request $request,SessionInterface $session): Response
                {
                   /*  Start All Pages with this CODE */   $this->security->SecurityCheck($session); 
            
                 $part="customer-area";
                 $user=$session->get("user");
                 $userid=$user->getId();
            
                 $customer = $this->entityManager->getRepository(Customer::class)->find($userid);
                 $user=$session->set("user",$customer);
                 $menu= $this->entityManager->getRepository(CMSmenu::class)->findAll();
                 $documents= $this->entityManager->getRepository(Form::class)->findAll();
                 $graphics = $this->entityManager->getRepository(CMSgraphics::class)->find(1);
                 $socialmedia = $this->entityManager->getRepository(CMSsocialmedia::class)->findAll();

                    return $this->render($part.'/pages/chooseYourDocument.html.twig',[
            
                        'part' => $part,
                        'menu' => $menu, 
                        'documents' => $documents,
                        'graphics' => $graphics,
                        'customer' => $customer,
                        "website"=> $this->entityManager->getRepository(CMSWebsite::class)->find(1),
                        'socials' => $socialmedia,
                        'description' => "Choisir ses documents",
                        'title' => "Espace Client"
            
                    ]);
            
                }

                
            }
