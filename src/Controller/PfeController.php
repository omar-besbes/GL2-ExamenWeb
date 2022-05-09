<?php

namespace App\Controller;

use App\Entity\PFE;
use App\Form\PFEType;
use App\Repository\EntrepriseRepository;
use App\Repository\PFERepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PfeController extends AbstractController
{

	private ObjectManager $manager;


	/**
	 * @param PFERepository $repository
	 * @param ManagerRegistry $doctrine
	 */
	public function __construct(private PFERepository $repository, private EntrepriseRepository $repositoryE, private ManagerRegistry $doctrine)
	{
		$this->manager = $doctrine->getManager();
	}

	#[Route('/pfe', name: 'app_pfe')]
	public function index(PFE $pfe): Response
	{
		return $this->render('pfe/index.html.twig', [
			'controller_name' => 'PfeController',
			'pfe' => $pfe
		]);
	}

	public function addPfe(Request $request): Response
	{
		$pfe = new PFE();
		$form = $this->createForm(PFEType::class, $pfe);

		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			// persistance de l'entreprise
			$this->manager->persist($pfe->getEntreprise());

			// persistance de pfe
			$pfe = $form->getData();
			$this->manager->persist($pfe);

			$this->manager->flush();
			$this->addFlash('success', 'Form submitted successfully');
			return $this->redirectToRoute('app_pfe', ['pfe' => $pfe]);
		}

		return $this->renderForm('pfe/form.html.twig', [
			'form' => $form
		]);
	}
}
