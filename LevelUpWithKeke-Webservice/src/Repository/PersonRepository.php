<?php

namespace App\Repository;

use App\Entity\Person;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Person>
 *
 * @method Person|null find($id, $lockMode = null, $lockVersion = null)
 * @method Person|null findOneBy(array $criteria, array $orderBy = null)
 * @method Person[]    findAll()
 * @method Person[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Person::class);
    }

//    /**
//     * @return Person[] Returns an array of Person objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Person
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }



   public function findByCustomer($customer): ?Person
    {
       return $this->createQueryBuilder('p')
           ->andWhere('p.customer = :customer')
            ->setParameter('customer', $customer)
           ->getQuery()
           ->getOneOrNullResult()
       ;
    }

    public function findByInfos($email,$firstname,$surname,$telephone): ?Person
    {
       return $this->createQueryBuilder('p')
           ->andWhere('p.firstname = :firstname')
           ->andWhere('p.surname = :surname')
           ->andWhere('p.telephone = :telephone')
           ->orWhere('p.email = :email')
            ->setParameter('firstname', $firstname)
            ->setParameter('surname', $surname)
            ->setParameter('telephone', $telephone)
            ->setParameter('email', $email)
           ->getQuery()
           ->getOneOrNullResult()
       ;
    }

    public function findByEmailAndTelephone($email,$telephone): ?Person
    {
         return $this->createQueryBuilder('p')
             ->andWhere('p.email = :email')
             ->andWhere('p.telephone = :telephone')
             ->setParameter('email', $email)
             ->setParameter('telephone', $telephone)
            ->getQuery()
            ->getOneOrNullResult()
         ;
     }


    
    
}
