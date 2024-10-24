<?php
namespace App\DataFixtures;

use App\Entity\HacPlayers;
use App\Entity\LensPlayers;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\Integer;

class LensPlayersFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $players = [
            // goals
            ['firstName' => 'Denis', 'lastName'=> 'Petric', 'birthday' => '1988-05-24', 'Position' => 'Goal','Number' => 1],
            ['firstName' => 'Hervé','lastName'=> 'Koffi', 'birthday' => '1996-10-16', 'Position' => 'Goal','Number' => 16],
            ['firstName' => 'Brice', 'lastName'=> 'Samba', 'birthday' => '1994  -04-25', 'Position' => 'Goal','Number' => 30],


            // defenders

            ['firstName' => 'Ruben', 'lastName'=> 'Aguilar', 'birthday' => '1993-04-26', 'Position' => 'Defender','Number' => 2],
            ['firstName' => 'Deiver', 'lastName'=> 'Machado', 'birthday' => '1993-09-02', 'Position' => 'Defender','Number' => 3],
            ['firstName' => 'Kevin', 'lastName'=> 'Danso', 'birthday' => '1998-09-19', 'Position' => 'Defender','Number' => 4],
            ['firstName' => 'Jhoanner', 'lastName'=> 'Chavez', 'birthday' => '2002-04-25', 'Position' => 'Defender','Number' => 13],
            ['firstName' => 'Facundo', 'lastName' => 'Medina', 'birthday' => '1999-05-28', 'Position' => 'Defender','Number' => 14],
            ['firstName' => 'Malang', 'lastName' => 'Sarr', 'birthday' => '1999-01-23', 'Position' => 'Defender','Number' => 20],
            ['firstName' => 'Jonathan', 'lastName' => 'Gradit', 'birthday' => '1992-11-24', 'Position' => 'Defender','Number' => 24],
            ['firstName' => 'Abdukodir', 'lastName' => 'Khusanov', 'birthday' => '2004-02-29', 'Position' => 'Defender','Number' => 25],
            ['firstName' => 'Sidi', 'lastName' => 'Bane', 'birthday' => '2004-01-14', 'Position' => 'Defender','Number' => 27],
            ['firstName' => 'Tom', 'lastName' => 'Pouilly', 'birthday' => '2003-06-18', 'Position' => 'Defender','Number' => 34],
            ['firstName' => 'Ismaëlo', 'lastName' => 'Ganiou', 'birthday' => '2005-03-14', 'Position' => 'Defender','Number' => 37],



            // midfileders

            ['firstName' => 'David', 'lastName' => 'Pereira Da Costa', 'birthday' => '2001-01-05', 'Position' => 'Midfielder','Number' => 10],
            ['firstName' => 'Angelo', 'lastName' => 'Fulgini', 'birthday' => '1996-08-20', 'Position' => 'Midfielder','Number' => 11],
            ['firstName' => 'Hamzat', 'lastName' => 'Ojediran', 'birthday' => '2003-11-14', 'Position' => 'Midfielder','Number' => 15],
            ['firstName' => 'Andy', 'lastName' => 'Diouf', 'birthday' => '2003-05-17', 'Position' => 'Midfielder','Number' => 18],
            ['firstName' => 'Jimmy', 'lastName' => 'Cabot', 'birthday' => '1994-04-18', 'Position' => 'Midfielder','Number' => 19],
            ['firstName' => 'Anass', 'lastName' => 'Zaroury', 'birthday' => '2000-11-07', 'Position' => 'Midfielder','Number' => 21],
            ['firstName' => 'Neil', 'lastName' => 'El Aynaoui', 'birthday' => '2001-07-02', 'Position' => 'Midfielder','Number' => 23],
            ['firstName' => 'Nampalys', 'lastName' => 'Mendy', 'birthday' => '1992-06-23', 'Position' => 'Midfielder','Number' => 26],
            ['firstName' => 'Adrien', 'lastName' => 'Thomasson', 'birthday' => '1993-12-10', 'Position' => 'Midfielder','Number' => 28],
            ['firstName' => 'Przemyslaw', 'lastName' => 'Frankowski', 'birthday' => '1995-04-12', 'Position' => 'Midfielder','Number' => 29],
            ['firstName' => 'Alpha', 'lastName' => 'Diallo', 'birthday' => '2006-02-25', 'Position' => 'Midfielder','Number' => 31],
            ['firstName' => 'Mamadou', 'lastName' => 'Camara', 'birthday' => '2002-10-15', 'Position' => 'Midfielder','Number' => 36],





            //Forward
            ['firstName' => 'Florian', 'lastName' => 'Sotoca', 'birthday' => '1990-10-25', 'Position' => 'Forward','Number' => 7],
            ['firstName' => 'Mbala', 'lastName' => 'Nzola', 'birthday' => '1996-08-18', 'Position' => 'Forward','Number' => 8],
            ['firstName' => 'Martin', 'lastName' => 'Satriano', 'birthday' => '2001-02-20', 'Position' => 'Forward','Number' => 9],
            ['firstName' => 'Wesley', 'lastName' => 'Said', 'birthday' => '1995-04-19', 'Position' => 'Forward','Number' => 22],
            ['firstName' => 'Rémy', 'lastName' => 'Labeau-Lascary', 'birthday' => '2003-03-03', 'Position' => 'Forward','Number' => 36],

        ];

        foreach ($players as $playerData) {
            $player = new LensPlayers();
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