<?php
        namespace App\Controller\Panel;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Notification;
use Doctrine\ORM\EntityManagerInterface;



class NotificationController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
    
        $this->entityManager = $entityManager;
    }


    #[Route('/notification/{id}', name: 'cuid_notification')]
    public function index($id): Response
    {

        //Example (Remove this next time)

        $type=0;

        $notification = $this->entityManager->getRepository(Notification::class)->findByUserNoSeen($id,$type);
        $notficationcount=sizeof($notification);

        return $this->render('panel/notification.html.twig', [

            'notification' => $notification,
            'notificationcount' => $notficationcount,

        ]);
    }
}

        
    