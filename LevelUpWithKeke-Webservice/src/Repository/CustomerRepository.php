<?php

namespace App\Repository;

use App\Entity\Customer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Customer>
 *
 * @method Customer|null find($id, $lockMode = null, $lockVersion = null)
 * @method Customer|null findOneBy(array $criteria, array $orderBy = null)
 * @method Customer[]    findAll()
 * @method Customer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Customer::class);
    }

//    /**
//     * @return Customer[] Returns an array of Customer objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Customer
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

public function findByEmail(string $email): ?Customer
{

    return $this->createQueryBuilder('c')
             ->orWhere('c.email = :email')
             ->andWhere('c.signedUp = TRUE')
        ->setParameter('email', $email)
       ->getQuery()
       ->getOneOrNullResult();
}

public function findByEmailOrLoginSubscribe(string $login, string $email): ?Customer
{

    return $this->createQueryBuilder('c')
             ->orWhere('c.login = :login')
             ->orWhere('c.email = :email')
             ->setMaxResults(1)
        ->setParameter('login', $login)
        ->setParameter('email', $email)
       ->getQuery()
       ->getOneOrNullResult();
}


public function findByEmailOrLogin(string $login, string $email): ?Customer
{

    return $this->createQueryBuilder('c')
             ->orWhere('c.login = :login')
             ->orWhere('c.email = :email')
             ->andWhere('c.signedUp = TRUE')
        ->setParameter('login', $login)
        ->setParameter('email', $email)
       ->getQuery()
       ->getOneOrNullResult();
}


public function findByEmailAndPassword(string $password, string $email): ?Customer
{

    return $this->createQueryBuilder('c')
             ->andWhere('c.password = :password')
             ->andWhere('c.email = :email')
             ->andWhere('c.state IS NOT NULL')
             ->andWhere('c.signedUp = TRUE')
        ->setParameter('password', $password)
        ->setParameter('email', $email)
       ->getQuery()
       ->getOneOrNullResult();
}



public function findByLoginAndPassword(string $password, string $login): ?Customer
{

    return $this->createQueryBuilder('c')
             ->andWhere('c.password = :password')
             ->andWhere('c.login = :login')
             ->andWhere('c.state IS NOT NULL')
             ->andWhere('c.signedUp = TRUE')
        ->setParameter('password', $password)
        ->setParameter('login', $login)
       ->getQuery()
       ->getOneOrNullResult();
}


public function findByActivationCode(string $code): ?Customer
{

    return $this->createQueryBuilder('c')
             ->andWhere('c.activationCode = :code')
        ->setParameter(':code', $code)
       ->getQuery()
       ->getOneOrNullResult();
}


public function findByTempCode(string $code): ?Customer
{

    return $this->createQueryBuilder('c')
             ->andWhere('c.tempCode = :tempcode')
        ->setParameter(':tempcode', $code)
       ->getQuery()
       ->getOneOrNullResult();
}


public function findByRecoverCode(string $code): ?Customer
{

    return $this->createQueryBuilder('c')
             ->andWhere('c.recoverCode = :recoverCode')
        ->setParameter(':recoverCode', $code)
       ->getQuery()
       ->getOneOrNullResult();
}



public function findByFilter($proprety,$value): array
{
    return $this->createQueryBuilder('c')
        ->andWhere('c.'.$proprety.' like :prop')
         ->setParameter('prop', "%".$value."%")
        ->orderBy('c.id', 'ASC')
        ->getQuery()
        ->getResult()
    ;
 }




}
