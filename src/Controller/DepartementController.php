<?php

namespace App\Controller;

use App\Entity\Departement;
use App\Form\DepartementType;
use App\Repository\DepartementRepository;
use App\Repository\RegionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use App\Repository\LabRepository;
use App\Repository\HospitalRepository;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/departement")
 */
class DepartementController extends AbstractController
{   
    /**
     * @Route("/set", name="departement_set", methods={"GET","POST"})
     */
    public function setDepartement(RegionRepository $regionRepository): Response
    {
        // $client = HttpClient::create();
        // $response = $client->request('GET', 'https://geo.api.gouv.fr/departements');
        // $keys = array();
        // $departements = $response->toArray();
        
        // foreach ($departements as $departement) {
        //     $theRegion = $regionRepository->findBy([
        //         'region_code' => $departement['codeRegion'],
        //     ]);

        //     $key = new Departement();
            
        //     $key
        //     ->setRegion($theRegion[0])
        //     ->setDepartmentName($departement['nom'])
        //     ->setDepartementNumber($departement['code']);

        //     $entityManager = $this->getDoctrine()->getManager();
        //     $entityManager->persist($key);
        //     $entityManager->flush();
        // }

        // dump($response);
        // return $this->render('departement/set.html.twig', [
        //         'response' => $departements,
        // ]);
    }

    /**
     * @Route("/", name="departement_index", methods={"GET"})
     */
    public function index(Request $request, DepartementRepository $departementRepository, PaginatorInterface $paginator): Response
    {
        $records = $paginator->paginate(
            $departementRepository->findAll(),
            $request->query->getInt('page', 1),
            6
        );
        
        return $this->render('departement/index.html.twig', [
            'departements' => $departementRepository->findAll(),
            'pagination' => $records,
        ]);
    }

    /**
     * @Route("/table", name="departement_table", methods={"GET"})
     */
    public function indexTable(Request $request, DepartementRepository $departementRepository, PaginatorInterface $paginator): Response
    {

        $records = $paginator->paginate(
            $departementRepository->findAll(),
            $request->query->getInt('page', 1),
            6
        );
        
        return $this->render('departement/index_table.html.twig', [
            'departements' => $records,
        ]);
    }

    /**
     * @Route("/new", name="departement_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $departement = new Departement();
        $form = $this->createForm(DepartementType::class, $departement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($departement);
            $entityManager->flush();

            return $this->redirectToRoute('departement_index');
        }

        return $this->render('departement/new.html.twig', [
            'departement' => $departement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="departement_show", methods={"GET"})
     */
    public function show(Departement $departement, DepartementRepository $departementRepository, LabRepository $labRepository, HospitalRepository $hospitalRepository): Response
    {

        // $pre_recordBoth = array();
        // $recordBoth = array();

        // for ($i = 0; $i < 12; $i++) {    
        //     array_push($pre_recordBoth, [
        //         'hospitals' => $hospitalRepository->findBy(['week_record' => $i]),
        //         'labs' => $labRepository->findBy(['week_record' => $i])
        //     ]);
        // }

        // foreach ($pre_recordBoth as $key => $rec) {
        //     if (!empty($rec['hospitals']) || !empty($rec['labs'])) {
        //         array_push($recordBoth, [
        //             'month' => $key,
        //             'hospitals' => $rec['hospitals'],
        //             'labs' => $rec['labs']
        //         ]);
        //     }
        // }

        $depByMonth = $departementRepository->findByMonth($labRepository, $hospitalRepository);
        // dump($dep);
        
        // $date = $departement->getHospitals()[0]->getDateRecord();
        // $d = $date->format("m");
        // dump($date);
        // dump($d);

        return $this->render('departement/show.html.twig', [
            'departement' => $departement,
            'depByMonth' => $depByMonth,
        ]);
    }

        /**
     * @Route("/table/{id}", name="show_table_detail", methods={"GET"})
     */
    public function showTable(Departement $departement, DepartementRepository $departementRepository, LabRepository $labRepository, HospitalRepository $hospitalRepository): Response
    {

        $depByMonth = $departementRepository->findByMonth($labRepository, $hospitalRepository);
        
        return $this->render('departement/table_detail.html.twig', [
            'departement' => $departement,
            'depByMonth' => $depByMonth,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="departement_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Departement $departement): Response
    {
        $form = $this->createForm(DepartementType::class, $departement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('departement_index');
        }

        return $this->render('departement/edit.html.twig', [
            'departement' => $departement,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="departement_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Departement $departement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$departement->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($departement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('departement_index');
    }
    
}
