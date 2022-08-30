<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\HealthStatus;
use ConnexionBdd;
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

    public function migrations(ObjectManager $manager): void
    {
        $cnx = new ConnexionBdd();
        $file = fopen("../../BDD/save.sql", "r");
        if (!$file) {
            die("ERROR: Couldn't open {$file}.\n");
        }

        $script = '';
        while (($line = fgets($file)) !== false) {
            $line = trim($line);
            if (preg_match("/^#|^--|^$/", $line)) {
                continue;
            }
            $script .= $line;
        }
        $statements = explode(';', $script);
        foreach ($statements as $sql) {
            if ($sql === '') {
                continue;
            }
            $query = $cnx->getConnexion()->prepare($sql);
            $query->execute();
            if ($query->errorCode() !== '00000') {
                die("ERROR: SQL error code: " . $query->errorCode() . "\n");
            }
        }
    }
}
