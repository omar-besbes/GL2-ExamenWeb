<?php

namespace App\DataFixtures;

use App\Entity\Entreprise;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EntrepriseFixture extends Fixture
{
	public function load(ObjectManager $manager): void
	{
		for ($i = 0; $i < 20; $i++) {
			$entreprise = new Entreprise();
			$entreprise->setDesignation("Entreprise" . $i);
			$manager->persist($entreprise);
		}
		$manager->flush();
	}
}
