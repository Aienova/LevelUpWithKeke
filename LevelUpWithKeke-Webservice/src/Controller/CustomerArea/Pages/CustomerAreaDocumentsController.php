<?php

namespace App\Controller\CustomerArea\Pages;

use App\Entity\CMSgraphics;
use App\Entity\CMSitemSettings;
use App\Entity\CMSmenu;
use App\Entity\CMSPage;
use App\Entity\CMSsocialmedia;
use App\Entity\CMSWebsite;
use App\Entity\Customer;
use App\Entity\Decision;
use App\Entity\Form;
use App\Entity\FormStep;
use App\Entity\Gender;
use App\Entity\IdentityType;
use App\Entity\MaritalStatus;
use App\Entity\Nation;
use App\Entity\NationalType;
use App\Entity\Notarize;
use App\Entity\Performance;
use App\Entity\TravelReason;
use App\Entity\VisaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\Security\Security;
use App\Service\Form\SubmitForm;
use App\Service\Mailer\Mailer;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\Executer\Executer;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Templating\TemplateNameParser;


class CustomerAreaDocumentsController extends AbstractController
{

    private $security;
    private $submitform;
    private $mailer;
    private $entityManager;
    private $executer;

    public function __construct(Security $security, SubmitForm $submitform, Mailer $mailer, EntityManagerInterface $entityManager, Executer $executer)
    {

        $this->security = $security;
        $this->submitform = $submitform;
        $this->mailer = $mailer;
        $this->entityManager = $entityManager;
        $this->executer = $executer;
    }


