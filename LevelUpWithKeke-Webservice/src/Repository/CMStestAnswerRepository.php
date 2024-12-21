<?php

namespace App\Repository;

use App\Entity\CMStestAnswer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CMStestAnswer>
 *
 * @method CMStestAnswer|null find($id, $lockMode = null, $lockVersion = null)
 * @method CMStestAnswer|null findOneBy(array $criteria, array $orderBy = null)
 * @method CMStestAnswer[]    findAll()
 * @method CMStestAnswer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CMStestAnswerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CMStestAnswer::class);
    }

//    /**
//     * @return CMStestAnswer[] Returns an array of CMStestAnswer objects
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

//    public function findOneBySomeField($value): ?CMStestAnswer
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
