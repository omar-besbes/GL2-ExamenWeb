<?php

namespace App\Controller;

use App\Repository\EntrepriseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class EntrepriseController extends AbstractController
{


	public function __construct(private EntrepriseRepository $repository) {}

	public function index(): Response
	{
		$entreprises = $this->repository->getAllwithPFEcount();
		return $this->render('entreprise/index.html.twig', [
			'controller_name' => 'EntrepriseController',
			'entreprises' => $entreprises
		]);
	}
}
