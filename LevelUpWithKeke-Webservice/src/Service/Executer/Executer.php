<?php

namespace App\Service\Executer;

use App\Entity\Booking;
use App\Entity\CMSHomepage;
use App\Entity\CMSPage;
use App\Entity\CMSstat;
use App\Entity\CMSWebsite;
use App\Entity\Customer;
use App\Entity\Notarize;
use App\Entity\NotarizeType;
use App\Entity\Notification;
use DateInterval;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use DateTimeImmutable;
use GeoIp2\Database\Reader;


class Executer
{

    private $entityManager;


    public function __construct(


        EntityManagerInterface $entityManager,

        
        )
    {


        $this->entityManager = $entityManager;
    }


    public function loadListApi($entity){

        $website = $this->entityManager->getRepository(CMSWebsite::class)->find(1);

        $url = $website->getLink()."/api/data/get/list/".$entity;

        file_get_contents($url);


    }


    public function AddInArray(string $item, string $value,$currentarray)  {

        $arraylength = sizeof($currentarray);

        for($i = 0; $i < $arraylength; $i++ ){

            $currentarray[$i][$item]=$value;
        }
        
        $result=$currentarray;

        return $result;
    }

    public function JsonConverter($name,$entity,$property ){

        $className=NULL;

        if($entity=="service"){

            $className=NotarizeType::class;
            $entitydata = $this->entityManager->getRepository($className)->findByName($name);

        }

        if($entity=="homepage"){

            $className=CMSHomepage::class;
            $entitydata = $this->entityManager->getRepository($className)->find(1);

        }

        if($entity=="website"){

            $className=CMSWebsite::class;
            $entitydata = $this->entityManager->getRepository($className)->find(1);

        }


        if($entity=="page"){

            $className=CMSPage::class;
            $entitydata = $this->entityManager->getRepository($className)->findByName($name);

        }


        $counter = 1;


                        // Get the reflection class for the entity
                        $reflectionClass = new \ReflectionClass($className);

                        // Get all properties of the entity
                        $properties = $reflectionClass->getProperties();

                        for($i=0;$i<$counter;$i++){
                        // Loop through each property
                        foreach ($properties as $property) {
                            // Get the property name


                            $propertyName = $property->getName();




                            $propertyType = $property->getType()->getName();


                            if($propertyType == "bool"){

                                $prefix = 'is';

                            }else{

                                $prefix = 'get';

                            }
                            
                            $method = $prefix.ucfirst($propertyName);

                            $array[$propertyName] = $entitydata->$method();

                        }

                        }



                                // Base URL
                                $baseUrl = 'http://localhost:3000/json_manager';
                                
                                // Query parameters or JSON data
                                $data = $array;
                                
                                // Encode the parameters
                                $queryString = http_build_query($data);
                                
                                // Append the query string to the URL
                                $url = $baseUrl . '?json_name='.$entity.'&'.$queryString;


                                                                    // Make the request
                                    $response = file_get_contents($url);

                                    // Check for errors
                                    if ($response === false) {
                                        echo "Failed to open URL.";
                                    } else {
                                        echo "URL opened successfully: " . $response;
                                    }


                                return $url;

                      




    }

    public function AddNotification(int $userid, int $usertype, string $message)  {


        $today = new DateTimeImmutable();

        $notification = new Notification();
        $notification->setUserId($userid);
        $notification->setUserType($usertype);
        $notification->setMessage($message);
        $notification->setSeen(0);
        $notification->setDateReceived($today);

        // Persist the entity
         $this->entityManager->persist($notification);
        $this->entityManager->flush();

    }

    public function GenerateToken($date)  {

        $randomNumbers = "";

        for ($i = 0; $i < 7; $i++) {
            $randomNumbers .= mt_rand(0, 9); // Adjust the range (1, 100) as needed


        }

        $dateString = $date->format('Y-m-d H:i:s');


        $code = 'aienova'."-".$randomNumbers."-".$dateString;



        $encryptionKey = '02SmtIg';

        // Text to be encrypted

        // Encrypt the code
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $ciphercode = openssl_encrypt($code, 'aes-256-cbc', $encryptionKey, 0, $iv);

        // Decrypt the code
        // $decryptedcode = openssl_decrypt($ciphertext, 'aes-256-cbc', $encryptionKey, 0, $iv);

        $token = $ciphercode;

        return $token;


    }


    public function startConnection($entity,$today,$token){

        $entity->setConnected(TRUE);
        $entity->setConnectionDate($today);
        $entity->setToken($token);


    }

    public function createLogin($firstname) {

         // Convertir le prénom en minuscules
    $login = strtolower($firstname);
    
    // Enlever les accents
    $login = iconv('UTF-8', 'ASCII//TRANSLIT', $login);
    
    // Supprimer les caractères spéciaux
    $login = preg_replace('/[^a-z0-9]/', '', $login);
    
    return $login;

    }

    function isWeekend($date) {
        return (date('N', strtotime($date)) >= 6);
    }


    public function lastDayOfMonth($date) {
        // Crée une instance de DateTime à partir de la date fournie
        $dateObj = new DateTime($date);
    
        // Modifie la date pour se positionner au dernier jour du mois
        $dateObj->modify('last day of this month');
    
        // Retourne le dernier jour du mois
        return $dateObj->format('d'); // format retourne la date au format année-mois-jour
    }


