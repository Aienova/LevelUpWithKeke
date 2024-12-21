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


            class ActionPrintBookingController extends AbstractController {
                private $security;
                private $entityManager;
            
                public function __construct(Security $security,EntityManagerInterface $entityManager ) {
            
                    $this->security = $security;
                    $this->entityManager = $entityManager;
            
                }
            
                #[Route('/booking-preview/{type}/{id}', name: 'action_print_booking_preview')]
                public function preview($id,$type,Request $request,SessionInterface $session): Response
                {


                    $bookingPrintable="/print-booking/".$type."/".$id;

                

                    return $this->render('/printable/preview.html.twig',[

                        'bookingPrintable'=>$bookingPrintable,
            
                    ]);
            
                }


                #[Route('/print-booking/{type}/{id}', name: 'action_print_booking')]
                public function print($type,$id): Response
                {

                $booking = $this->entityManager->getRepository(Booking::class)->find($id); 


                    return $this->render('/printable/booking.html.twig',[

                        'booking'=>$booking,
                        'contractType'=>$type
            
                    ]);
            
                }


                
            }
