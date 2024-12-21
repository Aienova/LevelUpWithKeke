<?php

namespace App\Repository;

use App\Entity\Customer;
use App\Entity\Notarize;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Notarize>
 *
 * @method Notarize|null find($id, $lockMode = null, $lockVersion = null)
 * @method Notarize|null findOneBy(array $criteria, array $orderBy = null)
 * @method Notarize[]    findAll()
 * @method Notarize[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NotarizeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Notarize::class);
    }

//    /**
//     * @return Notarize[] Returns an array of Notarize objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('n.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Notarize
//    {
//        return $this->createQueryBuilder('n')
//            ->andWhere('n.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

public function findByFilter($proprety,$value,$decision): array
{

    return $this->createQueryBuilder('n')
    ->join('n.customer', 'cus')
    ->join('n.type', 'tp')
    ->andWhere($proprety.' like :prop')
    ->andWhere('n.decision = :decision')
     ->setParameter('prop', "%".$value."%")
     ->setParameter('decision', $decision)
    ->orderBy('n.id', 'ASC')
    ->getQuery()
    ->getResult()
;

}


public function findForYear($year): array
{
   return $this->createQueryBuilder('n')
   ->andwhere('YEAR(n.dateCreation) = :year')
        ->setParameter('year', $year)
       ->orderBy('n.id', 'ASC')
        ->getQuery()
       ->getResult()
    ;
}



public function findByCustomer($customer): array
{
   return $this->createQueryBuilder('n')
       ->andWhere('n.customer = :customer')
        ->setParameter('customer', $customer)
       ->orderBy('n.id', 'ASC')
        ->getQuery()
       ->getResult()
    ;
}




public function findByCustomerForRegister($customer): array
{
   return $this->createQueryBuilder('n')
       ->andWhere('n.customer = :customer')
        ->setParameter('customer', $customer)
       ->orderBy('n.id', 'DESC')
       ->getQuery()
       ->getResult()

       ;
    
}

public function findAllForYear($year): array
{
   return $this->createQueryBuilder('n')
       ->andwhere('YEAR(n.dateCreation) = :year')
        ->setParameter('year', $year)
       ->orderBy('n.id', 'ASC')
        ->getQuery()
       ->getResult()
    ;
}


public function findByTypeForYear($type,$year): array
{
   return $this->createQueryBuilder('n')
       ->andWhere('n.type = :type')
       ->andwhere('YEAR(n.dateCreation) = :year')
        ->setParameter('type', $type)
        ->setParameter('year', $year)
       ->orderBy('n.id', 'ASC')
        ->getQuery()
       ->getResult()
    ;
}


public function findByCustomerForYear($customer,$year): array
{
   return $this->createQueryBuilder('n')
       ->andWhere('n.customer = :customer')
       ->andwhere('YEAR(n.dateCreation) = :year')
        ->setParameter('customer', $customer)
        ->setParameter('year', $year)
       ->orderBy('n.id', 'ASC')
        ->getQuery()
       ->getResult()
    ;
}


public function findByCustomerPaidForYear($customer,$year): array
{
   return $this->createQueryBuilder('n')
       ->andWhere('n.customer = :customer')
       ->andWhere('n.paid = TRUE')
       ->andwhere('YEAR(n.dateCreation) = :year')
        ->setParameter('customer', $customer)
        ->setParameter('year', $year)
       ->orderBy('n.id', 'ASC')
        ->getQuery()
       ->getResult()
    ;
}


public function findOneByCustomer($customer): ?Notarize
{
   return $this->createQueryBuilder('n')
       ->andWhere('n.customer = :customer')
        ->setParameter('customer', $customer)
       ->orderBy('n.id', 'ASC')
        ->getQuery()
       ->getOneOrNullResult();
    
}




public function findByDecisionAndCustomer($customer,$decision): array
{
    return $this->createQueryBuilder('n')
    ->andWhere('n.customer = :customer')
    ->andWhere('n.decision = :decision')
     ->setParameter('customer', $customer)
     ->setParameter('decision', $decision)
    ->orderBy('n.id', 'ASC')
       ->getQuery()
       ->getResult();
    
}


public function findByMustPay($customer,$decision): array
{
    return $this->createQueryBuilder('n')
    ->andWhere('n.customer = :customer')
    ->andWhere('n.decision = :decision')
    ->andWhere('n.cost is not NULL')
    ->andWhere('n.paid = FALSE')
     ->setParameter('customer', $customer)
     ->setParameter('decision', $decision)
    ->orderBy('n.id', 'ASC')
       ->getQuery()
       ->getResult();
    
}


public function findByForm($form): array
{
   return $this->createQueryBuilder('n')
       ->andWhere('n.form = :form')
        ->setParameter('form', $form)
       ->orderBy('n.id', 'ASC')
       ->getQuery()
       ->getResult();
    
}

public function findByCurrent(): array
{
   return $this->createQueryBuilder('n')
       ->andWhere('n.paid = FALSE')
       ->andWhere('n.cancelled = FALSE')
       ->orderBy('n.id', 'ASC')
        ->getQuery()
       ->getResult()
    ;
}


