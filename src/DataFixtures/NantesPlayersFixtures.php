<?php
namespace App\DataFixtures;

use App\Entity\NantesPlayers;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\Integer;

class MonacoPlayersFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $players = [



            // Goalkeepers
            ['firstName' => 'Alban', 'lastName' => 'Lafont', 'birthday' => '1999-11-23', 'Position' => 'Goal','Number' => 1],
            ['firstName' => 'Patrik', 'lastName'=> 'Carlgren', 'birthday' => '1992-01-08', 'Position' => 'Goal','Number' => 30],
            ['firstName' => 'Lucas', 'lastName'=> 'Bonelli', 'birthday' => '2003-02-14', 'Position' => 'Goal','Number' => 40],
            ['firstName' => 'Hugo', 'lastName'=> 'Barbet', 'birthday' => '2001-11-22', 'Position' => 'Goal','Number' => 50],
            ['firstName' => 'Tom', 'lastName'=> 'Mabon', 'birthday' => '2004-06-16', 'Position' => 'Goal','Number' => 60],




            // Defenders
            ['firstName' => 'Jean-Kévin','lastName'=> 'Duverne', 'birthday' => '1997-07-12', 'Position' => 'Defender','Number' => 2],
            ['firstName' => 'Nicolas', 'lastName'=> 'Cozza', 'birthday' => '1999-01-08', 'Position' => 'Defender','Number' => 3],
            ['firstName' => 'Nicolas', 'lastName' => 'Pallois', 'birthday' => '1987-09-19', 'Position' => 'Defender','Number' => 4],
            ['firstName' => 'Fabien', 'lastName' => 'Centonze ', 'birthday' => '1996-01-16', 'Position' => 'Defender','Number' => 18],
            ['firstName' => 'Jean-Charles', 'lastName' => 'Castelletto', 'birthday' => '1995-01-26', 'Position' => 'Defender','Number' => 21],
            ['firstName' => 'Mathieu', 'lastName' => 'Acapandie', 'birthday' => '2004-12-14', 'Position' => 'Defender','Number' => 41],
            ['firstName' => 'Moutanabi', 'lastName' => 'Bodiang', 'birthday' => '2003-03-14', 'Position' => 'Defender','Number' => 42],
            ['firstName' => 'Nathan', 'lastName' => 'Zeze', 'birthday' => '2005-06-18', 'Position' => 'Defender','Number' => 44],
            ['firstName' => 'Enzo', 'lastName' => 'Mongo', 'birthday' => '2005-04-08', 'Position' => 'Defender','Number' => 46],
            ['firstName' => 'Hugo', 'lastName' => 'Boutsingkham', 'birthday' => '2003-01-20', 'Position' => 'Defender','Number' => 71],
            ['firstName' => 'Sékou', 'lastName' => 'Doucoure', 'birthday' => '2005-04-26', 'Position' => 'Defender','Number' => 72],
            ['firstName' => 'Kelvin', 'lastName' => 'Amian', 'birthday' => '1998-02-08', 'Position' => 'Defender','Number' => 98],


            // Midfielders
            ['firstName' => 'Pedro', 'lastName' => 'Chirivella', 'birthday' => '1997-05-23', 'Position' => 'Midfielder','Number' => 5],
            ['firstName' => 'Douglas', 'lastName' => 'Augusto', 'birthday' => '1997-01-13', 'Position' => 'Midfielder','Number' => 6],
            ['firstName' => 'Johann', 'lastName' => 'Lepenant', 'birthday' => '2002-10-28', 'Position' => 'Midfielder','Number' => 8],
            ['firstName' => 'Jean-Philippe', 'lastName' => 'Gbamin', 'birthday' => '1995-09-25', 'Position' => 'Midfielder','Number' => 17],
            ['firstName' => 'Florent', 'lastName' => 'Mollet', 'birthday' => '1991-11-19', 'Position' => 'Midfielder','Number' => 25],
            ['firstName' => 'Dehmaine', 'lastName' => 'Assoumani', 'birthday' => '2005-04-17', 'Position' => 'Midfielder','Number' => 59],
            ['firstName' => 'Mathis', 'lastName' => 'Oger', 'birthday' => '2003-05-02', 'Position' => 'Midfielder','Number' => 74],



            // Forwards
            ['firstName' => 'Ignatius', 'lastName' => 'Ganago', 'birthday' => '1999-02-16', 'Position' => 'Forward','Number' => 7],
            ['firstName' => 'Tino', 'lastName' => 'Kadewere', 'birthday' => '1996-01-05', 'Position' => 'Forward','Number' => 10],
            ['firstName' => 'Marcus', 'lastName' => 'Coco', 'birthday' => '1996-06-24', 'Position' => 'Forward','Number' => 11],
            ['firstName' => 'Sorba', 'lastName' => 'Thomas', 'birthday' => '1999-01-25', 'Position' => 'Forward','Number' => 22],
            ['firstName' => 'Moses', 'lastName' => 'Simon', 'birthday' => '1995-07-12', 'Position' => 'Forward','Number' => 27],
            ['firstName' => 'Mostafa', 'lastName' => 'Mohamed', 'birthday' => '1997-11-28', 'Position' => 'Forward','Number' => 31],
            ['firstName' => 'Matthis', 'lastName' => 'Abline', 'birthday' => '2003-03-28', 'Position' => 'Forward','Number' => 39],
            ['firstName' => 'Adel', 'lastName' => 'Mahamoud', 'birthday' => '2003-02-04', 'Position' => 'Forward','Number' => 54],
            ['firstName' => 'Omar Abbas', 'lastName' => 'Mvungi', 'birthday' => '2004-09-08', 'Position' => 'Forward','Number' => 56],
            ['firstName' => 'Joe-Loïc', 'lastName' => 'Affamah', 'birthday' => '2002-06-29', 'Position' => 'Forward','Number' => 61],

        ];

        foreach ($players as $playerData) {
            $player = new NantesPlayers();
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