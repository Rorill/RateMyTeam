<?php
namespace App\DataFixtures;

use App\Entity\PsgPlayers;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\Integer;

class PSGPlayersFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $players = [



            // Goalkeepers
            ['firstName' => 'Gianluigi', 'lastName' => 'Donnarumma', 'birthday' => '1999-02-25', 'Position' => 'Goal','Number' => 1],
            ['firstName' => 'Matvei', 'lastName'=> 'Safonov', 'birthday' => '1999-02-25', 'Position' => 'Goal','Number' => 39],
            ['firstName' => 'Louis', 'lastName'=> 'Mouquet', 'birthday' => '2004-07-21', 'Position' => 'Goal','Number' => 70],
            ['firstName' => 'Arnau', 'lastName'=> 'Tenas', 'birthday' => '2001-05-30', 'Position' => 'Goal','Number' => 80],



            // Defenders
            ['firstName' => 'Achraf','lastName'=> 'Hakimi', 'birthday' => '1998-11-04', 'Position' => 'Defender','Number' => 2],
            ['firstName' => 'Presnel', 'lastName'=> 'Kimpembe', 'birthday' => '1995-08-13', 'Position' => 'Defender','Number' => 3],
            ['firstName' => 'Marcos Aoás Corrêa', 'lastName' => 'Marquinhos', 'birthday' => '1994-05-14', 'Position' => 'Defender','Number' => 5],
            ['firstName' => 'Lucas', 'lastName' => 'Hernandez ', 'birthday' => '1996-02-14', 'Position' => 'Defender','Number' => 21],
            ['firstName' => 'Nuno', 'lastName' => 'Mendes', 'birthday' => '2002-06-18', 'Position' => 'Defender','Number' => 25],
            ['firstName' => 'Lucas', 'lastName' => 'Beraldo', 'birthday' => '2003-11-24', 'Position' => 'Defender','Number' => 35],
            ['firstName' => 'Milan', 'lastName' => 'Škriniar', 'birthday' => '1995-02-11', 'Position' => 'Defender','Number' => 37],
            ['firstName' => 'Yoram', 'lastName' => 'Zague', 'birthday' => '2006-05-15', 'Position' => 'Defender','Number' => 42],
            ['firstName' => 'Willian', 'lastName' => 'Pacho', 'birthday' => '2001-10-16', 'Position' => 'Defender','Number' => 51],

            // Midfielders
            ['firstName' => 'Fabian', 'lastName' => 'Ruiz', 'birthday' => '1996-04-03', 'Position' => 'Midfielder','Number' => 8],
            ['firstName' => 'Marco', 'lastName' => 'Asensio', 'birthday' => '1996-01-21', 'Position' => 'Midfielder','Number' => 11],
            ['firstName' => 'Vítor Machado Ferreira', 'lastName' => 'Vitinha', 'birthday' => '2000-02-13', 'Position' => 'Midfielder','Number' => 17],
            ['firstName' => 'Lee', 'lastName' => 'Kang-In', 'birthday' => '2001-02-19', 'Position' => 'Midfielder','Number' => 19],
            ['firstName' => 'Senny', 'lastName' => 'Mayulu', 'birthday' => '2006-05-17', 'Position' => 'Midfielder','Number' => 24],
            ['firstName' => 'Warren', 'lastName' => 'Zaïre-Emery', 'birthday' => '2006-03-08', 'Position' => 'Midfielder','Number' => 33],
            ['firstName' => 'Edouard', 'lastName' => 'Michut', 'birthday' => '2003-03-04', 'Position' => 'Midfielder','Number' => 38],
            ['firstName' => 'Ayman', 'lastName' => 'Kari', 'birthday' => '2004-11-19', 'Position' => 'Midfielder','Number' => 44],
            ['firstName' => 'Joao', 'lastName' => 'Neves', 'birthday' => '2004-09-27', 'Position' => 'Midfielder','Number' => 87],

            // Forwards
            ['firstName' => 'Gonçalo', 'lastName' => 'Ramos', 'birthday' => '2001-06-20', 'Position' => 'Forward','Number' => 9],
            ['firstName' => 'Ousmane', 'lastName' => 'Dembele', 'birthday' => '1997-05-15', 'Position' => 'Forward','Number' => 10],
            ['firstName' => 'Randal', 'lastName' => 'Kolo Muani', 'birthday' => '1998-12-05', 'Position' => 'Forward','Number' => 23],
            ['firstName' => 'Bradley', 'lastName' => 'Barcola', 'birthday' => '2002-09-02', 'Position' => 'Forward','Number' => 29],

        ];

        foreach ($players as $playerData) {
            $player = new PsgPlayers();
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