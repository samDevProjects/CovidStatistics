<?php

namespace App\Controller;

use App\Entity\Record;
use App\Entity\Hospital;
use App\Form\RecordType;
use App\Repository\RecordRepository;
use App\Repository\LabRepository;
use App\Repository\HospitalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/record")
 */
class RecordController extends AbstractController
{
    /**
     * @Route("/set", name="record_set", methods={"GET","POST"})
     */
    public function setRecord(LabRepository $labRepository, HospitalRepository $hospitalRepository): Response
    {
        $pre_recordBoth = array();
        $recordBoth = array();

        for ($i = 0; $i < 52; $i++) {    
            array_push($pre_recordBoth, [
                'hospitals' => $hospitalRepository->findBy(['week_record' => $i]),
                'labs' => $labRepository->findBy(['week_record' => $i])
            ]);
        }

        foreach ($pre_recordBoth as $key => $rec) {
            if (!empty($rec['hospitals'])) {
                
                array_push($recordBoth, [
                    'week_record' => $key,
                    'hospitals' => $rec['hospitals'],
                    'labs' => $rec['labs']
                ]);
            }
        }

        // foreach ($rec['hospitals'] as $hospital) {
        //     $records->addHospital($hospital);
        // }

        // foreach ($recordBoth as $key => $rec) {
        //     $record = new Record();
        //     $record
        //     ->setWeekRecord($rec['week_record'])
        //     ->setHospital($rec['hospitals'])
        //     ->setLab($rec['labs']);
        //     $entityManager = $this->getDoctrine()->getManager();
        //     $entityManager->persist($record);
        //     $entityManager->flush();
        // }

        return $this->render('departement/set.html.twig', [
                'response' => dump($recordBoth),
        ]);
    }


    /**
     * @Route("/", name="record_index", methods={"GET"})
     */
    public function index(RecordRepository $recordRepository): Response
    {
        $records = $recordRepository->findAll();
        $records_json = json_encode($records);
        dump($records);

        return $this->render('record/index.html.twig', [
            'records' => $recordRepository->findBy([], ['week_record' => 'ASC']),
        ]);
    }

    /**
     * @Route("/new", name="record_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $record = new Record();
        $form = $this->createForm(RecordType::class, $record);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($record);
            $entityManager->flush();

            return $this->redirectToRoute('record_index');
        }

        return $this->render('record/new.html.twig', [
            'record' => $record,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="record_show", methods={"GET"})
     */
    public function show(Record $record): Response
    {
        dump($record->getHospital());
        return $this->render('record/show.html.twig', [
            'record' => $record,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="record_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Record $record): Response
    {
        $form = $this->createForm(RecordType::class, $record);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('record_index');
        }

        return $this->render('record/edit.html.twig', [
            'record' => $record,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="record_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Record $record): Response
    {
        if ($this->isCsrfTokenValid('delete'.$record->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($record);
            $entityManager->flush();
        }

        return $this->redirectToRoute('record_index');
    }
    // I need a controller that calculates the cases of the week
    
}
