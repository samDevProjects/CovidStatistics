<?php

namespace App\Controller;

use App\Entity\Records;
use App\Form\RecordsType;
use App\Repository\RecordsRepository;
use App\Repository\LabRepository;
use App\Repository\HospitalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/records")
 */
class RecordsController extends AbstractController
{
    /**
     * @Route("/set", name="recs_set", methods={"GET","POST"})
     */
    public function setRecords(RecordsRepository $recordsRepository, LabRepository $labRepository, HospitalRepository $hospitalRepository): Response
    {
        // $pre_recordBoth = array();
        // $recordBoth = array();

        // for ($i = 0; $i < 52; $i++) {    
        //     array_push($pre_recordBoth, [
        //         'hospitals' => $hospitalRepository->findBy(['week_record' => $i]),
        //         'labs' => $labRepository->findBy(['week_record' => $i])
        //     ]);
        // }

        // foreach ($pre_recordBoth as $key => $rec) {
        //     if (!empty($rec['hospitals']) || !empty($rec['labs'])) {
        //         array_push($recordBoth, [
        //             'week_record' => $key,
        //             'hospitals' => $rec['hospitals'],
        //             'labs' => $rec['labs']
        //         ]);
        //     }
        // }

        // foreach ($recordBoth as $key => $rec) {

        //     $records = new Records();
        //     $records
        //     ->setWeekRecord($rec['week_record']);

        //     foreach ($rec['hospitals'] as $hospital) {
        //             $records->addHospitalsRec($hospital);
        //     }

        //     foreach ($rec['labs'] as $lab) {
        //             $records->addLabsRec($lab);
        //     }

        //     $entityManager = $this->getDoctrine()->getManager();
        //     $entityManager->persist($records);
        //     $entityManager->flush();
        // }

        return $this->render('departement/set.html.twig', [
                'response' => dump($pre_recordBoth),
        ]);
    }

    /**
     * @Route("/table", name="records_tab", methods={"GET"})
     */
    public function index_table(Request $request, RecordsRepository $recordsRepository, PaginatorInterface $paginator): Response
    {
        $data = $recordsRepository->findBy(
            [],
            ['week_record' => 'desc']
        );

        $records = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            6
        );

        return $this->render('records/index.html.twig', [
            'records' => $records,
        ]);
    }

    /**
     * @Route("/all", name="records_users_index", methods={"GET"})
     */
    public function index_users(Request $request, RecordsRepository $recordsRepository, PaginatorInterface $paginator): Response
    {
        // $data = $recordsRepository->findBy(
        //     [],
        //     ['week_record' => 'asc']
        // );

        return $this->render('records/all.html.twig', [
            'records' => $recordsRepository->findAll(),
            // 'records' => $records,
        ]);
    }

    /**
     * @Route("/new", name="records_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $record = new Records();
        $form = $this->createForm(RecordsType::class, $record);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($record);
            $entityManager->flush();

            return $this->redirectToRoute('records_index');
        }

        return $this->render('records/new.html.twig', [
            'record' => $record,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/table/{id}", name="records_show", methods={"GET"})
     */
    public function show(Request $request, Records $record, PaginatorInterface $paginator): Response
    {
        $hospitals = $record->getHospitalsRec();
        $labs = $record->getLabsRec();

        $hospital_departements = [];
        $lab_departements = [];

        foreach ($hospitals as $key => $hospital) {
            if (!in_array($hospital->getDepName(), $hospital_departements)) {
                array_push($hospital_departements, $hospital->getDepName());
            }
        }
        foreach ($labs as $key => $lab) {
            if (!in_array($lab->getDepName(), $lab_departements)) {
                array_push($lab_departements, $lab->getDepName());
            }
        }

        $pre_departements = array_merge($hospital_departements, $lab_departements);
        $departements = [];
        
        foreach ($pre_departements as $key => $val) {
            if (!in_array($val, $departements)) {
                array_push($departements, $val);
            }
        }

        return $this->render('records/show.html.twig', [
            'record' => $record,
            'departments' => $departements,
        ]);
    }

    /**
     * @Route("/all/{week_record}", name="recordsByWeek_show", methods={"GET"})
     */
    public function showByWeek(Records $record): Response
    {
        $hospitals = $record->getHospitalsRec();
        $labs = $record->getLabsRec();

        $hospital_departements = [];
        $lab_departements = [];

        foreach ($hospitals as $key => $hospital) {
            if (!in_array($hospital->getDepName(), $hospital_departements)) {
                array_push($hospital_departements, $hospital->getDepName());
            }
        }
        foreach ($labs as $key => $lab) {
            if (!in_array($lab->getDepName(), $lab_departements)) {
                array_push($lab_departements, $lab->getDepName());
            }
        }

        $pre_departements = array_merge($hospital_departements, $lab_departements);
        $departements = [];
        
        foreach ($pre_departements as $key => $val) {
            if (!in_array($val, $departements)) {
                array_push($departements, $val);
            }
        }
        
        return $this->render('records/show_byWeek.html.twig', [
            'record' => $record,
            'departments' => $departements,
        ]);
    }


    /**
     * @Route("/{id}/edit", name="records_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Records $record): Response
    {
        $form = $this->createForm(RecordsType::class, $record);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('records_index');
        }

        return $this->render('records/edit.html.twig', [
            'record' => $record,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="records_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Records $record): Response
    {
        if ($this->isCsrfTokenValid('delete'.$record->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($record);
            $entityManager->flush();
        }

        return $this->redirectToRoute('records_index');
    }
}
