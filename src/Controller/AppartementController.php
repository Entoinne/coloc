<?php

namespace App\Controller;

use App\Entity\Appartement;
use App\Form\NewAppartementType;
use App\Repository\AppartementRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppartementController extends AbstractController
{
    #[Route('/appartement', name: 'app_appartement')]
    public function index(AppartementRepository $repo): Response
    {
        $appartements = $repo->findAll();
        return $this->render('appartement/index.html.twig', [
            'controller_name' => 'AppartementController',
            'appartements' => $appartements,
        ]);
    }

    #[Route('/mes_appartements/{owner}', name: 'owner_appartement')]
    public function ownerIndex(AppartementRepository $repo, Request $request, EntityManagerInterface $em): Response
    {
        $appartements = $em->getRepository(Appartement::class)->findBy(['Owner'=>$request->get('owner')]);
        return $this->render('appartement/index.html.twig', [
            'controller_name' => 'AppartementController',
            'appartements' => $appartements,
        ]);
    }

    #[Route('/mes_appartements/new/by{id}', name: 'new_appartement')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $appartement = new Appartement();
        $form = $this->createForm(NewAppartementType::class, $appartement);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $appartement->setOwner($request->get('id'));
            $entityManager->persist($appartement);
            $entityManager->flush();
            return $this->redirectToRoute('owner_appartement',['owner'=>$appartement->getOwner()]);
        }
        return $this->render('appartement/new_appartement.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/mes_appartements/edit/{id}', name: 'edit_appartement')]
    public function edit(Appartement $appartement, Request $request,EntityManagerInterface $entityManager)
    {
        $form = $this->createForm(NewAppartementType::class, $appartement);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entityManager->flush();
            return $this->redirectToRoute('owner_appartement');
        }
        return $this->render('appartement/edit_appartement.html.twig',[
            'appartement' => $appartement,
            'form' => $form
        ]);
    }

    #[Route('/mes_appartements/delete/{id}', name: 'delete_appartement')]
    public function delete(Appartement $appartement, EntityManagerInterface $entityManager)
    {
        $entityManager->remove($appartement);
        $entityManager->flush();
        return $this->redirectToRoute('owner_appartement',['owner'=>$appartement->getOwner()]);
    }
}