    #[Route('/document/{pagename}', name: 'cuid_document')]
    public function index(String $pagename, SessionInterface $session): Response
    {



        $part = "customer-area";
        $user = $session->get("user");

        if($user == NULL){

            $userid = 1;

        }else{

            $userid = $user->getId();
        }

        $formmessage = "";
        $sent = 0;
        $documentlinks = "";
        $website = $this->entityManager->getRepository(CMSWebsite::class)->find(1);
        $form = $this->entityManager->getRepository(Form::class)->findByName($pagename);
        $customer = $this->entityManager->getRepository(Customer::class)->find($userid);
        $code = $this->submitform->randomizeCode($customer);
        $graphics = $this->entityManager->getRepository(CMSgraphics::class)->find(1);
        $socialmedia = $this->entityManager->getRepository(CMSsocialmedia::class)->findAll();  
        $today = new DateTimeImmutable();   



        $documents = NULL;
        $passports = NULL;
        
        $page = $this->entityManager->getRepository(Form::class)->findByName($pagename);


        $steps = $this->entityManager->getRepository(FormStep::class)->findByForm($page->getId());

        $menu = $this->entityManager->getRepository(CMSmenu::class)->findAll();

        $maritalStatus = $this->entityManager->getRepository(MaritalStatus::class)->findAll();

        $nations = $this->entityManager->getRepository(Nation::class)->findAll();

        $genders = $this->entityManager->getRepository(Gender::class)->findAll();

        $visa = null;

        $visaTypes = $this->entityManager->getRepository(VisaType::class)->findAll();

        $nationalTypes = $this->entityManager->getRepository(NationalType::class)->findAll();

        $identityTypes = $this->entityManager->getRepository(IdentityType::class)->findAll();

        $travelReasons = $this->entityManager->getRepository(TravelReason::class)->findAll();



        $previousRegisterNotarizeArray = $this->entityManager->getRepository(Notarize::class)->findByCustomerForRegister($customer);

        if($previousRegisterNotarizeArray != NULL){

            $previousRegisterNotarize = $previousRegisterNotarizeArray[0];

        }else{

            $previousRegisterNotarize = NULL;
        }

            
        $templateExists = $this->container->get('twig')->getLoader()->exists($part . '/documents/document-' . $pagename . '.html.twig');

        if ($templateExists) {

            $template = $part . '/documents/document-' . $pagename . '.html.twig';

        } else {
            // Handle if template doesn't exist
            // For example, render another template or return a response
            $template = $part . '/documents/document.html.twig';
        }


        if (isset($_POST["formType"])) {


            if ($_POST["formType"] == 1) {
  

                /*--------------- NEW ACCOUNT -------------*/

                if(isset($_POST["email"])){

                    $email = $_POST["email"];

                }else{

                    $email = $customer->getEmail();
                }

                $findcustomer = $this->entityManager->getRepository(Customer::class)->findByEmail($email);


                if( ($findcustomer == NULL && $userid==1)  || $userid!=1 ){

                    if($userid == 1){

                    $newcustomer = new customer;

                    $firstNameInitial = substr($_POST["firstname"], 0, 1);
                    $surNameInitial = substr($_POST["surname"], 0, 1);

                    $password = $firstNameInitial.$surNameInitial.$this->executer->generateRandomString().date("Ymd");



                    $newcustomer->setFirstname($_POST["firstname"]);
                    $newcustomer->setSurname($_POST["surname"]);
                    $newcustomer->setEmail($_POST["email"]);
                    $newcustomer->setTelephone($_POST["phone"]);
                    $newcustomer->setPassword(md5($password));

                    $newcustomer->setMainLocation($_POST["mainLocation"]);
                    $newcustomer->setCreationDate($today);
                    $newcustomer->setSignedUp(1);
                    $newcustomer->setState(0);
                    $customer = $newcustomer;
                    $code = $this->submitform->randomizeCode($customer);
               
                    
                    $this->entityManager->persist($customer);
                    $this->entityManager->flush();
                    $login = $this->executer->createLogin($_POST["firstname"]).$customer->getId(); 
                    $customer->setLogin($login);    
                    $this->entityManager->persist($customer);
                    $this->entityManager->flush();

                    }else{

                        $password = "*****";
                    }

                    $visa = $this->submitform->createVisa($_POST,$customer);


                    $notarize = $this->submitform->createNotarizeForCustomerFormData($documentlinks,$customer,$code,$form);
    
                    $notarize->setVisa($visa);
                    $notarize->setPassport($visa->getPassport());
                    $notarize->setPerson($visa->getPerson());
                    $person = $visa->getPerson();


                    $person->setCustomer($customer);
                    $this->entityManager->persist($person);
                    $this->entityManager->flush();


                /*------------ NEW ACCOUNT ---------------*/

                $directory = $this->getParameter('upload_directory');


                $filename = array_keys($_FILES);


                // Define your target directory
                $targetDir = $directory . "/notarize/" . $customer->getId() . "/" . $code;

                // Ensure that the target directory exists
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }

                // Count total files
                $totalFiles = count($filename);


                // Loop through each file
                for ($i = 0; $i < $totalFiles; $i++) {


                    $fileName = $_FILES[$filename[$i]]["name"];

                    $extension = pathinfo($fileName, PATHINFO_EXTENSION);

                    $fileName = "document_" . $form->getName() . "_" . $customer->getFirstname() . "_" . $customer->getSurname() . "_" . $i . "." . $extension;

                    $targetFilePath = $targetDir . "/" . $fileName;

                    // Get the current protocol
                    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';

                    // Get the main URL domain
                    $domain = $protocol . $_SERVER['HTTP_HOST'];

                    $link = $domain . "/cuid/document/notarize/" . $customer->getId() . "/" . $code . "/" . $fileName;

                    // Check if file is selected and then proceed to move it to the target directory
                    if (!empty($_FILES[$filename[$i]]['name'])) {
                        // You can add more validations here (file size, file type, etc.)
                        if (move_uploaded_file($_FILES[$filename[$i]]['tmp_name'], $targetFilePath)) {

                            echo "The file " . $fileName . " has been uploaded.";

                            if($i == 0){

                                $this->submitform->uploadPhoto($link, $fileName, $notarize->getPerson());

                            }else{

                                $this->submitform->uploadDocument($link, $fileName, $customer, $notarize);
                            }


                        } else {
                            echo "Sorry, there was an error uploading your file.";
                        }
                    }

                    $documentlinks .= "<a href='" . $targetFilePath . "'><li>" . $fileName . "</li></a>";
                }

                $notarize->setCost($notarize->getVisa()->getVisaType()->getPrice());

                $this->entityManager->persist($notarize);
                $this->entityManager->flush();

                
            $formmessage="Votre demande de visa a bien été enregistré, un mail de confirmation vous a été envoyé pour accéder à votre compte :<br>".$email;

            $emailmessage=$this->mailer->GetEmailVisa($notarize,$password);
            $emailmessagforcompany=$this->mailer->GetEmailNotarizeForCompany($notarize);

            $this->mailer->sendEmail($email,1, $emailmessage);
            $this->mailer->sendEmail($website->getEmail(),2, $emailmessagforcompany);
            $sent = 1;

                }else{


                    $formmessage="Cette email est déjà associé à un compte, veuillez vous connecter avec ce compte à <bR>l'email (ci-dessous) pour poursuivre votre demande de Visa :<br>".$email;
                    $sent = 1;

                }


            }


            if ($_POST["formType"] == 2) {  // CREATE NEW REGISTER


                /*--------------- NEW ACCOUNT -------------*/

                $email = $_POST["email"];

                $findcustomer = $this->entityManager->getRepository(Customer::class)->findByEmail($email);
                

                if( ($findcustomer == NULL && $userid==1)  || $userid!=1 ){

                    if($userid == 1){

                    $newcustomer = new customer;

                    $firstNameInitial = substr($_POST["firstname"], 0, 1);
                    $surNameInitial = substr($_POST["surname"], 0, 1);

                    $password = $firstNameInitial.$surNameInitial.$this->executer->generateRandomString().date("Ymd");

                    $newcustomer->setFirstname($_POST["firstname"]);
                    $newcustomer->setSurname($_POST["surname"]);
                    $newcustomer->setEmail($_POST["email"]);
                    $newcustomer->setTelephone($_POST["telephone"]);
                    $newcustomer->setPassword(md5($password));
                    $newcustomer->setMainLocation($_POST["residenceAdress"]);
                    $newcustomer->setCreationDate($today);
                    $newcustomer->setSignedUp(1);
                    $newcustomer->setState(0);
                    $customer = $newcustomer;
                    $code = $this->submitform->randomizeCode($customer);
                     
                    $this->entityManager->persist($customer);
                    $this->entityManager->flush();
                    $login = $this->executer->createLogin($_POST["firstname"]).$customer->getId(); 
                    $customer->setLogin($login);    
                    $this->entityManager->persist($customer);
                    $this->entityManager->flush();

                    }else{

                        $password = "***";
                    }


                    if(isset($_POST["notarizeId"])){

                        $notarize = $this->entityManager->getRepository(Notarize::class)->findByNumberId($_POST["notarizeId"])[0];

                    }else{

                        $notarize = $this->submitform->createNotarizeForCustomerFormData($documentlinks,$customer,$code,$form);
                    }

                    $person = $this->submitform->createPerson($_POST,$customer);
                    $person->setComplete(1);
                    $person->setCustomer($customer);


                    $this->entityManager->persist($person);
                    $this->entityManager->flush();

                    $notarize->setPerson($person);

                    if($notarize->getType()->getName() == "register"){

                        $notarize->setDecision($this->entityManager->getRepository(Decision::class)->find(3));
                    }

                    $this->entityManager->persist($notarize);
                    $this->entityManager->flush();

                /*------------ NEW ACCOUNT ---------------*/

                $directory = $this->getParameter('upload_directory');


                $filename = array_keys($_FILES);


                // Define your target directory
                $targetDir = $directory . "/notarize/" . $customer->getId() . "/" . $code;

                // Ensure that the target directory exists
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }

                // Count total files
                $totalFiles = count($filename);


                // Loop through each file
                for ($i = 0; $i < $totalFiles; $i++) {


                    $fileName = $_FILES[$filename[$i]]["name"];

                    $extension = pathinfo($fileName, PATHINFO_EXTENSION);

                    $fileName = "document_" . $form->getName() . "_" . $customer->getFirstname() . "_" . $customer->getSurname() . "_" . $i . "." . $extension;

                    $targetFilePath = $targetDir . "/" . $fileName;

                    // Get the current protocol
                    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';

                    // Get the main URL domain
                    $domain = $protocol . $_SERVER['HTTP_HOST'];

                    $link = $domain . "/cuid/document/notarize/" . $customer->getId() . "/" . $code . "/" . $fileName;

                    // Check if file is selected and then proceed to move it to the target directory
                    if (!empty($_FILES[$filename[$i]]['name'])) {
                        // You can add more validations here (file size, file type, etc.)
                        if (move_uploaded_file($_FILES[$filename[$i]]['tmp_name'], $targetFilePath)) {

                            echo "The file " . $fileName . " has been uploaded.";

                            if($i == 0){

                                $this->submitform->uploadPhoto($link, $fileName, $notarize->getPerson());

                            }else{

                                $this->submitform->uploadDocument($link, $fileName, $customer, $notarize);
                            }


                        } else {
                            echo "Sorry, there was an error uploading your file.";
                        }
                    }

                    $documentlinks .= "<a href='" . $targetFilePath . "'><li>" . $fileName . "</li></a>";
                }

                $this->entityManager->persist($notarize);
                $this->entityManager->flush();

                if(isset($_POST["editmessage"])){


                    $formmessage=$_POST["editmessage"].", un mail de confirmation vous a été envoyé pour accéder à votre compte :<br>".$email;

                }else{

                    $formmessage="Votre enregistrement a bien été effectué, un mail de confirmation vous a été envoyé pour accéder à votre compte :<br>".$email;


                }
                

            $emailmessage=$this->mailer->GetEmailRegister($notarize,$password);
            $emailmessagforcompany=$this->mailer->GetEmailNotarizeForCompany($notarize);

            $this->mailer->sendEmail($email,21, $emailmessage);
            $this->mailer->sendEmail($website->getEmail(),22, $emailmessagforcompany);
            $sent = 1;

                }else{


                    $formmessage="Cette email est déjà associé à un compte, veuillez vous connecter avec ce compte à <bR>l'email (ci-dessous) pour compléter votre enregistrement:<br>".$email;
                    $sent = 1;

                }

        }

