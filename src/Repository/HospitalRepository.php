<?php

namespace App\Repository;

use App\Entity\Hospital;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\HospitalRepository;

/**
 * @method Hospital|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hospital|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hospital[]    findAll()
 * @method Hospital[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HospitalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Hospital::class);
    }

    // /**
    //  * @return Hospital[] Returns an array of Hospital objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Hospital
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function setData(HospitalRepository $hospitalRepository){
        $hospitals = $hospitalRepository->findAll();

        // $counter = 0;
        // $months = [];

        foreach ($hospitals as $key => $bigHospital) {
            $date = $bigHospital->getDateRecord();
            $month = intval($date->format("m"));

            // array_push($weeks, (int)$date->format('W'));
            $key = new Hospital();
            $key
            ->setMonthRecord($month);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($key);
            $entityManager->flush();
            // $counter++;
        }
    }
}
