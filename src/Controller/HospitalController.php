<?php

namespace App\Controller;

use App\Entity\Hospital;
use App\Form\HospitalType;
use App\Repository\HospitalRepository;
use App\Repository\DepartementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpClient\HttpClient;

/**
 * @Route("/hospital")
 */
class HospitalController extends AbstractController
{

    public function getAddress($lat, $lon){
        $client = HttpClient::create();
        $response = $client->request('GET', 'https://nominatim.openstreetmap.org/reverse?lat='.$lat.'&lon='.$lon.'&format=json');
        $all = $response->toArray();
        $hospitalAddress = [];
        $hospitalAddress = [
            'address' => $all['display_name'],
            'city' => empty($all['address']['municipality']) ? '' : $all['address']['municipality'],
            'hos_name' => empty($all['address']['village']) ? '' : $all['address']['village']
        ];
        return $hospitalAddress;
    }
    /**
     * @Route("/set", name="hospital_set", methods={"GET","POST"})
     */
    public function setHospital(HospitalRepository $hospitalRepository, DepartementRepository $departementRepository): Response
    {
        // $response = file_get_contents("C:\wamp64\www\plm_formation/test_project\public\json\hospital_results.json", "r");
        // $hospitals = json_decode($response);
        // $bigHospitals = array();

        // $fp = fopen('C:\wamp64\www\plm_formation/test_project\public\json\some_hospital_results.json', 'w');

        // for ($i = 0; $i < 2000; $i++) {
        //     if(array_key_exists('fields', $hospitals[$i])) {
        //         if(property_exists($hospitals[$i]->fields, 'day_hosp_new')) {
        //             array_push($bigHospitals, [
        //                 'departement_number' => $hospitals[$i]->fields->dep_code,
        //                 'dep_name' => $hospitals[$i]->fields->nom_dep_min,
        //                 'cases_number' => $hospitals[$i]->fields->day_hosp_new,
        //                 'cured_number' => $hospitals[$i]->fields->day_out_new,
        //                 'deaths_number' => $hospitals[$i]->fields->day_death_new,
        //                 'intcare_number' => $hospitals[$i]->fields->day_intcare_new,
        //                 'latitude' => $hospitals[$i]->fields->geo_point_2d[0],
        //                 'longitude' => $hospitals[$i]->fields->geo_point_2d[1],
        //                 'date_record' => $hospitals[$i]->fields->date,
        //             ]);
        //         }
        //     }
        // }

        // fwrite($fp, json_encode($bigHospitals));
        // fclose($fp);

        // $h = $this->getAddress(43.2555265161, -0.759231599387);



        // $response = file_get_contents("C:\wamp64\www\plm_formation/test_project\public\json\some_hospital_results.json", "r");
        // $hospitals = json_decode($response);
        // $newHospitals = array();

        // $fp = fopen('C:\wamp64\www\plm_formation/test_project\public\json\hospitals_address.json', 'a+');

        // for ($i = 600; $i < 633; $i++) {
        //     $hosAddress = $this->getAddress($hospitals[$i]->latitude, $hospitals[$i]->longitude);
        //     array_push($newHospitals, [
        //         'address' => $hosAddress['address'],
        //         'city' => $hosAddress['city'],
        //         'hos_name' => $hosAddress['hos_name']
        //     ]);
        // }

        // fwrite($fp, json_encode($newHospitals));
        // fclose($fp);


        // $response1 = file_get_contents("C:\wamp64\www\plm_formation/test_project\public\json\hospitals_address.json", "r");
        // $hosAddresses = json_decode($response1);
        // $response = file_get_contents("C:\wamp64\www\plm_formation/test_project\public\json\some_hospital_results.json", "r");
        // $hospitals = json_decode($response);
        // $weeks = array();
        // $counter = 0;


        
        // foreach ($hospitals as $key => $bigHospital) {
            
        //     $departement = $departementRepository->findBy([
        //         'departement_number' => $bigHospital->departement_number,
        //     ]);

        //     $date = new \DateTime($bigHospital->date_record);
        //     array_push($weeks, (int)$date->format('W'));

        //     $date2 = new \DateTime($bigHospital->date_record);
        //     $month = intval($date2->format("m"));

        //     $key = new Hospital();
        //     $key
        //     ->setDepartement($departement[0])
        //     ->setDepName($bigHospital->dep_name)
        //     ->setCasesNumber($bigHospital->cases_number)
        //     ->setCuredNumber($bigHospital->cured_number)
        //     ->setDeathsNumber($bigHospital->deaths_number)
        //     ->setLatitude($bigHospital->latitude)
        //     ->setLongitude($bigHospital->longitude)
        //     ->setIntcare($bigHospital->intcare_number)
        //     ->setDateRecord($date)
        //     ->setWeekRecord($weeks[$counter])
        //     ->setMonthRecord($month)
        //     ->setHospitalName($hosAddresses[$counter]->hos_name)
        //     ->setAddress($hosAddresses[$counter]->address)
        //     ->setCityName($hosAddresses[$counter]->city);

        //     $entityManager = $this->getDoctrine()->getManager();
        //     $entityManager->persist($key);
        //     $entityManager->flush();
        //     $counter++;
        // }
        // $h = $this->getAddress(43.2555265161, -0.759231599387);

        // dump($hosAddresses[0]);

        return $this->render('departement/set.html.twig', [
                'response' => 'good',
        ]);
    }


    /**
     * @Route("/", name="hospital_index", methods={"GET"})
     */
    public function index(Request $request, HospitalRepository $hospitalRepository, PaginatorInterface $paginator): Response
    {
        $hospitals = $paginator->paginate(
            $hospitalRepository->findAll(),
            $request->query->getInt('page', 1),
            6
        );

        return $this->render('hospital/index.html.twig', [
            'hospitals' => $hospitals,
        ]);
    }

    /**
     * @Route("/new", name="hospital_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $hospital = new Hospital();
        $form = $this->createForm(HospitalType::class, $hospital);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($hospital);
            $entityManager->flush();

            return $this->redirectToRoute('hospital_index');
        }

        return $this->render('hospital/new.html.twig', [
            'hospital' => $hospital,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="hospital_show", methods={"GET"})
     */
    public function show(Hospital $hospital): Response
    {
        return $this->render('hospital/show.html.twig', [
            'hospital' => $hospital,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="hospital_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Hospital $hospital): Response
    {
        $form = $this->createForm(HospitalType::class, $hospital);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('hospital_index');
        }

        return $this->render('hospital/edit.html.twig', [
            'hospital' => $hospital,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="hospital_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Hospital $hospital): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hospital->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($hospital);
            $entityManager->flush();
        }

        return $this->redirectToRoute('hospital_index');
    }
}
