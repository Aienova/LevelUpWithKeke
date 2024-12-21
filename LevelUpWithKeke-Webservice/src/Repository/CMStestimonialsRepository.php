<?php

namespace App\Repository;

use App\Entity\CMStestimonials;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CMStestimonials>
 *
 * @method CMStestimonials|null find($id, $lockMode = null, $lockVersion = null)
 * @method CMStestimonials|null findOneBy(array $criteria, array $orderBy = null)
 * @method CMStestimonials[]    findAll()
 * @method CMStestimonials[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CMStestimonialsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CMStestimonials::class);
    }

//    /**
//     * @return CMStestimonials[] Returns an array of CMStestimonials objects
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

//    public function findOneBySomeField($value): ?CMStestimonials
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