        if ($_POST["formType"] == 3) {


            $documents = $this->submitform->findNotarizeDocument($customer);

            if($documents == NULL){

                $formmessage = "Nous n'avons trouvez aucun document avec les références données ";
                $sent = 1;
            }else{

                $sent = 0;
            }





        }

        
        if ($_POST["formType"] == 4) {


            $passports = $this->submitform->findPassport($customer);

            if($passports == NULL){

                $formmessage = "Nous n'avons trouvez aucun passeport avec les références données ";
                $sent = 1;
            }else{

                $sent = 0;
            }





        }

                
        if ($_POST["formType"] == 5) {


            $visa = $this->submitform->findVisa($customer);


            if($visa == NULL){

                $formmessage = "Nous n'avons trouvez aucun visa avec les références données ";
                $sent = 1;

            }else{

                $sent = 0;
            }

        }

            if ($_POST["formType"] == 0) {



                $notarizeentity = $this->submitform->createNotarizeForCustomerFormData($documentlinks, $customer, $code, $form);

                $directory = $this->getParameter('upload_directory');


                $filename = array_keys($_FILES);


                // Define your target directory
                $targetDir = $directory . "/notarize/" . $customer->getId() . "/" . $code;

                // Ensure that the target directory exists
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }

                // Count total files
                $totalFiles = count($filename);


