<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Controller\Calendar;
use App\Entity\Booking;
use App\Entity\Event;
use App\Service\Executer\Executer;
use PhpOffice\PhpSpreadsheet\Calculation\Logical\Boolean;

    class CalendarController extends AbstractController
    {



        private $entityManager;
        private  $executer;

public function __construct(EntityManagerInterface $entityManager,Executer $executer) {

    $this->entityManager = $entityManager;
    $this->executer =  $executer;
}

        #[Route('/calendar/{date}', name: 'cuid_calendar')]

        public function index($date): Response
        {


            $calendar = new Calendar($date);

            $timestamp = strtotime($date);

            $events = $this->entityManager->getRepository(Event::class)->findAll();

            $month = date("m",$timestamp);
            $year = date("Y",$timestamp);

            $startdate = $year."-".$month."-01";

            $lastday = intval($this->executer->lastDayOfMonth($date));

            for($i=0;$i<$lastday;$i++){


                $checkdate = $this->executer->addDays($startdate,$i);



                if($this->executer->isWeekend($checkdate) == TRUE){

                    $calendar->add_weekend('W', $checkdate);

                }





            }


            foreach ($events as $event) {

                $thedate=$event->getEventDate()->getTimestamp();

            $calendar->add_event('X', date("Y-m-d",$thedate));


            } 
         
            return $this->render('calendar.html.twig', [

                'calendar' => $calendar,
    
            ]);
        }

        #[Route('/calendar-check-event/{date}', name: 'cuid_check_event')]

        public function checkevent($date): Response
        {


            $event = $this->entityManager->getRepository(Event::class)->findByEventDate($date);


            if($event == NULL){

                return new JsonResponse(['event' => false]);

            }else{

                return new JsonResponse(['event' => true]);
            }

    }
    }