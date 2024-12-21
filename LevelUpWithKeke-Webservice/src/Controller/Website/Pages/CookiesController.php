<?php

namespace App\Controller\Website\Pages;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Security\Security;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class CookiesController extends AbstractController
{

    private $security;

    public function __construct(Security $security ) {

        $this->security = $security;

    }


    #[Route('/cookies', name: 'cuid_cookies')]
    public function index(Request $request,SessionInterface $session): Response
    {
          /* Start All Pages with this CODE   $this->security->SecurityCheck($session); */
     $part="website";



        return $this->render($part.'/pages/cookies.html.twig',[

            'part' => $part,
            'title' => "Cookies"

        ]);

    }
}
