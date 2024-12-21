<?php

namespace App\Controller\Backoffice\Cuid\Actions;

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


            class ActionBookingAmountController extends AbstractController {
                private $security;
                private $entityManager;
            
                public function __construct(Security $security,EntityManagerInterface $entityManager ) {
            
                    $this->security = $security;
                    $this->entityManager = $entityManager;
            
                }
            
                #[Route('/booking-amount/{id}', name: 'action_booking_amount')]
                public function index($id,Request $request,SessionInterface $session): Response
                {

                 $booking = $this->entityManager->getRepository(Booking::class)->find($id);



                    return $this->render('amount.html.twig',[

                        'booking'=>$booking,

            
                    ]);
            
                }

                
            }
