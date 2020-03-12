<?php

namespace App\Controller;

use App\Entity\Matieres;
use App\Entity\Notes;
use App\Form\MatiereAddType;
use App\Form\MatiereUptadeType;
use App\Form\NoteAddType;
use App\Repository\MatieresRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
  /**
   * @Route("/", name="home")
   */
  public function index(Request $request, EntityManagerInterface $entityManager)
  {

    $matiere = new Matieres();

    $matiereRepository = $this->getDoctrine()
      ->getRepository(Matieres::class)
      ->findAll();

    $form = $this->createForm(MatiereAddType::class, $matiere);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

      $matiere = $form->getData();

      $entityManager->persist($matiere);
      $entityManager->flush();

      $this->redirectToRoute('home');
    }

    return $this->render('main/index.html.twig', [
      'matieres' => $matiereRepository,
      'addMatiere' => $form->createView()

    ]);
  }

  /**
   * @Route("/matiere/fiche/{id}", name="ficheMatiere")
   */

  public function ficheMatiere($id, Request $request, EntityManagerInterface $entityManager)
  {


    $singleMatiere = $this->getDoctrine()
      ->getRepository(Matieres::class)
      ->find($id);

    $form = $this->createForm(MatiereAddType::class, $singleMatiere);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

      $singleMatiere = $form->getData();

      $entityManager->persist($singleMatiere);
      $entityManager->flush();

      $this->redirectToRoute('home');
    }

    return $this->render('main/matiere.html.twig', [
      'matieres' => $singleMatiere,
      'form' => $form->createView(),

    ]);

  }

  /**
   * @Route("/acceuil", name="note")
   */
  public function acceuil(Request $request, EntityManagerInterface $entityManager)
  {

    $note = new Notes();

    $noteRepository = $this->getDoctrine()
      ->getRepository(Notes::class)
      ->findAll();



    $form = $this->createForm(NoteAddType::class, $note);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

      $note = $form->getData();

      $entityManager->persist($note);
      $entityManager->flush();

      $this->redirectToRoute('home');
    }

    return $this->render('main/acceuil.html.twig', [
      'notes' => $noteRepository,
      'addNote' => $form->createView(),


    ]);


  }
}
