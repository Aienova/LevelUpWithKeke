<?php

namespace App\Controller\Form;

use App\Entity\Booking;
use App\Entity\CMSWebsite;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\Mailer\Mailer;
use App\Service\Executer\Executer;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Customer;
use App\Entity\Notarize;
use App\Entity\NotarizeDocument;
use App\Entity\Person;
use DateTimeImmutable;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Service\Form\Payment;
use Stripe\Checkout\Session;


class MakePaymentController extends AbstractController
{


    private EntityManagerInterface $entityManager;
    private  Mailer $mailer;
    private  Executer $executer;

public function __construct(EntityManagerInterface $entityManager, Mailer $mailer, Executer $executer)
{
    $this->entityManager = $entityManager;
    $this->mailer =  $mailer;
    $this->executer =  $executer;
}



    #[Route('/payment/{type}/{id}', name: 'cuid_payment')]
    public function Payment($id,$type)
    {

        $website= $this->entityManager->getRepository(CMSWebsite::class)->find(1);

        if($type=="booking"){

            $entity= $this->entityManager->getRepository(Notarize::class)->find($id);

            $paymentCode=$this->executer->generateRandomString().$id.$entity->getId();
        

            $entity->setPaymentCode($paymentCode);
    
        }

        if($type=="document"){

            $entity= $this->entityManager->getRepository(NotarizeDocument::class)->find($id);

            $paymentCode=$entity->getCode();
        }

        if($type=="notarize"){

            $entity= $this->entityManager->getRepository(Notarize::class)->find($id);

            $paymentCode=$this->executer->generateRandomString().$id.$entity->getId();
        

            $entity->setPaymentCode($paymentCode);
    
        }



      Stripe::setApiKey($this->getParameter('stripe.secret_key'));

  
                        $YOUR_DOMAIN = $website->getLink();

                        if($type=="document"){

                            $ttc = 25 + (25 * ($website->getVat()/100));

                            $price=$ttc;

                        }else{

                            $ttc = $entity->getCost() + ($entity->getCost() * ($website->getVat()/100));

                            $price=$ttc;

                        }
            



                        $paypalurl = "/paiement-paypal/".$type."/".$id;
                        
                $checkout_session = Session::create([
                    'payment_method_types' => ['card'],
                    'line_items' => [[
                      'price_data' => [
                        'currency' => 'eur',
                        'unit_amount' => round($price)*100,
                        'product_data' => [
                          'name' => $website->getCompanyName(),
                          'images' => ["https://upload.wikimedia.org/wikipedia/commons/d/d8/Coat_of_arms_of_the_Republic_of_the_Congo.svg"],
                        ],
                      ],
                      'quantity' => 1,
                    ]],
                    'mode' => 'payment',
                    'success_url' => $YOUR_DOMAIN . 'paiement-valide/'.$type."/".$paymentCode,
                    'cancel_url' => $YOUR_DOMAIN . 'service-en-ligne/suivis-des-demandes',
                  ]);

                
                
                
                $this->entityManager->persist($entity);
                $this->entityManager->flush();

                return $this->render('payment.html.twig', [
                    'stripe_checkout'=>$checkout_session->url,
                    'paypal_checkout'=>$paypalurl
                ]);

        /*
        $form = $this->createForm(Payment::class);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();


            $stripecustomer = $stripe->customers->create([
                    'name' => $entity->getCustomer()->getFirstname()." ".$entity->getCustomer()->getSurname(),
                    'email' => $entity->getCustomer()->getEmail(),
                    ]);




            // Create a payment intent using Stripe API
            $paymentIntent = PaymentIntent::create([
                'amount' => round($entity->getCost())*100, // Amount in cents
                'currency' => 'eur',
                'payment_method_types' => ['card'],
                'description' => "C'est juste un test connard",
                'customer' => $stripecustomer["id"],
            
            ]);


            $stripecard = $stripe->paymentMethods->create([
                'type' => 'card',
                'card' => [
                'number' => $data["cardNumber"],
                'exp_month' => $data["month"],
                'exp_year' => $data["year"],
                'cvc' => $data["cvc"],
                ],
            ]);


            
                $stripe->paymentIntents->confirm(
                    $paymentIntent["id"],
                    [
                    'payment_method' => $stripecard["id"],
                    ]
                );



            return $this->render('paymentSuccess.html.twig', [
                'client_secret' => $paymentIntent->client_secret,
            ]);
        }

        return $this->render('payment.html.twig', [
            'form' => $form->createView(),
            'booking'=>$entity
        ]);


*/

    }


    #[Route('/paiement-valide/{type}/{paymentCode}', name: 'cuid_payment_success')]
    public function paymentSucess($paymentCode,$type)
    {
        $website = $this->entityManager->getRepository(CMSWebsite::class)->find(1);

        if($type=="booking"){

            $entity= $this->entityManager->getRepository(Booking::class)->findByPaymentCode($paymentCode);

        }
        

        if($type=="notarize"){

            $entity= $this->entityManager->getRepository(Notarize::class)->findByPaymentCode($paymentCode);

        }

        if($type=="document"){

            $entity= $this->entityManager->getRepository(NotarizeDocument::class)->findByCode($paymentCode)[0];

        }

        $person = $this->entityManager->getRepository(Person::class)->findByCustomer($entity->getCustomer());

        if($type !="document"){

        $entity->setPaid(TRUE);

        if($entity->getType()->getId() == 7){

            $person->setConsularCard(1);

            $this->entityManager->persist($person);
            $this->entityManager->flush();

        }

        $emailmessage = $this->mailer->GetEmailPayment($entity);
        $emailmessageforadmin = $this->mailer->GetEmailPaymentForAdmin($entity);



    }else{


        $emailmessage=$this->mailer->GetEmailPaymentDocument($entity);
        $emailmessageforadmin = $this->mailer->GetEmailPaymentDocumentForAdmin($entity);

    }    

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        $this->mailer->sendEmail($entity->getCustomer()->getEmail(), 23 , $emailmessage);
        $this->mailer->sendEmail($website->getEmail(), 24, $emailmessageforadmin);
        
        return $this->render('paymentSuccess.html.twig', [
            'bill'=>$entity,
        ]);


    }
}
