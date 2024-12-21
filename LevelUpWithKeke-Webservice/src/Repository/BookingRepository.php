<?php

namespace App\Repository;

use App\Entity\Booking;
use App\Entity\Customer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Booking>
 *
 * @method Booking|null find($id, $lockMode = null, $lockVersion = null)
 * @method Booking|null findOneBy(array $criteria, array $orderBy = null)
 * @method Booking[]    findAll()
 * @method Booking[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Booking::class);
    }

//    /**
//     * @return Booking[] Returns an array of Booking objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Booking
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

public function findByCustomer($customer): array
{
   return $this->createQueryBuilder('b')
       ->andWhere('b.customer = :customer')
        ->setParameter('customer', $customer)
       ->orderBy('b.id', 'ASC')
        ->getQuery()
       ->getResult()
    ;
}


public function findForYear($year): array
{
   return $this->createQueryBuilder('b')
   ->andwhere('YEAR(b.bookingDate) = :year')
        ->setParameter('year', $year)
       ->orderBy('b.id', 'ASC')
        ->getQuery()
       ->getResult()
    ;
}

public function findByCancelledForYear($year): array
{
   return $this->createQueryBuilder('b')
   ->andwhere('YEAR(b.bookingDate) = :year')
   ->andwhere('b.cancelled = TRUE')
        ->setParameter('year', $year)
       ->orderBy('b.id', 'ASC')
        ->getQuery()
       ->getResult()
    ;
}

public function findByCurrentForYear($year): array
{
   return $this->createQueryBuilder('b')
   ->andwhere('YEAR(b.bookingDate) = :year')
   ->andwhere('b.cancelled = FALSE')
   ->andwhere('b.paid = FALSE')
        ->setParameter('year', $year)
       ->orderBy('b.id', 'ASC')
        ->getQuery()
       ->getResult()
    ;
}


public function findByPaidForYear($year): array
{
   return $this->createQueryBuilder('b')
   ->andwhere('YEAR(b.bookingDate) = :year')
   ->andwhere('b.paid = TRUE')
        ->setParameter('year', $year)
       ->orderBy('b.id', 'ASC')
        ->getQuery()
       ->getResult()
    ;
}





public function findOneByCustomer($customer): ?Booking
{
   return $this->createQueryBuilder('b')
       ->andWhere('b.customer = :customer')
        ->setParameter('customer', $customer)
       ->orderBy('b.id', 'ASC')
        ->getQuery()
       ->getOneOrNullResult();
    
}



public function findByCustomerAndCurrent($customer,$today): array
{
   return $this->createQueryBuilder('b')
        ->andWhere('b.bookingDate >= :today')
       ->andWhere('b.customer = :customer')
       ->andWhere('b.paid = FALSE')
       ->andWhere('b.cancelled = FALSE')
        ->setParameter('customer', $customer)
        ->setParameter('today', $today)
       ->orderBy('b.id', 'ASC')
        ->getQuery()
       ->getResult()
    ;
}

public function findByCustomerAndCancelled($customer): array
{
   return $this->createQueryBuilder('b')
       ->andWhere('b.customer = :customer')
       ->andWhere('b.cancelled = TRUE')
        ->setParameter('customer', $customer)
       ->orderBy('b.id', 'ASC')
        ->getQuery()
       ->getResult()
    ;
}

public function findByCustomerAndPaid($customer): array
{
   return $this->createQueryBuilder('b')
       ->andWhere('b.customer = :customer')
       ->andWhere('b.paid = TRUE')
        ->setParameter('customer', $customer)
       ->orderBy('b.id', 'ASC')
        ->getQuery()
       ->getResult()
    ;
}


public function findByPast($today,$decision): array
{
   return $this->createQueryBuilder('b')
       ->andWhere('b.bookingDate < :today')
       ->andWhere('b.decision = :decision')
       ->andWhere('b.confirmation = TRUE')
        ->setParameter('today', $today)
        ->setParameter('decision', $decision)
       ->orderBy('b.id', 'ASC')
        ->getQuery()
       ->getResult()
    ;
}


public function findByFilter($proprety,$value,$decision): array
{

    return $this->createQueryBuilder('b')
    ->join('b.customer', 'cus')
    ->andWhere($proprety.' like :prop')
    ->andWhere('b.decision = :decision')
     ->setParameter('prop', "%".$value."%")
     ->setParameter('decision', $decision)
    ->orderBy('b.id', 'ASC')
    ->getQuery()
    ->getResult()
;

}


public function findByPaymentCode($paymentCode): ?Booking
{
    return $this->createQueryBuilder('b')
    ->andWhere('b.paymentCode = :paymentCode')
     ->setParameter('paymentCode', $paymentCode)
     ->setMaxResults(1)
     ->getQuery()
     ->getOneOrNullResult();
 ;

}



public function findByCustomerClosestDate(Customer $customer , $today ): ?Booking
{
    return $this->createQueryBuilder('b')
        ->andWhere('b.customer = :customer')
        ->andWhere('b.bookingDate >= :today')
        ->andWhere('b.cancelled = FALSE ')
        ->setParameter('customer', $customer)
        ->setParameter('today', $today)
        ->orderBy('b.bookingDate', 'ASC')
        ->setMaxResults(1)
        ->getQuery()
        ->getOneOrNullResult();
}

}
