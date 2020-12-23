<?php

namespace App\Controller;

use App\Entity\Departement;
use App\Entity\Hospital;
use App\Repository\DepartementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/dep/api")
 */
class DepApiController extends AbstractController
{
    /**
     * @Route("/all", name="dep_api")
     */
    public function index(DepartementRepository $departementRepository): Response
    {
        $departements = $departementRepository->findAll();
        $dep = [];

        foreach ($departements as $key => $departement) {
            array_push($dep, [
                $departement->getDepartmentName() => [
                    "longitude" => $departement->getHospitals()[0]->getLongitude(),
                    "latitude" => $departement->getHospitals()[0]->getLatitude(),
                    "href" => "{$departement->getId()}",
                    "tooltip" => [
                        "content" => $departement->getDepartmentName()
                    ]
                ],
                // "department-".$departement->getDepartementNumber() => [
                //     "tooltip" => [
                //         "content" => $departement->getDepartmentName()
                //     ]
                // ]
            ]);
        }

        return new JsonResponse($dep);
    }

    /**
     * @Route("/hospital/{id}", name="hos_api")
     */
    public function getHos(Departement $departement): Response
    {
        $hospitals = $departement->getHospitals();

        // dump($hospitals);
        return new JsonResponse($hospitals);
    }

}
