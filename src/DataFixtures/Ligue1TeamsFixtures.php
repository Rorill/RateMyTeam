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
            'stadium' => 'Groupama Stadium'
        ],
        [
            'name' => 'OGC Nice',
            'displayName' => 'OGCN',
            'coach' => 'Franck Haise',
            'stadium' => 'Allianz Rivieira'
        ],
        [
            'name' => 'Paris Saint Germain',
            'displayName' => 'PSG',
            'coach' => 'Luis Henrique',
            'stadium' => 'Parc des Princes'
        ],
        [
            'name' => 'SCO Angers',
            'displayName' => 'SCO',
            'coach' => 'Alexandre Dujeux',
            'stadium' => 'Stade Raymond Kopa'
        ],
        [
            'name' => 'Olympique de Marseille',
            'displayName' => 'OM',
            'coach' => 'Roberto De Zerbi',
            'stadium' => 'Velodrome'
        ],
        [
            'name' => 'AS Monaco',
            'displayName' => 'ASM',
            'coach' => 'Adi Hütter',
            'stadium' => 'Stade Louis II'
        ],
        [
            'name' => 'Lille OSC',
            'displayName' => 'LOSC',
            'coach' => 'Bruno Genesio',
            'stadium' => 'Stade Pierre Mauroy'
        ],
        [
            'name' => 'RC Lens',
            'displayName' => 'RCL',
            'coach' => 'Will Still',
            'stadium' => 'Stade Bollaert'
        ],
        [
            'name' => 'SR Reims',
            'displayName' => 'SRRC',
            'coach' => 'Luka Elsner',
            'stadium' => 'Stade Auguste Delaune'
        ],
        [
            'name' => 'Stade Rennais FC',
            'displayName' => 'SRFC',
            'coach' => 'Julien Stephan',
            'stadium' => 'Roahzon Park'
        ],
        [
            'name' => 'RC Strasbourg',
            'displayName' => 'RCSA',
            'coach' => 'Liam Rosenior',
            'stadium' => 'Stade de la Meinau'
        ],
        [
            'name' => 'Montpellier HSC',
            'displayName' => 'MHSC',
            'coach' => 'Jean-Louis Gasset',
            'stadium' => 'Stade de la Mosson'
        ],
        [
            'name' => 'AS Saint-Etienne',
            'displayName' => 'ASSE',
            'coach' => 'Olivier Dall\'Oglio',
            'stadium' => 'Stade Geoffroy-Guichard'
        ],
        [
            'name' => 'FC Nantes',
            'displayName' => 'FCN',
            'coach' => 'Antoine Kombouaré',
            'stadium' => 'La Beaujoire'
        ],
        [
            'name' => 'AJ Auxerre',
            'displayName' => 'AJA',
            'coach' => 'Christophe Pélissier',
            'stadium' => 'L\'Abbé des Champs'
        ],
        [
            'name' => 'Toulouse FC',
            'displayName' => 'TFC',
            'coach' => 'Carles Martinez Novell',
            'stadium' => 'Le Stadium'
        ],
        [
            'name' => 'Le Havre',
            'displayName' => 'HAC',
            'coach' => 'Didier Digard',
            'stadium' => 'Stade Océane'
        ],
        [
            'name' => 'Stade Brestois 29',
            'displayName' => 'Brest',
            'coach' => 'Eric Roy',
            'stadium' => 'Stade Francis Le Blé'
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
            $manager->persist($team);

            // ref to use in other fixtures
            $this->addReference($data['displayName'], $team);
        }

        $manager->flush();
    }
}
