<?php

namespace App\Ligue1TeamsFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\Ligue1Teams;
use Doctrine\Persistence\ObjectManager;

class Ligue1TeamsFixtures extends Fixture
{
    public function load(ObjectManager $manager):void
    {

        $team1 = new Ligue1Teams();
        $team1->setName('Olympique Lyonnais');
        $team1->setDisplayName('OL');
        $team1->setCoach('Pierre Sage');
        $team1->setStadium('Groupama Stadium');
        $manager->persist($team1);

        $team2 = new Ligue1Teams();
        $team2->setName('Paris Saint Germain');
        $team2->setDisplayName('PSG');
        $team2->setCoach('Luis Henrique');
        $team2->setStadium('Parc des Princes');
        $manager->persist($team2);

        $team3 = new Ligue1Teams();
        $team3->setName('SCO Angers');
        $team3->setDisplayName('SCO');
        $team3->setCoach('Alexandre Dujeux');
        $team3->setStadium('Stade Raymond Kopa');
        $manager->persist($team3);

        $team4 = new Ligue1Teams();
        $team4->setName('Olympique de Marseille');
        $team4->setDisplayName('OM');
        $team4->setCoach('Roberto De Zerbi');
        $team4->setStadium('Velodrome');
        $manager->persist($team4);

        $team5 = new Ligue1Teams();
        $team5->setName('AS Monaco');
        $team5->setDisplayName('ASM');
        $team5->setCoach('Adi Hütter');
        $team5->setStadium('Stade Louis II');
        $manager->persist($team5);

        $team6 = new Ligue1Teams();
        $team6->setName('Lille OSC');
        $team6->setDisplayName('LOSC');
        $team6->setCoach('Bruno Genesio');
        $team6->setStadium('Stade Pierre Mauroy');
        $manager->persist($team6);

        $team7 = new Ligue1Teams();
        $team7->setName('RC Lens');
        $team7->setDisplayName('RCL');
        $team7->setCoach('Will Still');
        $team7->setStadium('Stade Bollaert');
        $manager->persist($team7);

        $team8 = new Ligue1Teams();
        $team8->setName('SR Reims');
        $team8->setDisplayName('SRRC');
        $team8->setCoach('Luka Elsner');
        $team8->setStadium('Stade Auguste Delaune');
        $manager->persist($team8);

        $team9 = new Ligue1Teams();
        $team9->setName('Stadde Rennais FC');
        $team9->setDisplayName('SRFC');
        $team9->setCoach('Julien Stephan');
        $team9->setStadium('Roahzon Park');
        $manager->persist($team9);

        $team10 = new Ligue1Teams();
        $team10->setName('RC Strasbourg');
        $team10->setDisplayName('RCS');
        $team10->setCoach('Liam Rosenior');
        $team10->setStadium('Stade de la Meinau');
        $manager->persist($team10);

        $team11 = new Ligue1Teams();
        $team11->setName('Montpellier HSC');
        $team11->setDisplayName('MHSC');
        $team11->setCoach('Jean-Louis Gasset');
        $team11->setStadium('Stade de la Mosson');
        $manager->persist($team11);

        $team12 = new Ligue1Teams();
        $team12->setName('AS Saint-Etienne');
        $team12->setDisplayName('ASSE');
        $team12->setCoach('Olivier Dall\'\Oglio');
        $team12->setStadium('Stade Geoffroy-Guichard');
        $manager->persist($team12);

        $team13 = new Ligue1Teams();
        $team13->setName('FC Nantes');
        $team13->setDisplayName('FCN');
        $team13->setCoach('Antoine Kombouaré');
        $team13->setStadium('La Beaujoire');
        $manager->persist($team13);

        $team14 = new Ligue1Teams();
        $team14->setName('AJ Auxerre');
        $team14->setDisplayName('AJA');
        $team14->setCoach('Christophe Pélissier');
        $team14->setStadium('L\'\abbé des champs');
        $manager->persist($team14);

        $team15 = new Ligue1Teams();
        $team15->setName('Toulouse FC');
        $team15->setDisplayName('TFC');
        $team15->setCoach('Carles Martinez Novell');
        $team15->setStadium('Le stadium');
        $manager->persist($team15);

        $team16 = new Ligue1Teams();
        $team16->setName('Le Havre');
        $team16->setDisplayName('HAC');
        $team16->setCoach('Didier Digard');
        $team16->setStadium('Stade Oceane');
        $manager->persist($team16);

        $team17 = new Ligue1Teams();
        $team17->setName('Stade Brestois 29');
        $team17->setDisplayName('Brest');
        $team17->setCoach('Eric Roy');
        $team17->setStadium('Stade Francis Le Blé');
        $manager->persist($team17);



    }

}