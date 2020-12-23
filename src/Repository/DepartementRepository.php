<?php

namespace App\Repository;

use App\Entity\Departement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\LabRepository;
use App\Repository\HospitalRepository;

/**
 * @method Departement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Departement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Departement[]    findAll()
 * @method Departement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DepartementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Departement::class);
    }

    // /**
    //  * @return Departement[] Returns an array of Departement objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Departement
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findByMonth(LabRepository $labRepository, HospitalRepository $hospitalRepository){

        $pre_recordBoth = array();
        $recordBoth = array();

        for ($i = 0; $i < 12; $i++) {    
            array_push($pre_recordBoth, [
                'hospitals' => $hospitalRepository->findBy(['month_record' => $i]),
                'labs' => $labRepository->findBy(['month_record' => $i])
            ]);
        }

        foreach ($pre_recordBoth as $key => $rec) {
            if (!empty($rec['hospitals']) || !empty($rec['labs'])) {
                array_push($recordBoth, [
                    'month' => $key,
                    'hospitals' => $rec['hospitals'],
                    'labs' => $rec['labs']
                ]);
            }
        }

        return $recordBoth;
    }
}
