<?php

namespace App\Controller;

use App\Repository\EntrepriseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EntrepriseController extends AbstractController
{


	public function __construct(private EntrepriseRepository $repository)
	{
	}

	#[Route('/entreprise', name: 'app_entreprise')]
	public function index(): Response
	{
		return $this->render('entreprise/index.html.twig', [
			'controller_name' => 'EntrepriseController',
			'entreprises' => $this->repository->findAll()
		]);
	}
}
