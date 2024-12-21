<?php

namespace App\Repository;

use App\Entity\CMSitemSettings;
use App\Entity\CMSPage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CMSitemSettings>
 *
 * @method CMSitemSettings|null find($id, $lockMode = null, $lockVersion = null)
 * @method CMSitemSettings|null findOneBy(array $criteria, array $orderBy = null)
 * @method CMSitemSettings[]    findAll()
 * @method CMSitemSettings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CMSitemSettingsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CMSitemSettings::class);
    }

//    /**
//     * @return CMSitemSettings[] Returns an array of CMSitemSettings objects
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

//    public function findOneBySomeField($value): ?CMSitemSettings
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

            public function findItemsForHomepage(): array
            {
                

                    return $this->createQueryBuilder('c')
                    ->andWhere('c.home = true')
                    ->orderBy('c.position', 'ASC')
                    ->getQuery()
                    ->getResult()
                    ;

            }

            public function findItemBannerHomepage(): ?CMSitemSettings
            {
                

                    return $this->createQueryBuilder('c')
                    ->andWhere('c.item = 5')
                    ->orderBy('c.position', 'ASC')
                     ->getQuery()
                    ->getOneOrNullResult()
                    ;

            }

            public function findByPage(CMSPage $page): array
            {
                
                    return $this->createQueryBuilder('c')
                    ->andWhere('c.page = :page')
                    ->setParameter('page', $page)
                    ->orderBy('c.position', 'ASC')
                    ->getQuery()
                    ->getResult()
                    ;

            }

            

            public function findItemImageTextHomepage(): ?CMSitemSettings
            {
                

                    return $this->createQueryBuilder('c')
                    ->andWhere('c.item = 4')
                    ->orderBy('c.position', 'ASC')
                     ->getQuery()
                    ->getOneOrNullResult()
                    ;

            }


            public function findItemChiefMessageHomepage(): ?CMSitemSettings
            {
                
                    return $this->createQueryBuilder('c')
                    ->andWhere('c.item = 11')
                    ->orderBy('c.position', 'ASC')
                     ->getQuery()
                    ->getOneOrNullResult()
                    ;

            }



}
