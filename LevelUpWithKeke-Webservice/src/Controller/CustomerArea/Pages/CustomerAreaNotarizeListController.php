<?php

namespace App\Controller\CustomerArea\Pages;

use App\Entity\CMSgraphics;
use App\Entity\Notarize;
use App\Entity\CMSmenu;
use App\Entity\CMSsocialmedia;
use App\Entity\CMSWebsite;
use App\Entity\Customer;
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


            class CustomerAreaNotarizeListController extends AbstractController {
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
            
                #[Route('/service-en-ligne/suivis-des-demandes', name: 'cuid_customer_area_notarize_list')]
                public function index(Request $request,SessionInterface $session): Response
                {
                   /*  Start All Pages with this CODE */   $this->security->SecurityCheck($session); 
            
                 $part="customer-area";
                 $user=$session->get("user");
                 $userid=$user->getId();
                 $menu= $this->entityManager->getRepository(CMSmenu::class)->findAll();
                 $customer = $this->entityManager->getRepository(Customer::class)->find($userid);
                 $notarizes = $this->entityManager->getRepository(Notarize::class)->findByCustomerAndCurrent($customer);
                 $cancelNotarizes = $this->entityManager->getRepository(Notarize::class)->findByCustomerAndCancelled($customer);
                 $paidNotarizes = $this->entityManager->getRepository(Notarize::class)->findByCustomerAndPaid($customer);
                 $website = $this->entityManager->getRepository(CMSWebsite::class)->find(1);
                 $graphics = $this->entityManager->getRepository(CMSgraphics::class)->find(1);
                 $socialmedia = $this->entityManager->getRepository(CMSsocialmedia::class)->findAll();                 


        if(isset($_POST["answer"])){

            $entity = $this->entityManager->getRepository(Notarize::class)->find($_POST["Notarize-id"]);

            if($_POST["answer"]==1 && $_POST["decision"]==1){


                $entity->setConfirmation(TRUE);
                $this->entityManager->persist($entity);
                $this->entityManager->flush();

                $emailmessage=str_replace("%LINK%",""."https://".$_SERVER['SERVER_NAME']."/confirmation  ",$this->mailer->GetEmailConfirmation());

                $this->mailer->sendEmail($customer->getEmail(), "ProClean Reinigung :Ihre Reservierung wurde bestätigt", $emailmessage);

            }
            
            if($_POST["answer"]==1 && $_POST["decision"]==0){

                $entity->setConfirmation(FALSE);
                $entity->setCancelled(TRUE);
                $this->entityManager->persist($entity);
                $this->entityManager->flush();

                $emailmessage=str_replace("%LINK%",""."https://".$_SERVER['SERVER_NAME']."/confirmation  ",$this->mailer->GetEmailConfirmation());

                $this->mailer->sendEmail($customer->getEmail(), "ProClean Reinigung : Ihre Reservierung wurde storniert", $emailmessage);

            }


        }

            return $this->render($part.'/pages/notarizeList.html.twig',[

                'part' => $part,              
                'title' => "Liste des demandes",
                'description'=>"Ihre Reservierungen",    
                'notarizes'=>$notarizes,
                'cancelNotarizes'=>$cancelNotarizes,
                'paidNotarizes'=>$paidNotarizes,
                'website'=>$website,
                'customer' => $customer,
                "website"=> $this->entityManager->getRepository(CMSWebsite::class)->find(1),
                'graphics' => $graphics,
                'socials' => $socialmedia,
                'menu'=>$menu
    
            ]);

        
            
                }


                #[Route('/service-en-ligne/mes-paiements', name: 'cuid_customer_area_notarize_payment_list')]
                public function payments(Request $request,SessionInterface $session): Response
                {
                   /*  Start All Pages with this CODE */   $this->security->SecurityCheck($session); 
            
                 $part="customer-area";
                 $user=$session->get("user");
                 $userid=$user->getId();
                 $menu= $this->entityManager->getRepository(CMSmenu::class)->findAll();
                 $customer = $this->entityManager->getRepository(Customer::class)->find($userid);
                 $notarizes = $this->entityManager->getRepository(Notarize::class)->findByCustomerValidButNotPaid($customer);
                 $cancelNotarizes = $this->entityManager->getRepository(Notarize::class)->findByCustomerAndCancelled($customer);
                 $paidNotarizes = $this->entityManager->getRepository(Notarize::class)->findByCustomerAndPaid($customer);
                 $website = $this->entityManager->getRepository(CMSWebsite::class)->find(1);
                 $graphics = $this->entityManager->getRepository(CMSgraphics::class)->find(1);
                 $socialmedia = $this->entityManager->getRepository(CMSsocialmedia::class)->findAll();                 


        if(isset($_POST["answer"])){

            $entity = $this->entityManager->getRepository(Notarize::class)->find($_POST["Notarize-id"]);

            if($_POST["answer"]==1 && $_POST["decision"]==1){


                $entity->setConfirmation(TRUE);
                $this->entityManager->persist($entity);
                $this->entityManager->flush();

                $emailmessage=str_replace("%LINK%",""."https://".$_SERVER['SERVER_NAME']."/confirmation  ",$this->mailer->GetEmailConfirmation());

                $this->mailer->sendEmail($customer->getEmail(), "ProClean Reinigung :Ihre Reservierung wurde bestätigt", $emailmessage);

            }
            
            if($_POST["answer"]==1 && $_POST["decision"]==0){

                $entity->setConfirmation(FALSE);
                $entity->setCancelled(TRUE);
                $this->entityManager->persist($entity);
                $this->entityManager->flush();

                $emailmessage=str_replace("%LINK%",""."https://".$_SERVER['SERVER_NAME']."/confirmation  ",$this->mailer->GetEmailConfirmation());

                $this->mailer->sendEmail($customer->getEmail(), "ProClean Reinigung : Ihre Reservierung wurde storniert", $emailmessage);

            }


        }

            return $this->render($part.'/pages/notarizePaymentList.html.twig',[

                'part' => $part,              
                'title' => "Liste des demandes",
                'description'=>"Ihre Reservierungen",    
                'notarizes'=>$notarizes,
                'website'=>$website,
                'customer' => $customer,
                "website"=> $this->entityManager->getRepository(CMSWebsite::class)->find(1),
                'graphics' => $graphics,
                'socials' => $socialmedia,
                'menu'=>$menu
    
            ]);

        
            
                }

                
            }