                // Loop through each file
                for ($i = 0; $i < $totalFiles; $i++) {


                    $fileName = $_FILES[$filename[$i]]["name"];

                    $extension = pathinfo($fileName, PATHINFO_EXTENSION);

                    $fileName = "document_" . $form->getName() . "_" . $customer->getFirstname() . "_" . $customer->getSurname() . "_" . $i . "." . $extension;

                    $targetFilePath = $targetDir . "/" . $fileName;

                    // Get the current protocol
                    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';

                    // Get the main URL domain
                    $domain = $protocol . $_SERVER['HTTP_HOST'];

                    $link = $domain . "/cuid/document/notarize/" . $customer->getId() . "/" . $code . "/" . $fileName;

                    // Check if file is selected and then proceed to move it to the target directory
                    if (!empty($_FILES[$filename[$i]]['name'])) {
                        // You can add more validations here (file size, file type, etc.)
                        if (move_uploaded_file($_FILES[$filename[$i]]['tmp_name'], $targetFilePath)) {

                            echo "The file " . $fileName . " has been uploaded.";
                            $this->submitform->uploadDocument($link, $fileName, $customer, $notarizeentity);
                        } else {
                            echo "Sorry, there was an error uploading your file.";
                        }
                    }

                    $documentlinks .= "<a href='" . $targetFilePath . "'><li>" . $fileName . "</li></a>";
                }

                $this->submitform->createFormData($_POST, $customer, $form, $notarizeentity);

                $formmessage="Votre demande a bien été enregistré, un mail de confirmation a été envoyé à :<br>".$customer->getEmail();
    
                $emailmessage=$this->mailer->GetEmailNotarize($notarizeentity);
                $emailmessagforcompany=$this->mailer->GetEmailNotarizeForCompany($notarizeentity);
    
                $this->mailer->sendEmail($customer->getEmail(),1, $emailmessage);
                $this->mailer->sendEmail($website->getEmail(),2, $emailmessagforcompany);
                $sent = 1;
            }




        }



        return $this->render($template, [

            'part' => $part,
            'previousRegisterNotarize' => $previousRegisterNotarize,
            'form' => $page,
            'steps' => $steps,
            'documents' => $documents,
            'sent' => $sent,
            "website"=> $this->entityManager->getRepository(CMSWebsite::class)->find(1),
            'graphics' => $graphics,
            'formmessage' => $formmessage,
            'travelReasons' => $travelReasons,
            'nationalTypes' => $nationalTypes,
            'identityTypes' => $identityTypes,
            'passports' => $passports,
            'genders' => $genders,
            'notavisa' => $visa,
            'visaTypes' => $visaTypes,
            'maritalStatus' => $maritalStatus,
            'nations' => $nations,
            'menu' => $menu,
            'customer' => $customer,
            'socials' => $socialmedia,
            'title' => $page->getTitle(),
            'description' => $page->getDescription()

        ]);
    }
}
