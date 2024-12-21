<?php

namespace App\Controller\Panel;

use App\Entity\Messaging;
use App\Entity\Conversation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use DateTimeImmutable;


    class MessagingController extends AbstractController
    {


        private $entityManager;

public function __construct(EntityManagerInterface $entityManager) {

    $this->entityManager = $entityManager;
}

        #[Route('/messaging/{id}', name: 'cuid_messaging')]

        public function index($id): Response
        {

            $messages = $this->entityManager->getRepository(Messaging::class)->findByConversationId($id);
            if($messages!=NULL){
            $messagescount=sizeof($messages);
            }else{
                $messagescount=0;
            }
           

            
        if(isset($_POST["textmessage"])){

            $today = new DateTimeImmutable();

                        $messaging = new Messaging();
                        $messaging->setConversationId($id);
                        $messaging->setSenderId($_POST["senderid"]);
                        $messaging->setSenderType($_POST["sendertype"]);

                        if($_POST["sendertype"]==0){

                            $readc = TRUE;
                            $readr = FALSE;

                        }else{

                            $readc = FALSE;
                            $readr = TRUE;

                        }

                        $messaging->setSendingDate($today);
                        $messaging->setReadByCandidate($readc);
                        $messaging->setReadByRecruiter($readr);
                        $messaging->setMessageText($_POST["textmessage"]);

                    // Persist the entity
                    $this->entityManager->persist($messaging);
                    $this->entityManager->flush();

                    return $this->redirectToRoute('cuid_messaging', ['id' => $id]);

        }


            return $this->render('panel/messaging.html.twig', [


                'messages' => $messages,
                'messagescount'=> $messagescount,
                'conversationId' => $id
    
            ]);
        }
    }
