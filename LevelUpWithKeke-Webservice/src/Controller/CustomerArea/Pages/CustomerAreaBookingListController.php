<?php

namespace App\Controller\CustomerArea\Pages;

use App\Entity\Booking;
use App\Entity\CMSgraphics;
use App\Entity\CMSmenu;
use App\Entity\CMSsocialmedia;
use App\Entity\CMSWebsite;
use App\Entity\Customer;
use App\Entity\Decision;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Security\Security;
use App\Service\Form\SubmitForm;
use App\Service\Mailer\Mailer;
use DateTimeImmutable;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityManagerInterface;


            class CustomerAreaBookingListController extends AbstractController {
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
            
                #[Route('/service-en-ligne/mes-rendez-vous', name: 'cuid_customer_area_booking_list')]
                public function index(Request $request,SessionInterface $session): Response
                {
                   /*  Start All Pages with this CODE */   $this->security->SecurityCheck($session); 
            
                 $part="customer-area";
                 $user=$session->get("user");
                 $userid=$user->getId();
                 $today = new DateTimeImmutable();
                 $menu= $this->entityManager->getRepository(CMSmenu::class)->findAll();
                 $website= $this->entityManager->getRepository(CMSWebsite::class)->find(1);
                 $customer = $this->entityManager->getRepository(Customer::class)->find($userid);
                 $bookings = $this->entityManager->getRepository(Booking::class)->findByCustomerAndCurrent($customer,$today);
                 $cancelbookings = $this->entityManager->getRepository(Booking::class)->findByCustomerAndCancelled($customer);
                 $paidbookings = $this->entityManager->getRepository(Booking::class)->findByPast($today,$this->entityManager->getRepository(Decision::class)->find(3));
                 $graphics = $this->entityManager->getRepository(CMSgraphics::class)->find(1);
                 $socialmedia = $this->entityManager->getRepository(CMSsocialmedia::class)->findAll();                 

        if(isset($_POST["answer"])){

            $entity = $this->entityManager->getRepository(Booking::class)->find($_POST["booking-id"]);

            if($_POST["answer"]==1 && $_POST["decision"]==1){


                $entity->setConfirmation(TRUE);

                if( $entity->getDecision()->getId() == 4 ){

                    $entity->setDecision($this->entityManager->getRepository(Decision::class)->find(3));


                }else{

                    $entity->setDecision($this->entityManager->getRepository(Decision::class)->find(2));

                }



                $this->entityManager->persist($entity);
                $this->entityManager->flush();

                $formmessage="Votre confirmation pour ce rendez-vous a bien été envoyé, vous recevrez un mail de notification :<br>".$customer->getEmail();

                $emailmessage=$this->mailer->GetEmailBooking($entity);
                $emailmessageforcompany=$this->mailer->GetEmailBookingForCompany($entity);
                
    
                $this->mailer->sendEmail($website->getEmail(), 17 , $emailmessageforcompany);
            }
            
            if($_POST["answer"]==1 && $_POST["decision"]==0){

                $entity->setConfirmation(FALSE);
                $entity->setCancelled(TRUE);
                $entity->setDecision($this->entityManager->getRepository(Decision::class)->find(1));
                $this->entityManager->persist($entity);
                $this->entityManager->flush();

                $formmessage="Votre annulation pour ce rendez-vous a bien été envoyé ";

                $emailmessageforcompany=$this->mailer->GetEmailBookingForCompany($entity);
                

                $this->mailer->sendEmail($website->getEmail(), 16 , $emailmessageforcompany);

            }


        }

            return $this->render($part.'/pages/bookingsList.html.twig',[

                'part' => $part,              
                'title' => "Kundenbereich",
                'description'=>"Ihre Reservierungen",    
                'bookings'=>$bookings,
                "website"=> $this->entityManager->getRepository(CMSWebsite::class)->find(1),
                'graphics' => $graphics,
                'cancelBookings'=>$cancelbookings,
                'paidBookings'=>$paidbookings,
                'menu'=>$menu,
                'customer' => $customer,
                'socials' => $socialmedia
    
            ]);

        
            
                }

                
            }
