<?php

namespace App\Controller\CustomerArea\Actions;

use App\Entity\Customer;
use App\Entity\Booking;
use App\Entity\CMSWebsite;
use App\Entity\Notarize;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Security\Security;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityManagerInterface;


            class ActionPrintNotarizeController extends AbstractController {
                private $security;
                private $entityManager;
            
                public function __construct(Security $security,EntityManagerInterface $entityManager ) {
            
                    $this->security = $security;
                    $this->entityManager = $entityManager;
            
                }
            
                #[Route('/notarize-preview/{type}/{id}', name: 'action_print_notarize_preview')]
                public function preview($id,$type,Request $request,SessionInterface $session): Response
                {


                    $printable="/print-notarize/".$type."/".$id;

                

                    return $this->render('/printable/preview.html.twig',[

                        'printable'=>$printable,
            
                    ]);
            
                }


                #[Route('/print-notarize/{type}/{id}', name: 'action_print_notarize')]
                public function print($type,$id): Response
                {

                $notarize = $this->entityManager->getRepository(Notarize::class)->find($id); 
                $website = $this->entityManager->getRepository(CMSWebsite::class)->find(1); 


                    return $this->render('/printable/notarize.html.twig',[

                        'notarize'=>$notarize,
                        'contractType'=>$type,
                        'website'=>$website
            
                    ]);
            
                }


                
            }
