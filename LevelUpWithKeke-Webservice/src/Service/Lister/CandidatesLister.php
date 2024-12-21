<?php

namespace App\Service\Lister;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Candidate;
use App\Entity\JobOffer;
use App\Entity\Company;
use App\Entity\Job;
use App\Repository\JobRepository;
use App\Repository\AppliedJobRepository;
use App\Repository\ApplicationRepository;
use App\Repository\CandidateRepository;
use App\Repository\JobOfferRepository;
use App\Service\Executer\Executer;

class CandidatesLister
{

    private $candidaterepository;
    private $appliedjobpository;
    private $applicationpository;


    public function __construct(

        CandidateRepository $candidaterepository,
        ApplicationRepository $applicationpository,

        
        )
    {
        $this->candidaterepository = $candidaterepository;
        $this->applicationpository = $applicationpository;

    }

    public function listCandidateByJob(Job $job)  {

        $result = $this->candidaterepository->findCandidateByJob($job);

        return $result;
    }

    public function listApplicationsByCompany(Company $company)  {

        $result = $this->applicationpository->findApplicationsByCompany($company);

        return $result;

    }


    public function listApplicationsByCandidate(Candidate $candidate)  {

        $result = $this->applicationpository->findApplicationsByCandidate($candidate);

        return $result;

    }

    public function listApplicationsByJobOffer(JobOffer $joboffer)  {

        $result = $this->applicationpository->findApplicationsByJobOffer($joboffer);

        return $result;

    }

    public function listApplicationsByJobOfferTitle(string $jobofferitle)  {

        $result = $this->applicationpository->findApplicationsByJobOfferTitle($jobofferitle);

        return $result;

    }

    public function listApplicationsByJobOfferTitleAndCandidate(Candidate $candidate, string $jobofferitle)  {

        $result = $this->applicationpository->findApplicationsByJobOfferTitleAndCandidate($jobofferitle,$candidate);

        return $result;

    }

    
}
