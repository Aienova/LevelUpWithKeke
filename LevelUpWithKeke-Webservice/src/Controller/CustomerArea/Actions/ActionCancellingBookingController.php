<?php

namespace App\Controller\CustomerArea\Actions;

use App\Entity\Customer;
use App\Entity\Booking;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Security\Security;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityManagerInterface;


            class ActionCancellingBookingController extends AbstractController {
                private $security;
                private $entityManager;
            
                public function __construct(Security $security,EntityManagerInterface $entityManager ) {
            
                    $this->security = $security;
                    $this->entityManager = $entityManager;
            
                }
            
                #[Route('/decision/{decision}/{bookingid}', name: 'action_decision')]
                public function index($decision,$bookingid,Request $request,SessionInterface $session): Response
                {

                 $booking = $this->entityManager->getRepository(Booking::class)->find($bookingid);


                if($decision == 1){

                    $formmessage="<h3>Vous souhaitez confirmer votre présence pour à ce rendez-vous ? :".$booking->getCode()." ?<h3>";

                }else{


                    $formmessage="<h3>Souhaitez-vous annuler votre participation à ce rendez-vous ? :".$booking->getCode()." ?<h3>";

                }

                    return $this->render('yes-or-no.html.twig',[

                        'formmessage'=>$formmessage,
                        'booking'=>$booking,
                        'decision'=>$decision
            
                    ]);
            
                }

                
            }
