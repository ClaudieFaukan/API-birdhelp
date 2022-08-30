<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\HealthStatus;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use PDO;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $categories = ["Autre", "Reptile", "Mouton", "Cheval", "Chien", "Chat", "Oiseaux"];
        $status = ["animal blésser", "animal érrant", "animal mal traité", "animal décéder"];

        foreach ($categories as $categorie) {
            $categorie_entity = new Category;
            $categorie_entity->setName($categorie);
            $manager->persist($categorie_entity);
        }
        foreach ($status as $statu) {
            $statu_entity = new HealthStatus;
            $statu_entity->setStatus($statu);
            $manager->persist($statu_entity);
        }

        $manager->flush();
    }
}