    function addDays($date,$days) {
        // Crée une instance de DateTime à partir de la date fournie
        $dateObj = new DateTime($date);
    
        // Ajoute un intervalle d'un jour
        $dateObj->add(new DateInterval('P'.$days.'D')); // 'P1D' signifie une période de 1 jour
    
        // Retourne la nouvelle date
        return $dateObj->format('Y-m-d'); // format retourne la date au format année-mois-jour
    }
    

    public function generateRandomString() {


        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;


    }


    public function UpgradeStatistic($today){


        $year = date("Y",$today->getTimestamp());

        $stat =  $this->entityManager->getRepository(CMSstat::class)->findByYear($year);

        if($stat==NULL){

            $stat = new CMSstat;
        }

        $customers = $this->entityManager->getRepository(Customer::class)->findAll();
        $types = $this->entityManager->getRepository(NotarizeType::class)->findAll();
        $servicesInProgress = $this->entityManager->getRepository(Notarize::class)->findByCurrentForYear($year);
        $servicesCancelledNumber = $this->entityManager->getRepository(Notarize::class)->findByCancelledForYear($year);
        $servicesCompleteNumber = $this->entityManager->getRepository(Notarize::class)->findByPaidForYear($year);
        
        foreach($types as $type){

            $services = $this->entityManager->getRepository(Notarize::class)->findByTypeForYear($type,$year);

            $typelist[$type->getFRname()] = count($services);

        }

        $maxvalue = max($typelist);

                    // Find all keys that correspond to the max value

            foreach ($typelist as $key => $value) {
                if ($value === $maxvalue) {
                    $keysWithMaxValue = $key;
                }
            }



            foreach($customers as $customer){

                $services = $this->entityManager->getRepository(Notarize::class)->findByCustomerForYear($customer,$year);
    
                $customerlist[ $customer->getId()] = count($services);
    
            }

            $maxvalue2 = max($customerlist);

            // Find all keys that correspond to the max value
    $keysWithMaxValue2 = NULL;
    foreach ($customerlist as $key => $value) {
        if ($value === $maxvalue2) {
            $keysWithMaxValue2 = $key;
        }
    }

    $bestcusttomer = $this->entityManager->getRepository(Customer::class)->find($keysWithMaxValue2);
    $servicelistbycustomer = $this->entityManager->getRepository(Notarize::class)->findByCustomerPaidForYear($bestcusttomer,$year);
    $costs = array_column($servicelistbycustomer, 'cost');
    $totalcosts = array_sum($costs);
    $bookingNumber = $this->entityManager->getRepository(Booking::class)->findForYear($year);
    $serviceNumber = $this->entityManager->getRepository(Notarize::class)->findForYear($year);
    $bookingCancelledNumber = $this->entityManager->getRepository(Booking::class)->findByCancelledForYear($year);
    $bookingCompleteNumber = $this->entityManager->getRepository(Booking::class)->findByPaidForYear($year);
    $bookingInProgressNumber = $this->entityManager->getRepository(Booking::class)->findByCurrentForYear($year);
    
    $turnover = 0;

    foreach($servicesCompleteNumber as $servicePaid){


        $turnover =+  $servicePaid->getCost();
    }




        $stat->setCustomerNumber(count($customers));
        $stat->setServicesInProgressNumber(count($servicesInProgress));
        $stat->setServicesCancelledNumber(count($servicesCancelledNumber));
        $stat->setServicesCompleteNumber(count($servicesCompleteNumber));
        $stat->setServicesCompleteNumber(count($servicesCompleteNumber));
        $stat->setServiceMostWanted($keysWithMaxValue);
        $stat->setServiceMostWantedNumber($maxvalue);
        $stat->setBestCustomer($bestcusttomer->getFirstname()." ".$bestcusttomer->getSurname());
        $stat->setBestCustomerServicesNumber($maxvalue2);
        $stat->setBestCustomerSpent($totalcosts);
        $stat->setBookingNumber(count($bookingNumber));
        $stat->setServiceNumber(count($serviceNumber));
        $stat->setBookingCancelledNumber(count($bookingCancelledNumber));
        $stat->setBookingCompleteNumber(count($bookingCompleteNumber));
        $stat->setBookingInProgressNumber(count($bookingInProgressNumber));
        $stat->setTurnover($turnover);


        $this->entityManager->persist($stat);
        $this->entityManager->flush();

        return $stat; 


    }

    public function SetNotarizeTypeTotal(){


        $NotarizeTypes = $this->entityManager->getRepository(NotarizeType::class)->findAll();


        foreach ($NotarizeTypes as $type ){

            $services = $this->entityManager->getRepository(Notarize::class)->findByType($type);

            $type->setTotal(count($services));
        }


    }


    public function SetCustomerTotalServices(){


        $customers = $this->entityManager->getRepository(Customer::class)->findAll();


        foreach ($customers as $customer ){

            $services = $this->entityManager->getRepository(Notarize::class)->findByCustomer($customer);

            $customer->setTotalServices(count($services));
        }


    }





}
