<?php

namespace App\Repository;

use App\Entity\Passport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Passport>
 *
 * @method Passport|null find($id, $lockMode = null, $lockVersion = null)
 * @method Passport|null findOneBy(array $criteria, array $orderBy = null)
 * @method Passport[]    findAll()
 * @method Passport[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PassportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Passport::class);
    }

//    /**
//     * @return Passport[] Returns an array of Passport objects
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

//    public function findOneBySomeField($value): ?Passport
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

public function findByNumberId($numberid): ?Passport
{

                    return $this->createQueryBuilder('p')
                    ->andWhere('p.numberId = :numberId')
                    ->setParameter('numberId', $numberid)
                    ->getQuery()
                    ->getOneOrNullResult()
                    ;

            }

            public function findByPersonAndNumberId($person,$numberId): array
            {
        return $this->createQueryBuilder('p')
            ->andWhere('p.person = :person')
            ->andWhere('p.numberId = :numberId')
            ->setParameter('person', $person)
            ->setParameter('numberId', $numberId)
              ->orderBy('p.id', 'ASC')
              ->getQuery()
               ->getResult()
           ;

            }
}
