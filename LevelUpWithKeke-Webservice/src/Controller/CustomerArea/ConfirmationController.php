<?php

namespace App\Controller\CustomerArea;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Customer;


class ConfirmationController extends AbstractController
{


    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {

        $this->entityManager = $entityManager;
    }

    #[Route('/confirmation/{usertype}/{activationCode}', name: 'cuid_confirm')]
    public function index($usertype,$activationCode): Response
    {   

        
        
        $class=Customer::class;


        $entity = $this->entityManager->getRepository($class)->findByActivationCode($activationCode);

        $entity->setState(0);

        $entity->setSignedUp(1);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $this->render('confirmation.html.twig');
    }
}
