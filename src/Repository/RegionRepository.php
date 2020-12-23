<?php

namespace App\Repository;

use App\Entity\Region;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Region|null find($id, $lockMode = null, $lockVersion = null)
 * @method Region|null findOneBy(array $criteria, array $orderBy = null)
 * @method Region[]    findAll()
 * @method Region[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RegionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Region::class);
    }

    // /**
    //  * @return Region[] Returns an array of Region objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Region
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    //     public function findByMonth(LabRepository $labRepository, HospitalRepository $hospitalRepository){

    //     $pre_recordBoth = array();
    //     $recordBoth = array();

    //     for ($i = 0; $i < 12; $i++) {    
    //         array_push($pre_recordBoth, [
    //             'hospitals' => $hospitalRepository->findBy(['month_record' => $i]),
    //             'labs' => $labRepository->findBy(['month_record' => $i])
    //         ]);
    //     }

    //     foreach ($pre_recordBoth as $key => $rec) {
    //         if (!empty($rec['hospitals']) || !empty($rec['labs'])) {
    //             array_push($recordBoth, [
    //                 'month' => $key,
    //                 'hospitals' => $rec['hospitals'],
    //                 'labs' => $rec['labs']
    //             ]);
    //         }
    //     }

    //     return $recordBoth;
    // }
}
