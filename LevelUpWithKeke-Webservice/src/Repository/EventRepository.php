<?php

namespace App\Repository;

use App\Entity\Event;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Event>
 *
 * @method Event|null find($id, $lockMode = null, $lockVersion = null)
 * @method Event|null findOneBy(array $criteria, array $orderBy = null)
 * @method Event[]    findAll()
 * @method Event[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Event::class);
    }

//    /**
//     * @return Event[] Returns an array of Event objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Event
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    public function findByEventDate($date): ?Event
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.EventDate BETWEEN :date1 AND :date2 ')
            ->setParameter('date1', $date." 00:00:00")
            ->setParameter('date2', $date." 23:59:59")
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function findByTag($tag): ?Event
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.tag = :tag ')
            ->setParameter('tag', $tag)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function findByFilter($proprety,$value): array
{

    return $this->createQueryBuilder('b')
    ->join('b.customer', 'cus')
    ->andWhere($proprety.' like :prop')
     ->setParameter('prop', "%".$value."%")
    ->orderBy('b.id', 'ASC')
    ->getQuery()
    ->getResult()
;

}



}
