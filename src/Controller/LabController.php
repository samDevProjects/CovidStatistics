<?php

namespace App\Controller;

use App\Entity\Lab;
use App\Entity\Departement;
use App\Form\LabType;
use App\Repository\LabRepository;
use App\Repository\DepartementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpClient\HttpClient;

/**
 * @Route("/lab")
 */
class LabController extends AbstractController
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
     * @Route("/set", name="lab_set", methods={"GET","POST"})
     */
    
    public function setLab(DepartementRepository $departementRepository): Response
    {
        // $response = file_get_contents("C:\wamp64\www\plm_formation/test_project\public\json\lab_tests.json", "r");
        // $labs = json_decode($response);
        // $bigLabs = array();

        // $fp = fopen('C:\wamp64\www\plm_formation/test_project\public\json\some_lab_results.json', 'w');
        
        // for ($i = 0; $i < 800; $i++) {
        //     if(array_key_exists('fields', $labs[$i])) {
        //         if($labs[$i]->fields->age_label != '> 74') {
        //             array_push($bigLabs, [
        //                 'departement_number' => $labs[$i]->fields->dep_code,
        //                 'dep_name' => $labs[$i]->fields->nom_dep_min,
        //                 'tested_number' => $labs[$i]->fields->nb_test,
        //                 'cases_number' => $labs[$i]->fields->nb_pos,
        //                 'negatif_number' => $labs[$i]->fields->nb_neg,
        //                 'latitude' => $labs[$i]->fields->geo_point_2d[0],
        //                 'longitude' => $labs[$i]->fields->geo_point_2d[1],
        //                 'date_record' => $labs[$i]->fields->date,
        //             ]);
        //         }
        //     }
        // }
        
        // fwrite($fp, json_encode($bigLabs));
        // fclose($fp);

        

        // $response = file_get_contents("C:\wamp64\www\plm_formation/test_project\public\json\some_lab_results.json", "r");
        // $labs = json_decode($response);
        // $newLabs = array();
        
        // $fp = fopen('C:\wamp64\www\plm_formation/test_project\public\json\labs_address.json', 'a+');

        // for ($i = 750; $i < 800; $i++) {
        //     $labAddress = $this->getAddress($labs[$i]->latitude, $labs[$i]->longitude);
        //     array_push($newLabs, [
        //         'address' => $labAddress['address'],
        //         'city' => $labAddress['city'],
        //         'lab_name' => $labAddress['hos_name']
        //     ]);
        // }

        // fwrite($fp, json_encode($newLabs));
        // fclose($fp);



        // $response1 = file_get_contents("C:\wamp64\www\plm_formation/test_project\public\json\labs_address.json", "r");
        // $labAddresses = json_decode($response1);
        // $response = file_get_contents("C:\wamp64\www\plm_formation/test_project\public\json\some_lab_results.json", "r");
        // $bigLabs = json_decode($response);

        // dump($labAddresses);

        // $weeks = array();
        // $counter = 0;

        // foreach ($bigLabs as $key => $bigLab) {
        //     $departement = $departementRepository->findBy([
        //         'departement_number' => $bigLab->departement_number,
        //     ]);
        //     $date = new \DateTime($bigLab->date_record);
        //     array_push($weeks, (int)$date->format('W'));
            
        //     $date2 = new \DateTime($bigLab->date_record);
        //     $month = intval($date2->format("m"));
            
        //     $key = new Lab();
        //     $key
        //     ->setDepartement($departement[0])
        //     ->setDepName($bigLab->dep_name)
        //     ->setTestedNumber($bigLab->tested_number)
        //     ->setCasesNumber($bigLab->cases_number)
        //     ->setLatitude($bigLab->latitude)
        //     ->setLongitude($bigLab->longitude)
        //     ->setNegatifNumber($bigLab->negatif_number)
        //     ->setDateRecord($date)
        //     ->setWeekRecord($weeks[$counter])
        //     ->setMonthRecord($month)
        //     ->setLabName($labAddresses[$counter]->lab_name)
        //     ->setAddress($labAddresses[$counter]->address)
        //     ->setCityName($labAddresses[$counter]->city);

        //     $entityManager = $this->getDoctrine()->getManager();
        //     $entityManager->persist($key);
        //     $entityManager->flush();
        //     $counter++;
        // }
        

        return $this->render('departement/set.html.twig', [
                'response' => '$bigLabs',
        ]);
    }
    
    /**
     * @Route("/", name="lab_index", methods={"GET"})
     */
    public function index(Request $request, LabRepository $labRepository, PaginatorInterface $paginator): Response
    {
        $labs = $paginator->paginate(
            $labRepository->findAll(),
            $request->query->getInt('page', 1),
            6
        );
        return $this->render('lab/index.html.twig', [
            'labs' => $labs,
        ]);
    }

    /**
     * @Route("/new", name="lab_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $lab = new Lab();
        $form = $this->createForm(LabType::class, $lab);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($lab);
            $entityManager->flush();

            return $this->redirectToRoute('lab_index');
        }

        return $this->render('lab/new.html.twig', [
            'lab' => $lab,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lab_show", methods={"GET"})
     */
    public function show(Lab $lab): Response
    {
        return $this->render('lab/show.html.twig', [
            'lab' => $lab,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="lab_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Lab $lab): Response
    {
        $form = $this->createForm(LabType::class, $lab);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lab_index');
        }

        return $this->render('lab/edit.html.twig', [
            'lab' => $lab,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lab_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Lab $lab): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lab->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($lab);
            $entityManager->flush();
        }

        return $this->redirectToRoute('lab_index');
    }
}
