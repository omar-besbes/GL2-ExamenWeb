<?php

namespace App\DataFixtures;

use App\Entity\Entreprise;
use App\Entity\PFE;
use App\Repository\EntrepriseRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PfeFixture extends Fixture implements DependentFixtureInterface
{


	public function __construct(private EntrepriseRepository $repository) {}

	public function load(ObjectManager $manager): void
    {
		$entreprises = $this->repository->findAll();
		foreach ($entreprises as $entreprise){
			$nbPFE = random_int(0,5);
			for($i = 0; $i < $nbPFE; $i++) {
				$pfe = new PFE();
				$pfe->setEtudiant("foulen fouleni" . random_int(0, 100));
				$pfe->setTitre("sujet" . random_int(0, 100));
				$pfe->setEntreprise($entreprise);
				$manager->persist($pfe);
			}
		}

        $manager->flush();
    }


	public function getDependencies(): array
	{
		return [
			EntrepriseFixture::class
		];
	}
}
