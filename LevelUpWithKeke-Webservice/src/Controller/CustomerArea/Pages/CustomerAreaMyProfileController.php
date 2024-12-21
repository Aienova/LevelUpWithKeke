<?php

namespace App\Controller\CustomerArea\Pages;

use App\Entity\Booking;
use App\Entity\CMSgraphics;
use App\Entity\CMSmenu;
use App\Entity\CMSsocialmedia;
use App\Entity\CMSWebsite;
use App\Entity\Customer;
use App\Entity\Faq;
use App\Entity\NotarizeDocument;
use App\Entity\Visa;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Security\Security;
use App\Service\Form\SubmitForm;
use App\Service\Mailer\Mailer;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityManagerInterface;


            class CustomerAreaMyProfileController extends AbstractController {
                private $security;
                private $entityManager;
                private $submitform;
                private $mailer;
            
                public function __construct(Security $security,EntityManagerInterface $entityManager,SubmitForm $submitform, Mailer $mailer ) {
            
                    $this->security = $security;
                    $this->entityManager = $entityManager;
                    $this->submitform = $submitform;
                    $this->mailer = $mailer;
            
                }
            
                #[Route('/service-en-ligne/mon-profil', name: 'cuid_customer_area_my_profile')]
                public function index(Request $request,SessionInterface $session): Response
                {
                   /*  Start All Pages with this CODE */   $this->security->SecurityCheck($session); 
            
                 $part="customer-area";
                 $user=$session->get("user");
                 $userid=$user->getId();
                 $menu= $this->entityManager->getRepository(CMSmenu::class)->findAll();
                 $customer = $this->entityManager->getRepository(Customer::class)->find($userid);
                 $website = $this->entityManager->getRepository(CMSWebsite::class)->find(1);
                 $graphics = $this->entityManager->getRepository(CMSgraphics::class)->find(1);
                 $socialmedia = $this->entityManager->getRepository(CMSsocialmedia::class)->findAll();                            
       


            return $this->render($part.'/pages/myProfile.html.twig',[

                'part' => $part,
                'graphics' => $graphics,
                'description'=>"Modifier votre profile ",             
                'title' => "AmbaConnect : Service en ligne",
                'menu'=>$menu,
                "website"=> $this->entityManager->getRepository(CMSWebsite::class)->find(1),
                'customer' => $customer,
                'socials'=>$socialmedia

    
            ]);

        
            
                }


                #[Route('/service-en-ligne/faq', name: 'cuid_customer_area_faq')]
                public function faq(Request $request,SessionInterface $session): Response
                {
                   /*  Start All Pages with this CODE */   $this->security->SecurityCheck($session); 
            
                 $part="customer-area";
                 $user=$session->get("user");
                 $userid=$user->getId();
                 $menu= $this->entityManager->getRepository(CMSmenu::class)->findAll();
                 $faqs= $this->entityManager->getRepository(Faq::class)->findAll();
                 $customer = $this->entityManager->getRepository(Customer::class)->find($userid);
                 $website = $this->entityManager->getRepository(CMSWebsite::class)->find(1);
                 $graphics = $this->entityManager->getRepository(CMSgraphics::class)->find(1);
                 $socialmedia = $this->entityManager->getRepository(CMSsocialmedia::class)->findAll();                            
       


            return $this->render($part.'/pages/faq.html.twig',[

                'part' => $part,
                'faqs' => $faqs,
                'graphics' => $graphics,
                'description'=>"Modifier votre profile ",             
                'title' => "AmbaConnect : Service en ligne",
                'menu'=>$menu,
                "website"=> $this->entityManager->getRepository(CMSWebsite::class)->find(1),
                'customer' => $customer,
                'socials'=>$socialmedia

    
            ]);

        
            
                }


                

                #[Route('/service-en-ligne/mes-documents', name: 'cuid_customer_area_my_documents')]
                public function myDocuments(Request $request,SessionInterface $session): Response
                {
                   /*  Start All Pages with this CODE */   $this->security->SecurityCheck($session); 
            
                 $part="customer-area";
                 $user=$session->get("user");
                 $userid=$user->getId();
                 $menu= $this->entityManager->getRepository(CMSmenu::class)->findAll();
                 $faqs= $this->entityManager->getRepository(Faq::class)->findAll();
                 $customer = $this->entityManager->getRepository(Customer::class)->find($userid);
                 $website = $this->entityManager->getRepository(CMSWebsite::class)->find(1);
                 $graphics = $this->entityManager->getRepository(CMSgraphics::class)->find(1);
                 $socialmedia = $this->entityManager->getRepository(CMSsocialmedia::class)->findAll();                            
                 $documents = $this->entityManager->getRepository(NotarizeDocument::class)->findByCustomer($customer);    
                 $visas = $this->entityManager->getRepository(Visa::class)->findByCustomer($customer);                 

            return $this->render($part.'/pages/myDocuments.html.twig',[

                'part' => $part,
                'faqs' => $faqs,
                'visas' => $visas,
                'graphics' => $graphics,
                'documents' => $documents,
                'description'=>"Modifier votre profile ",             
                'title' => "AmbaConnect : Service en ligne",
                'menu'=>$menu,
                "website"=> $this->entityManager->getRepository(CMSWebsite::class)->find(1),
                'customer' => $customer,
                'socials'=>$socialmedia
    
            ]);

        
            
                }
                
            }
