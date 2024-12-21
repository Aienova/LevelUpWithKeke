<?php

namespace App\Controller\Backoffice\Cuid;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


            class CuidOblivionController extends AbstractController {


                #[Route('/cuid/mot-de-passe-oublie', name: 'cuid_admin_oblivion')]
                public function index(): Response
                {
                    return $this->render('backoffice/cuid/oblivion.html.twig');
                }

                
            }
