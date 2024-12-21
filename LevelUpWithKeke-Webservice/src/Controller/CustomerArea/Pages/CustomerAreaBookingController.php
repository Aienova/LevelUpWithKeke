<?php

namespace App\Controller\CustomerArea\Pages;

use App\Entity\Booking;
use App\Entity\CMSgraphics;
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


            class CustomerAreaBookingController extends AbstractController {
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
            
                #[Route('/service-en-ligne/rendez-vous', name: 'cuid_customer_area_new_booking')]
                public function index(Request $request,SessionInterface $session): Response
                {
                   /*  Start All Pages with this CODE    $this->security->SecurityCheck($session); */
            
                 $part="customer-area";
                 $user=$session->get("user");
                 if($user==NULL){
                    $userid=1;

                 }else{

                    $userid=$user->getId();
                 }

                 $menu= $this->entityManager->getRepository(CMSmenu::class)->findAll();
                 $customer = $this->entityManager->getRepository(Customer::class)->find($userid);
                 $website = $this->entityManager->getRepository(CMSWebsite::class)->find(1);
                 $graphics = $this->entityManager->getRepository(CMSgraphics::class)->find(1);
                 $socialmedia = $this->entityManager->getRepository(CMSsocialmedia::class)->findAll();
                          
       
       
                 if(isset($_POST["booking"])){


            $newbooking = $this->submitform->createBookingForCustomer($_POST,$customer);

            if($customer->getId() != 1){

                $email = $customer->getEmail();

            }else{

                $email = $_POST["email"];

            }

            $formmessage="Votre rendez-vous a bien été enregistrée, vous recevrez sa confirmation par email :<br>".$email;

            $emailmessage=$this->mailer->GetEmailBooking($newbooking,$email,$newbooking->getVisitor());
            $emailmessageforcompany=$this->mailer->GetEmailBookingForCompany($newbooking,$email,$newbooking->getVisitor());


            

            $this->mailer->sendEmail($email, 3 , $emailmessage);
            $this->mailer->sendEmail($website->getEmail(), 4 , $emailmessageforcompany);

            return $this->render('popup.html.twig',['formmessage' => $formmessage]);


        }else{

            return $this->render($part.'/pages/booking.html.twig',[

                'part' => $part,
                'graphics' => $graphics,
                'docname' => $request->query->get('docname'),
                'reference' => $request->query->get('reference'),
                'customername' => $request->query->get('customer'),
                'description'=>"Ihre Reservierungen",             
                'title' => "Kundenbereich",
                'menu'=>$menu,
                "website"=> $this->entityManager->getRepository(CMSWebsite::class)->find(1),
                'customer' => $customer,
                'socials'=>$socialmedia

    
            ]);

        }
            
                }

                
            }