public function findByCurrentForYear($year): array
{
   return $this->createQueryBuilder('n')
       ->andWhere('n.paid = FALSE')
       ->andwhere('YEAR(n.dateCreation) = :year')
       ->andWhere('n.cancelled = FALSE')
       ->setParameter('year', $year)
       ->orderBy('n.id', 'ASC')
        ->getQuery()
       ->getResult()
    ;
}

public function findByCancelled(): array
{
   return $this->createQueryBuilder('n')
       ->andWhere('n.cancelled = TRUE')
       ->orderBy('n.id', 'ASC')
        ->getQuery()
       ->getResult()
    ;
}


public function findByCancelledForYear($year): array
{
   return $this->createQueryBuilder('n')
       ->andWhere('n.cancelled = TRUE')
       ->andwhere('YEAR(n.dateCreation) = :year')
       ->setParameter('year', $year)
       ->orderBy('n.id', 'ASC')
        ->getQuery()
       ->getResult()
    ;
}

public function findByPaid(): array
{
   return $this->createQueryBuilder('n')
        ->andWhere('n.paid = TRUE')
       ->orderBy('n.id', 'ASC')
        ->getQuery()
       ->getResult()
    ;
}


public function findByPaidForYear($year): array
{
   return $this->createQueryBuilder('n')
        ->andWhere('n.paid = TRUE')
        ->andwhere('YEAR(n.dateCreation) = :year')
        ->setParameter('year', $year)
       ->orderBy('n.id', 'ASC')
        ->getQuery()
       ->getResult()
    ;
}


public function findByCustomerAndCurrent($customer): array
{
   return $this->createQueryBuilder('n')
       ->andWhere('n.customer = :customer')
       ->andWhere('n.paid = FALSE')
       ->andWhere('n.cancelled = FALSE')
        ->setParameter('customer', $customer)
       ->orderBy('n.id', 'ASC')
        ->getQuery()
       ->getResult()
    ;
}

public function findByTypeCustomerAndCurrent($type,$customer): array
{
   return $this->createQueryBuilder('n')
       ->andWhere('n.customer = :customer')
       ->andWhere('n.paid = FALSE')
       ->andWhere('n.cancelled = FALSE')
       ->andWhere('n.type = :type')
        ->setParameter('customer', $customer)
        ->setParameter('type', $type)
       ->orderBy('n.id', 'ASC')
        ->getQuery()
       ->getResult()
    ;
}




public function findByCustomerValidButNotPaid($customer): array
{
   return $this->createQueryBuilder('n')
       ->andWhere('n.customer = :customer')
       ->andWhere('n.decision = 3')
       ->andWhere('n.cost is not NULL ')
       ->andWhere('n.paid = FALSE')
       ->andWhere('n.cancelled = FALSE')
        ->setParameter('customer', $customer)
       ->orderBy('n.id', 'ASC')
        ->getQuery()
       ->getResult()
    ;
}


public function findByCustomerAndCancelled($customer): array
{
   return $this->createQueryBuilder('n')
       ->andWhere('n.customer = :customer')
       ->andWhere('n.cancelled = TRUE')
        ->setParameter('customer', $customer)
       ->orderBy('n.id', 'ASC')
        ->getQuery()
       ->getResult()
    ;
}


public function findByCustomerAndPaid($customer): array
{
   return $this->createQueryBuilder('n')
       ->andWhere('n.customer = :customer')
       ->andWhere('n.paid = TRUE')
        ->setParameter('customer', $customer)
       ->orderBy('n.id', 'ASC')
        ->getQuery()
       ->getResult()
    ;
}


public function findByPaymentCode($paymentCode): ?Notarize
{
    return $this->createQueryBuilder('n')
    ->andWhere('n.paymentCode = :paymentCode')
     ->setParameter('paymentCode', $paymentCode)
     ->setMaxResults(1)
     ->getQuery()
     ->getOneOrNullResult();
 ;

}



public function findByCustomerClosestDate(Customer $customer): ?Notarize
{
    return $this->createQueryBuilder('n')
        ->andWhere('n.customer = :customer')
        ->setParameter('customer', $customer)
        ->orderBy('n.NotarizeDate', 'ASC')
        ->setMaxResults(1)
        ->getQuery()
        ->getOneOrNullResult();
}

public function findForchecking($person,$numberId,$passport): ?Notarize
{
    return $this->createQueryBuilder('n')
        ->andWhere('n.person = :person')
        ->andWhere('n.numberId = :numberId')
        ->andWhere('n.passport = :passport')
        ->andWhere('n.type = 1')
        ->setParameter('person', $person)
        ->setParameter('numberId', $numberId)
        ->setParameter('passport', $passport)
        ->getQuery()
        ->getOneOrNullResult()
    ;
}

        public function findByCustomerAndNumberId($customer,$numberId): ?Notarize
        {
            return $this->createQueryBuilder('n')
                ->andWhere('n.numberId = :numberId')
                ->andWhere('n.customer = :customer')
                ->setParameter('numberId', $numberId)
                ->setParameter('customer', $customer)
                ->getQuery()
                ->getOneOrNullResult()
            ;
        }

}


