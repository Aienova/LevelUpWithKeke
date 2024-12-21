<?php

// src/Service/MailerService.php

namespace App\Service\Mailer;

use App\Entity\CMSmail;
use App\Repository\CMSmailRepository;
use App\Repository\CMSWebsiteRepository;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class Mailer
{
    private $mailer;
    private $mailrepo;
    private $website;

    public function __construct(MailerInterface $mailer, CMSmailRepository $mailrepo, CMSWebsiteRepository $website )
    {
        $this->mailer = $mailer;
        $this->mailrepo = $mailrepo;
        $this->website = $website;
    }

    public function sendEmail($recipient, $mailid, $extrabody): void
    {


        $mail = $this->mailrepo->find($mailid);
        $website = $this->website->find(1);
        $mainopen="<div style='width:700px;margin:auto;'>";
        $space="<div style='width:100%px;height:77px;'></div>";
        $mainclose="</div>";
        $subject = $mail->getTitle();
        $body = $mainopen.$mail->getHeader().$space.$mail->getBody().$extrabody.$space.$mail->getFooter().$mainclose;


        $email = (new Email())
            ->from("noreplyambacongoberlin@gmail.com")
            ->to($recipient)
            ->subject($subject)
            ->html($body);

        $this->mailer->send($email);
    }


    public function sendEmailContact($recipient,$subject, $extrabody): void
    {

        $mail = $this->mailrepo->find(20);
        $website = $this->website->find(1);
        $mainopen="<div style='width:700px;margin:auto;'>";
        $space="<div style='width:100%px;height:77px;'></div>";
        $mainclose="</div>";


        $body = $mainopen.$mail->getHeader().$space.$mail->getBody(). $this->GetEmailContactInfos($recipient,$subject,$extrabody).$space.$mail->getFooter().$mainclose;

        $email = (new Email())
            ->from("noreplyambacongoberlin@gmail.com")
            ->to($website->getEmail())
            ->subject("Amba Rép.Congo - Berlin : ".$subject)
            ->html($body);

            $email2 = (new Email())
            ->from("noreplyambacongoberlin@gmail.com")
            ->to("eudes.konda@aienova.com")
            ->subject("Amba Rép.Congo - Berlin : ".$subject)
            ->html($body);

        $this->mailer->send($email);
        $this->mailer->send($email2);
    }

    public function GetEmailBookingNotification(): string
    {
        return file_get_contents("./build/mails/new-booking.html");
    }


    public function GetEmailConfirmation(): string
    {
        return file_get_contents("./build/mails/confirm.html");
    }

    

    public function GetEmailContactInfos($email,$subject,$message): string
    {
        $website = $this->website->find(1);
        
        $infos ="

        <h2> Informations du message : </h2>
    
        <p><strong>Email :</strong>".$email."</p>
        <p><strong>Email :</strong>".$subject."</p>
        <p><strong>Message :</strong><br>".$message."</p>

        <h3>Pour plus d'information connectez-vous sur votre espace CUID : <a href='".$website->getLink()."cuid/dashboard/home'>cliquez-ici </a> </h3>
        
        ";

        return $infos;
    }

    public function GetEmailCustomerInfos($entity): string
    {
        $website = $this->website->find(1);
        
        $message ="

        <h2> Informations du client : </h2>
        
        <p><strong>Nom :</strong> :".$entity->getSurname()."</p>
        <p><strong>Prénom :</strong>".$entity->getFirstname()."</p>
        <p><strong>Email :</strong>".$entity->getEmail()."</p>
        <p><strong>Numéro de téléphone :</strong>".$entity->getTelephone()."</p>

        <h3>Pour plus d'information connectez-vous sur votre espace CUID : <a href='".$website->getLink()."cuid/dashboard/home'>cliquez-ici </a> </h3>
        
        
        ";

        return $message;
    }


    public function GetEmailBooking($entity,$email,$visitor): string
    {
        $website = $this->website->find(1);

        $performancelist = "";

        $performances = $entity->getPerformances();

        foreach($performances as $performance){

            $performancelist .= "<li>".$performance->getName()."</li>";
        }
        
        $message ="

        <h2> Informations de la réservation : </h2>

        <p><strong>Code de réservation :</strong> :".$entity->getCode()."</p>
        <p><strong>Client :</strong> :".$visitor."</p>
        <p><strong>Email du client :</strong>".$email."</p>
        <p><strong>Numéro de téléphone du client :</strong>".$entity->getCustomer()->getTelephone()."</p>
        <p><strong>Adresse :</strong>".$entity->getCustomer()->getMainlocation()."</p>
        <p><strong>Date et heure :</strong>".date("d/m/Y h:i:s ",$entity->getBookingDate()->getTimestamp())."</p>

        <h3>Prestation(s) demandée(s) :</h3>

            <ul>
            ".$performancelist."

            </ul>




        <h3>Pour plus d'informations visitez notre site web : <a href='".$website->getLink()."service-en-ligne'>Glowydent </a> </h3>
        
        ";

        return $message;
    }


    
    public function GetEmailPayment($entity): string
    {
        $website = $this->website->find(1);
        
        $message ="

        <h2> Informations de la demande : </h2>

        <p><strong>Code de la demande :</strong> :".$entity->getNumberId()."</p>
        <p><strong>Type de la demande :</strong> :".$entity->getType()->getFRname()."</p>
        <p><strong>Nom :</strong> :".$entity->getCustomer()->getFirstname()."</p>
        <p><strong>Prénom :</strong>".$entity->getCustomer()->getSurname()."</p>
        <p><strong>Email du client :</strong>".$entity->getCustomer()->getEmail()."</p>
        <p><strong>Numéro de téléphone du client :</strong>".$entity->getCustomer()->getTelephone()."</p>
        <p><strong>Date d'envoi :</strong>".date("d/m/Y h:i:s ",$entity->getDateCreation()->getTimestamp())."</p>


        <p><strong>Prix payé :</strong><br><br>".$entity->getCost()." €</p>

        <h3 style='color:red'>Note importante : Pour les demandes de Visa ou de carte de consulaire , veuillez prendre rendez-vous à l'ambassade pour le retirer. Pour tout autres documents (si vous disposez de la carte consulaire) vous pouvez prendre rendez-vous ou demandez un envoi via DHL : <a href='".$website->getLink()."service-en-ligne/rendez-vous'>cliquez-ici</a></h3>

        <h3>Pour plus d'informations connectez-vous à votre espace dédié : <a href='".$website->getLink()."service-en-ligne'>cliquez-ici </a> </h3>
        
        ";

        return $message;
    }


    

    public function GetEmailPaymentDocument($entity): string
    {
        $website = $this->website->find(1);
        
        $message ="

        <h2> Informations sur le document à envoyé (Via DHL) : </h2>

        <p><strong>Référence du document :</strong> :".$entity->getDocumentId()."</p>
        <p><strong>Type de la demande :</strong> :".$entity->getNotarizeType()->getFRname()."</p>
        <p><strong>Nom :</strong> :".$entity->getCustomer()->getFirstname()."</p>
        <p><strong>Prénom :</strong>".$entity->getCustomer()->getSurname()."</p>
        <p><strong>Email du client :</strong>".$entity->getCustomer()->getEmail()."</p>
        <p><strong>Numéro de téléphone du client :</strong>".$entity->getCustomer()->getTelephone()."</p>
        <p><strong>Date d'envoi :</strong>".date("d/m/Y h:i:s ",$entity->getSenddate()->getTimestamp())."</p>


        <p><strong>Prix payé :</strong><br><br> 26€</p>

        <h3 style='color:red' >Votre document sera envoyé à votre domicile le :".$entity->getCustomer()->getPerson()->getResidenceAdress()." dans les plus bref délais</h3>

        <h3>Pour plus d'informations connectez-vous à votre espace dédié : <a href='".$website->getLink()."service-en-ligne'>cliquez-ici </a> </h3>
        
        ";

        return $message;
    }
    

    public function GetEmailPaymentForAdmin($entity): string
    {
        $website = $this->website->find(1);
        
        $message ="

        <h2> Informations de la demande : </h2>

        <p><strong>Code de la demande :</strong> :".$entity->getNumberId()."</p>
        <p><strong>Type de la demande :</strong> :".$entity->getType()->getFRname()."</p>
        <p><strong>Nom :</strong> :".$entity->getCustomer()->getFirstname()."</p>
        <p><strong>Prénom :</strong>".$entity->getCustomer()->getSurname()."</p>
        <p><strong>Email du client :</strong>".$entity->getCustomer()->getEmail()."</p>
        <p><strong>Numéro de téléphone du client :</strong>".$entity->getCustomer()->getTelephone()."</p>
        <p><strong>Date d'envoi :</strong>".date("d/m/Y h:i:s ",$entity->getDateCreation()->getTimestamp())."</p>

        <p><strong>Prix payé :</strong><br><br>".$entity->getCost()." €</p>
        <h3>Pour plus d'informations connectez-vous sur votre espace CUID : <a href='".$website->getLink()."cuid/dashboard/home'>cliquez-ici </a> </h3>
        
        ";

        return $message;
    }


    
    public function GetEmailPaymentDocumentForAdmin($entity): string
    {
        $website = $this->website->find(1);
        
        $message ="

        <h2> Informations sur le document à envoyé (Via DHL) : </h2>

        <p><strong>Référence du document :</strong> :".$entity->getDocumentId()."</p>
        <p><strong>Type de la demande :</strong> :".$entity->getNotarizeType()->getFRname()."</p>
        <p><strong>Nom :</strong> :".$entity->getCustomer()->getFirstname()."</p>
        <p><strong>Prénom :</strong>".$entity->getCustomer()->getSurname()."</p>
        <p><strong>Email du client :</strong>".$entity->getCustomer()->getEmail()."</p>
        <p><strong>Numéro de téléphone du client :</strong>".$entity->getCustomer()->getTelephone()."</p>
        <p><strong>Date d'envoi :</strong>".date("d/m/Y h:i:s ",$entity->getSenddate()->getTimestamp())."</p>



        <p><strong>Prix payé :</strong><br><br> 26€</p>

        <h3 style='color:red' >Veuillez envoyer ce document à l'adresse postale du demandeur :".$entity->getCustomer()->getPerson()->getResidenceAdress()."</h3>

        <h3>Pour plus d'informations connectez-vous sur votre espace CUID : <a href='".$website->getLink()."cuid/dashboard/home'>cliquez-ici </a> </h3>
        
        ";

        return $message;
    }
    

    
    public function GetEmailNotarize($entity): string
    {
        $website = $this->website->find(1);
        
        $message ="

        <h2> Informations de la demande : </h2>

        <p><strong>Code de la demande :</strong> :".$entity->getNumberId()."</p>
        <p><strong>Type de la demande :</strong> :".$entity->getType()->getFRname()."</p>
        <p><strong>Nom :</strong> :".$entity->getCustomer()->getFirstname()."</p>
        <p><strong>Prénom :</strong>".$entity->getCustomer()->getSurname()."</p>
        <p><strong>Email du client :</strong>".$entity->getCustomer()->getEmail()."</p>
        <p><strong>Numéro de téléphone du client :</strong>".$entity->getCustomer()->getTelephone()."</p>
        <p><strong>Date d'envoi :</strong>".date("d/m/Y h:i:s ",$entity->getDateCreation()->getTimestamp())."</p>


        <p><strong>Commentaire :</strong><br><br>".$entity->getComment()."</p>

        <h3>Pour plus d'informations connectez-vous à votre espace dédié : <a href='".$website->getLink()."service-en-ligne'>cliquez-ici </a> </h3>
        
        ";

        return $message;
    }

    


    public function GetEmailNotarizeDocument($entity,$servicedocument): string
    {
        $website = $this->website->find(1);
        
        $message ="

        <h2> Informations de la demande : </h2>

        <p><strong>Code de la demande :</strong> :".$entity->getNumberId()."</p>
        <p><strong>Type de la demande :</strong> :".$entity->getType()->getFRname()."</p>
        <p><strong>Nom :</strong> :".$entity->getCustomer()->getFirstname()."</p>
        <p><strong>Prénom :</strong>".$entity->getCustomer()->getSurname()."</p>
        <p><strong>Email du client :</strong>".$entity->getCustomer()->getEmail()."</p>
        <p><strong>Numéro de téléphone du client :</strong>".$entity->getCustomer()->getTelephone()."</p>
        <p><strong>Date d'envoi :</strong>".date("d/m/Y h:i:s ",$entity->getDateCreation()->getTimestamp())."</p>


        <p><strong>Commentaire :</strong><br><br>".$entity->getComment()."</p>

        <p>
        <strong>Pour vérifier votre document depuis votre espace la bonne délivrance de votre document, veuillez rentrer les informations suivantes dans <a href='".$website->getLink()."document/checking'>Vérifier un acte consulaire :</a></strong><br>
        <strong>Le numéro de référence du document :</strong><span>".$servicedocument->getDocumentId()."</span><br>
        <strong>La clé de contrôle:</strong><span>".$servicedocument->getCode()."</span><br>
        </p>

        <h3 style='color:red'>Veuillez prendre rendez-vous ou demander un envoie postal pour obtenir ce document</h3>

        <h3>Pour plus d'informations connectez-vous à votre espace dédié : <a href='".$website->getLink()."service-en-ligne'>cliquez-ici </a> </h3>
        
        ";

        return $message;
    }

    public function GetEmailVisa($entity,$password): string
    {
        $website = $this->website->find(1);
        
        $message ="

        <h2> Informations de la demande de Visa : </h2>

        <p><strong>Code de la demande :</strong> :".$entity->getNumberId()."</p>
        <p><strong>Nom :</strong> :".$entity->getCustomer()->getFirstname()."</p>
        <p><strong>Prénom :</strong>".$entity->getCustomer()->getSurname()."</p>
        <p><strong>Email du demandeur :</strong>".$entity->getCustomer()->getEmail()."</p>
        <p><strong>Numéro de téléphone du demandeur :</strong>".$entity->getCustomer()->getTelephone()."</p>
        <p><strong>Date d'envoi :</strong>".date("d/m/Y h:i:s ",$entity->getDateCreation()->getTimestamp())."</p>


        <p><strong>Commentaire :</strong><br><br>".$entity->getComment()."</p>

        <h3>Vous devez vous connectez à votre espace dédié avec les accès suivant : </h3>

        <p><stron>login : </strong> ".$entity->getCustomer()->getLogin()."</p>
        <p><stron>Password : </strong> ".$password."</p>

        <h3>Pour pousuivre vos démarches, connectez-vous à votre espace dédié : <a href='".$website->getLink()."service-en-ligne'>cliquez-ici </a> </h3>
        
        ";

        return $message;
    }

    
    public function GetEmailRegister($entity,$password): string
    {
        $website = $this->website->find(1);
        
        $message ="

        <h2> Informations de l'enregistrement : </h2>

        <p><strong>Code de la demande :</strong> :".$entity->getNumberId()."</p>
        <p><strong>Nom :</strong> :".$entity->getCustomer()->getFirstname()."</p>
        <p><strong>Prénom :</strong>".$entity->getCustomer()->getSurname()."</p>
        <p><strong>Email :</strong>".$entity->getCustomer()->getEmail()."</p>
        <p><strong>Numéro de téléphone :</strong>".$entity->getCustomer()->getTelephone()."</p>
        <p><strong>Date d'envoi :</strong>".date("d/m/Y h:i:s ",$entity->getDateCreation()->getTimestamp())."</p>


        <p><strong>Commentaire :</strong><br><br>".$entity->getComment()."</p>

        <h3>Pour poursuivre vos démarches consulaires , veuillez vous connectez avec votre compte ci-dessous : </h3>

        <p><stron>login : </strong> ".$entity->getCustomer()->getLogin()."</p>
        <p><stron>Password : </strong> ".$password."</p>

        <h3>Pour pousuivre vos démarches, connectez-vous à votre espace dédié : <a href='".$website->getLink()."service-en-ligne'>cliquez-ici </a> </h3>
        
        ";

        return $message;
    }
       
    
    public function GetEmailNotarizeForCompany($entity): string
    {
        $website = $this->website->find(1);
        
        $message ="

        <h2> Informations de la demande : </h2>

        <p><strong>Code de la demande :</strong> :".$entity->getNumberId()."</p>
        <p><strong>Type de la demande :</strong> :".$entity->getType()->getFRname()."</p>
        <p><strong>Nom :</strong> :".$entity->getCustomer()->getFirstname()."</p>
        <p><strong>Prénom :</strong>".$entity->getCustomer()->getSurname()."</p>
        <p><strong>Email du client :</strong>".$entity->getCustomer()->getEmail()."</p>
        <p><strong>Numéro de téléphone du client :</strong>".$entity->getCustomer()->getTelephone()."</p>
        <p><strong>Date d'envoi :</strong>".date("d/m/Y h:i:s ",$entity->getDateCreation()->getTimestamp())."</p>


        <p><strong>Commentaire :</strong><br><br>".$entity->getComment()."</p>

        <h3>Pour plus d'informations connectez-vous sur votre espace CUID : <a href='".$website->getLink()."cuid/dashboard/home'>cliquez-ici </a> </h3>
        
        ";

        return $message;
    }

    public function GetEmailBookingForCompany($entity,$email,$visitor): string
    {
        $website = $this->website->find(1);

        $performancelist = "";

        $performances = $entity->getPerformances();

        foreach($performances as $performance){

            $performancelist .= "<li>".$performance->getName()."</li>";
        }
        
        $message ="

        <h2> Informations du rendez-vous : </h2>

        <p><strong>Code de réservation :</strong> :".$entity->getCode()."</p>
        <p><strong>Visiteur :</strong> :".$visitor."</p>
        <p><strong>Email du client :</strong>".$email."</p>
        <p><strong>Numéro de téléphone du client :</strong>".$entity->getCustomer()->getTelephone()."</p>
        <p><strong>Adresse :</strong>".$entity->getLocation()."</p>
        <p><strong>Date et heure :</strong>".date("d/m/Y h:i:s ",$entity->getBookingDate()->getTimestamp())."</p>


                <h3>Prestation(s) demandée(s) :</h3>

            <ul>
            ".$performancelist."

            </ul>



        <h3>Pour plus d'informations connectez-vous sur votre espace CUID : <a href='".$website->getLink()."cuid/dashboard/home'>cliquez-ici </a> </h3>
        
        ";

        return $message;
    }



    public function GetEmailRecovering(): string
    {
        return file_get_contents("./build/mails/recover.html");
    }


    
}