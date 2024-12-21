<?php

namespace App\Controller\Website\Pages;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Security\Security;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class CandidatesController extends AbstractController
{

    private $security;

    public function __construct(Security $security ) {

        $this->security = $security;

    }


    #[Route('/candidats', name: 'cuid_candidates')]
    public function index(Request $request): Response
    {
          /* Start All Pages with this CODE   $this->security->SecurityCheck($session); */
     $part="website";
     $jobtitle="";
     $city="";

     $session = $request->getSession();
     $postData = $session->get('postData');

     if($postData!=NULL){

        $jobtitle=$postData["jobTitle"];
        $city=$postData["location"];

     }

        return $this->render($part.'/pages/candidates.html.twig',[

            'part' => $part,
            'city' => $city,
            'jobTitle' => $jobtitle,
            'title' => "Nos candidats"

        ]);

    }
}
