<?php

namespace App\DataFixtures;
use Doctrine\Bundle\FixturesBundle\Fixture;
use App\Entity\Ligue1Teams;
use Doctrine\Persistence\ObjectManager;

class Ligue1TeamsFixtures extends Fixture
{
    private const TEAMS = [
        [
            'name' => 'Olympique Lyonnais',
            'displayName' => 'OL',
            'coach' => 'Pierre Sage',
            'stadium' => 'Groupama Stadium',
            'apiId' => 523 ,
        ],
        [
            'name' => 'OGC Nice',
            'displayName' => 'OGCN',
            'coach' => 'Franck Haise',
            'stadium' => 'Allianz Rivieira',
            'apiId' => 522,
        ],
        [
            'name' => 'Paris Saint Germain',
            'displayName' => 'PSG',
            'coach' => 'Luis Henrique',
            'stadium' => 'Parc des Princes',
            'apiId' => 524,
        ],
        [
            'name' => 'SCO Angers',
            'displayName' => 'SCO',
            'coach' => 'Alexandre Dujeux',
            'stadium' => 'Stade Raymond Kopa',
            'apiId' => 532 ,
        ],
        [
            'name' => 'Olympique de Marseille',
            'displayName' => 'OM',
            'coach' => 'Roberto De Zerbi',
            'stadium' => 'Velodrome',
            'apiId' => 516 ,
        ],
        [
            'name' => 'AS Monaco',
            'displayName' => 'ASM',
            'coach' => 'Adi Hütter',
            'stadium' => 'Stade Louis II',
            'apiId' => 548 ,
        ],
        [
            'name' => 'Lille OSC',
            'displayName' => 'LOSC',
            'coach' => 'Bruno Genesio',
            'stadium' => 'Stade Pierre Mauroy',
            'apiId' => 521 ,
        ],
        [
            'name' => 'RC Lens',
            'displayName' => 'RCL',
            'coach' => 'Will Still',
            'stadium' => 'Stade Bollaert',
            'apiId' => 546 ,
        ],
        [
            'name' => 'SR Reims',
            'displayName' => 'SRRC',
            'coach' => 'Luka Elsner',
            'stadium' => 'Stade Auguste Delaune',
            'apiId' => 547 ,
        ],
        [
            'name' => 'Stade Rennais FC',
            'displayName' => 'SRFC',
            'coach' => 'Julien Stephan',
            'stadium' => 'Roahzon Park',
            'apiId' => 529 ,
        ],
        [
            'name' => 'RC Strasbourg',
            'displayName' => 'RCSA',
            'coach' => 'Liam Rosenior',
            'stadium' => 'Stade de la Meinau',
            'apiId' => 576 ,
        ],
        [
            'name' => 'Montpellier HSC',
            'displayName' => 'MHSC',
            'coach' => 'Jean-Louis Gasset',
            'stadium' => 'Stade de la Mosson',
            'apiId' => 518 ,
        ],
        [
            'name' => 'AS Saint-Etienne',
            'displayName' => 'ASSE',
            'coach' => 'Olivier Dall\'Oglio',
            'stadium' => 'Stade Geoffroy-Guichard',
            'apiId' => 527 ,
        ],
        [
            'name' => 'FC Nantes',
            'displayName' => 'FCN',
            'coach' => 'Antoine Kombouaré',
            'stadium' => 'La Beaujoire',
            'apiId' => 543 ,
        ],
        [
            'name' => 'AJ Auxerre',
            'displayName' => 'AJA',
            'coach' => 'Christophe Pélissier',
            'stadium' => 'L\'Abbé des Champs',
            'apiId' => 519 ,
        ],
        [
            'name' => 'Toulouse FC',
            'displayName' => 'TFC',
            'coach' => 'Carles Martinez Novell',
            'stadium' => 'Le Stadium',
            'apiId' => 511 ,
        ],
        [
            'name' => 'Le Havre',
            'displayName' => 'HAC',
            'coach' => 'Didier Digard',
            'stadium' => 'Stade Océane',
            'apiId' => 511 ,
        ],
        [
            'name' => 'Stade Brestois 29',
            'displayName' => 'Brest',
            'coach' => 'Eric Roy',
            'stadium' => 'Stade Francis Le Blé',
            'apiId' => 512 ,
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::TEAMS as $data) {
            $team = new Ligue1Teams();
            $team->setName($data['name']);
            $team->setDisplayName($data['displayName']);
            $team->setCoach($data['coach']);
            $team->setStadium($data['stadium']);
            $team->setApiId($data['apiId']);
            $manager->persist($team);

            // ref to use in other fixtures
            $this->addReference($data['displayName'], $team);
        }

        $manager->flush();
    }
}
