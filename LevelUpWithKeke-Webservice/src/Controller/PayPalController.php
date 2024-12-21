<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Entity\CMSWebsite;
use App\Entity\Notarize;
use App\Entity\NotarizeDocument;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Doctrine\ORM\EntityManagerInterface;

class PayPalController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager ) {


        $this->entityManager = $entityManager;

    }

    #[Route('/paiement-paypal/{type}/{id}', name: 'cuid_paypal')]
    public function index($type,$id): Response
    {


        $website= $this->entityManager->getRepository(CMSWebsite::class)->find(1);


        if($type == "notarize"){

            $entity = $this->entityManager->getRepository(Notarize::class)->find($id);

        }
        
        if($type == "booking"){

            $entity = $this->entityManager->getRepository(Booking::class)->find($id);

        }

        if($type == "document"){

            $entity = $this->entityManager->getRepository(NotarizeDocument::class)->find($id);

        }


        /*

                // PayPal SDK configuration
                $apiContext = new \PayPal\Rest\ApiContext(
                    new \PayPal\Auth\OAuthTokenCredential(
                        '',     // Replace with your PayPal client ID
                        'EJem48krv1yz8cWIM-zNDtrVm5320teo_gLZD3RPzcHBQxai1QIl7ZKZQ87Fb-SRwfcwjwF5ZQom4GwO'  // Replace with your PayPal client secret
                    )
                );


                  // Create payment
        $payment = new Payment();
        $payment->setIntent('sale');

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $payment->setPayer($payer);

        $amount = new Amount();
        $amount->setTotal('10.00');  // Replace with your product total amount
        $amount->setCurrency('USD'); // Replace with your product currency

        $transaction = new Transaction();
        $transaction->setAmount($amount);
        $payment->addTransaction($transaction);

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($this->generateUrl('payment_success', [], UrlGeneratorInterface::ABSOLUTE_URL));
        $redirectUrls->setCancelUrl($this->generateUrl('payment_cancel', [], UrlGeneratorInterface::ABSOLUTE_URL));
        $payment->setRedirectUrls($redirectUrls);

        // Create payment on PayPal
        $payment->create($apiContext);

        // Get PayPal redirect URL and redirect the user
        $approvalUrl = $payment->getApprovalLink();
        return $this->redirect($approvalUrl); */

        if($type != "document"){

        if($entity->isPaid()==TRUE){

            $template='pay_pal/success.html.twig';
        }else{

            $template='pay_pal/index.html.twig';
        }

        $ttc = $entity->getCost() + ($entity->getCost() * ($website->getVat()/100));

        $price=$ttc;

    }else{

        $template='pay_pal/index.html.twig';

        $price = 25;
    }




        
        return $this->render($template, [
            'bill' => $entity,
            'price' => $price,
            'type' => $type,
            'controller_name' => 'PayPalController',
        ]);
    }
}
