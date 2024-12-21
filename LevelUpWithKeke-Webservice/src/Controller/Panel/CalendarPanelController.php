<?php 


namespace App\Controller\Panel;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalendarPanelController extends AbstractController
{
    #[Route('calendarpanel/{id}', name: 'cuid_calendar_panel')]

    public function calendarpanel(): Response
    {
        // Render the calendar in this action.
        return $this->render('panel/calendar.html.twig');
    }
}


?>