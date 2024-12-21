<?php

namespace App\Repository;

use App\Entity\CMSUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CMSUser>
 *
 * @method CMSUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method CMSUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method CMSUser[]    findAll()
 * @method CMSUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CMSUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CMSUser::class);
    }

//    /**
//     * @return CMSUser[] Returns an array of CMSUser objects
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

//    public function findOneBySomeField($value): ?CMSUser
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

public function findByEmailOrLogin(string $login, string $email): ?CMSUser
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


public function findByEmailAndPassword(string $password, string $email): ?CMSUser
{

    return $this->createQueryBuilder('c')
             ->andWhere('c.password = :password')
             ->andWhere('c.email = :email')
             ->andWhere('c.state IS NOT NULL')
        ->setParameter('password', $password)
        ->setParameter('email', $email)
       ->getQuery()
       ->getOneOrNullResult();
}



public function findByLoginAndPassword(string $password, string $login): ?CMSUser
{

    return $this->createQueryBuilder('c')
             ->andWhere('c.password = :password')
             ->andWhere('c.login = :login')
             ->andWhere('c.state IS NOT NULL')
        ->setParameter('password', $password)
        ->setParameter('login', $login)
       ->getQuery()
       ->getOneOrNullResult();
}



}
