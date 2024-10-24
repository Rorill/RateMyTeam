<?php
namespace App\DataFixtures;

use App\Entity\AssePlayers;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\Integer;

class ASSEPlayersFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $players = [

            // Goalkeepers
            ['firstName' => 'Brice', 'lastName' => 'Maubleu', 'birthday' => '1989-12-01', 'Position' => 'Goal','Number' => 1],
            ['firstName' => 'Boubacar', 'lastName'=> 'Fall', 'birthday' => '2001-02-03', 'Position' => 'Goal','Number' => 16],
            ['firstName' => 'Gautier', 'lastName'=> 'Larsonneur', 'birthday' => '1997-02-23', 'Position' => 'Goal','Number' => 30],
            ['firstName' => 'Issiaka', 'lastName'=> 'Toure', 'birthday' => '2006-11-07', 'Position' => 'Goal','Number' => 40],


            // Defenders
            ['firstName' => 'Mickael','lastName'=> 'Nade', 'birthday' => '1999-03-04', 'Position' => 'Defender','Number' => 3],
            ['firstName' => 'Yunis', 'lastName'=> 'Abdelhamid', 'birthday' => '1987-09-28', 'Position' => 'Defender','Number' => 5],
            ['firstName' => 'Dennis', 'lastName' => 'Appiah', 'birthday' => '1992-06-09', 'Position' => 'Defender','Number' => 8],
            ['firstName' => 'Pierre', 'lastName' => 'Cornud', 'birthday' => '1996-12-12', 'Position' => 'Defender','Number' => 17],
            ['firstName' => 'Leo', 'lastName' => 'Petrot', 'birthday' => '1997-04-15', 'Position' => 'Defender','Number' => 19],
            ['firstName' => 'Dylan', 'lastName' => 'Batubinsika', 'birthday' => '1996-02-15', 'Position' => 'Defender','Number' => 21],
            ['firstName' => 'Anthony', 'lastName' => 'Briancon', 'birthday' => '1994-11-29', 'Position' => 'Defender','Number' => 23],
            ['firstName' => 'Yvann', 'lastName' => 'Macon', 'birthday' => '1998-10-01', 'Position' => 'Defender','Number' => 27],

            // Midfielders
            ['firstName' => 'Pierre', 'lastName' => 'Ekwah', 'birthday' => '2002-01-15', 'Position' => 'Midfielder','Number' => 4],
            ['firstName' => 'Benjamin', 'lastName' => 'Bouchouari', 'birthday' => '2001-11-13', 'Position' => 'Midfielder','Number' => 6],
            ['firstName' => 'Thomas', 'lastName' => 'Monconduit', 'birthday' => '1991-02-10', 'Position' => 'Midfielder','Number' => 7],
            ['firstName' => 'Florian', 'lastName' => 'Tardieu', 'birthday' => '1992-04-22', 'Position' => 'Midfielder','Number' => 10],
            ['firstName' => 'Ben', 'lastName' => 'Old', 'birthday' => '2002-08-13', 'Position' => 'Midfielder','Number' => 11],
            ['firstName' => 'Louis', 'lastName' => 'Mouton', 'birthday' => '2002-06-03', 'Position' => 'Midfielder','Number' => 14],
            ['firstName' => 'Mathieu', 'lastName' => 'Cafaro', 'birthday' => '1997-03-25', 'Position' => 'Midfielder','Number' => 18],
            ['firstName' => 'Augustine', 'lastName' => 'Boakye', 'birthday' => '2000-11-03', 'Position' => 'Midfielder','Number' => 20],
            ['firstName' => 'Lamine', 'lastName' => 'Fomba', 'birthday' => '1998-01-26', 'Position' => 'Midfielder','Number' => 26],
            ['firstName' => 'Igor', 'lastName' => 'Miladinovic', 'birthday' => '2003-06-08', 'Position' => 'Midfielder','Number' => 28],
            ['firstName' => 'Aïmen', 'lastName' => 'Moueffek', 'birthday' => '2001-04-09', 'Position' => 'Midfielder','Number' => 29],
            ['firstName' => 'Cheikh', 'lastName' => 'Fall', 'birthday' => '2004-02-25', 'Position' => 'Midfielder','Number' => 31],
            ['firstName' => 'Antoine', 'lastName' => 'Gauthier', 'birthday' => '2O04-07-01', 'Position' => 'Midfielder','Number' => 34],
            ['firstName' => 'Marwann', 'lastName' => 'Nzuzi', 'birthday' => '2004-05-16', 'Position' => 'Midfielder','Number' => 34],
            ['firstName' => 'Jebryl', 'lastName' => 'Sahraoui', 'birthday' => '2005-02-04', 'Position' => 'Midfielder','Number' => 36],
            ['firstName' => 'Mathis', 'lastName' => 'Amougou', 'birthday' => '2006-01-18', 'Position' => 'Midfielder','Number' => 37],

            // Forwards
            ['firstName' => 'Ibrahim', 'lastName' => 'Sissoko', 'birthday' => '1995-11-27', 'Position' => 'Forward','Number' => 9],
            ['firstName' => 'Zuriko', 'lastName' => 'Davitashvili', 'birthday' => '2001-02-15', 'Position' => 'Forward','Number' => 22],
            ['firstName' => 'Ibrahima', 'lastName' => 'Wadji', 'birthday' => '1995-05-05', 'Position' => 'Forward','Number' => 25],
            ['firstName' => 'Lucas', 'lastName' => 'Stassin', 'birthday' => '2004-11-29', 'Position' => 'Forward','Number' => 32],
            ['firstName' => 'Ayman', 'lastName' => 'Aiki', 'birthday' => '2005-06-25', 'Position' => 'Forward','Number' => 39],
            ['firstName' => 'Jibril', 'lastName' => 'Othman', 'birthday' => '2004-04-26', 'Position' => 'Forward','Number' => 41],
            ['firstName' => 'Elhadji', 'lastName' => 'Dieye', 'birthday' => '2002-06-05', 'Position' => 'Forward','Number' => 43],
            ['firstName' => 'Enzo', 'lastName' => 'Mayilla', 'birthday' => '2006-01-02', 'Position' => 'Forward','Number' => 99],

        ];

        foreach ($players as $playerData) {
            $player = new AssePlayers();
            $player->setFirstName($playerData['firstName']);
            $player->setLastName($playerData['lastName']);
            $player->setBirthday(new \DateTimeImmutable($playerData['birthday']));
            $player->setPosition($playerData['Position']);
            $player->setNumber($playerData['Number']);
            $manager->persist($player);
        }

        $manager->flush();
    }
}
