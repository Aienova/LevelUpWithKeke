<?php
        namespace App\Controller\Panel;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;



class SettingsController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
    
        $this->entityManager = $entityManager;
    }


    #[Route('/settings/{id}', name: 'cuid_settings')]
    public function index($id): Response
    {

        //Example (Remove this next time)

        $type=0;

      /*  $notification = $this->entityManager->getRepository(Notification::class)->findByUserNoSeen($id,$type);
        $notficationcount=sizeof($notification); */

        return $this->render('panel/settings.html.twig');
    
    
    }
}

       