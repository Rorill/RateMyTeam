<?php
namespace App\DataFixtures;

use App\Entity\Players;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\Integer;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class NicePlayersFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $Nice = $this->getReference('OGCN');
        $players = [



            // Goalkeepers
            ['firstName' => 'Marcin', 'lastName' => 'Bulka', 'birthday' => '1999-10-04', 'Position' => 'Goal','Number' => 1],
            ['firstName' => 'Maxime', 'lastName'=> 'Dupe', 'birthday' => '1998-04-02', 'Position' => 'Goal','Number' => 31],
            ['firstName' => 'Teddy', 'lastName'=> 'Boulhendi', 'birthday' => '2001-04-09', 'Position' => 'Goal','Number' => 77],



            // Defenders
            ['firstName' => 'Ali','lastName'=> 'Abdi', 'birthday' => '1993-12-20', 'Position' => 'Defender','Number' => 2],
            ['firstName' => 'Dante', 'lastName'=> 'Bonfim Costa Santos', 'birthday' => '1983-10-18', 'Position' => 'Defender','Number' => 4],
            ['firstName' => 'Mohamed', 'lastName' => 'Abdelmonem', 'birthday' => '1999-02-01', 'Position' => 'Defender','Number' => 5],
            ['firstName' => 'Antoine', 'lastName' => 'Mendy ', 'birthday' => '2004-05-27', 'Position' => 'Defender','Number' => 33],
            ['firstName' => 'Youssouf', 'lastName' => 'Ndayishimiye', 'birthday' => '1998-10-27', 'Position' => 'Defender','Number' => 55],
            ['firstName' => 'Moïse', 'lastName' => 'Bombito', 'birthday' => '2000-03-30', 'Position' => 'Defender','Number' => 64],
            ['firstName' => 'Jonathan', 'lastName' => 'Clauss', 'birthday' => '1992-09-24', 'Position' => 'Defender','Number' => 92],

            // Midfielders
            ['firstName' => 'Hicham', 'lastName' => 'Boudaoui', 'birthday' => '1999-09-23', 'Position' => 'Midfielder','Number' => 6],
            ['firstName' => 'Pablo', 'lastName' => 'Rosario', 'birthday' => '1997-01-07', 'Position' => 'Midfielder','Number' => 8],
            ['firstName' => 'Sofiane', 'lastName' => 'Diop', 'birthday' => '2000-06-09', 'Position' => 'Midfielder','Number' => 10],
            ['firstName' => 'Morgan', 'lastName' => 'Sanson', 'birthday' => '1994-08-18', 'Position' => 'Midfielder','Number' => 11],
            ['firstName' => 'Rares', 'lastName' => 'Ilie', 'birthday' => '2003-04-19', 'Position' => 'Midfielder','Number' => 18],
            ['firstName' => 'Tom', 'lastName' => 'Louchet', 'birthday' => '2003-05-04', 'Position' => 'Midfielder','Number' => 20],
            ['firstName' => 'Tanguy', 'lastName' => 'Ndombele', 'birthday' => '1996-12-28', 'Position' => 'Midfielder','Number' => 22],
            ['firstName' => 'Issiaga', 'lastName' => 'Camara', 'birthday' => '2005-02-02', 'Position' => 'Midfielder','Number' => 36],
            ['firstName' => 'Amidou', 'lastName' => 'Doumbouya', 'birthday' => '2006-06-01', 'Position' => 'Midfielder','Number' => 44],


            // Forwards
            ['firstName' => 'Jérémie', 'lastName' => 'Boga', 'birthday' => '1997-01-03', 'Position' => 'Forward','Number' => 7],
            ['firstName' => 'Terem', 'lastName' => 'Moffi', 'birthday' => '1999-05-25', 'Position' => 'Forward','Number' => 9],
            ['firstName' => 'Youssoufa', 'lastName' => 'Moukoko', 'birthday' => '2004-11-20', 'Position' => 'Forward','Number' => 15],
            ['firstName' => 'Badredine', 'lastName' => 'Bouanani', 'birthday' => '2004-12-08', 'Position' => 'Forward','Number' => 19],
            ['firstName' => 'Gaëtan', 'lastName' => 'Laborde', 'birthday' => '1994-05-03', 'Position' => 'Forward','Number' => 24],
            ['firstName' => 'Mohamed-Ali', 'lastName' => 'Cho', 'birthday' => '2004-01-19', 'Position' => 'Forward','Number' => 25],
            ['firstName' => 'Melvin', 'lastName' => 'Bard', 'birthday' => '2000-11-06', 'Position' => 'Forward','Number' => 26],
            ['firstName' => 'Evann', 'lastName' => 'Guessand', 'birthday' => '2001-07-01', 'Position' => 'Forward','Number' => 29],
            ['firstName' => 'Victor', 'lastName' => 'Orakpo', 'birthday' => '2005-06-22', 'Position' => 'Forward','Number' => 45],

        ];

        foreach ($players as $playerData) {
            $player = new Players();
            $player->setFirstName($playerData['firstName']);
            $player->setLastName($playerData['lastName']);
            $player->setBirthday(new \DateTimeImmutable($playerData['birthday']));
            $player->setPosition($playerData['Position']);
            $player->setNumber($playerData['Number']);
            $player->setTeam($Nice);

            $manager->persist($player);
        }


        $manager->flush();
    }
    public function getDependencies(): array
    {
        return [
            Ligue1TeamsFixtures::class,
        ];
    }

}
