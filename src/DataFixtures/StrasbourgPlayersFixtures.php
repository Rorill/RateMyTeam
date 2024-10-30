<?php
namespace App\DataFixtures;

use App\Entity\Players;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\Integer;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class StrasbourgPlayersFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $Strasbourg = $this->getReference('RCSA');
        $players = [



            // Goalkeepers
            ['firstName' => 'Dorde', 'lastName' => 'Petrovic', 'birthday' => '1999-10-08', 'Position' => 'Goal','Number' => 1],
            ['firstName' => 'Robin', 'lastName'=> 'Risser', 'birthday' => '2004-12-02', 'Position' => 'Goal','Number' => 16],
            ['firstName' => 'Karl-Johan', 'lastName'=> 'Johnsson', 'birthday' => '1990-01-28', 'Position' => 'Goal','Number' => 30],
            ['firstName' => 'Alaa', 'lastName'=> 'Bellaarouch', 'birthday' => '2002-01-01', 'Position' => 'Goal','Number' => 36],
            ['firstName' => 'Walid', 'lastName'=> 'Hasbi', 'birthday' => '2004-01-07', 'Position' => 'Goal','Number' => 50],



            // Defenders
            ['firstName' => 'Thomas','lastName'=> 'Delaine', 'birthday' => '1992-03-24', 'Position' => 'Defender','Number' => 3],
            ['firstName' => 'Saïdou', 'lastName'=> 'Sow', 'birthday' => '2002-07-04', 'Position' => 'Defender','Number' => 4],
            ['firstName' => 'Abakar', 'lastName' => 'Sylla', 'birthday' => '2002-12-25', 'Position' => 'Defender','Number' => 5],
            ['firstName' => 'Caleb', 'lastName' => 'Wiley ', 'birthday' => '2004-12-22', 'Position' => 'Defender','Number' => 12],
            ['firstName' => 'Junior', 'lastName' => 'Mwanga', 'birthday' => '2003-05-11', 'Position' => 'Defender','Number' => 18],
            ['firstName' => 'Guéla', 'lastName' => 'Doue', 'birthday' => '2002-10-17', 'Position' => 'Defender','Number' => 22],
            ['firstName' => 'Mamadou', 'lastName' => 'Sarr', 'birthday' => '2005-08-29', 'Position' => 'Defender','Number' => 23],
            ['firstName' => 'Yoni', 'lastName' => 'Gomis', 'birthday' => '2005-09-23', 'Position' => 'Defender','Number' => 25],
            ['firstName' => 'Marvin', 'lastName' => 'Senaya', 'birthday' => '2001-01-29', 'Position' => 'Defender','Number' => 28],
            ['firstName' => 'Ismaël', 'lastName' => 'Doukoure', 'birthday' => '2003-07-24', 'Position' => 'Defender','Number' => 29],
            ['firstName' => 'Eduard', 'lastName' => 'Sobol', 'birthday' => '2003-02-20', 'Position' => 'Defender','Number' => 77],

            // Midfielders
            ['firstName' => 'Félix', 'lastName' => 'Lemarechal', 'birthday' => '2003-08-07', 'Position' => 'Midfielder','Number' => 6],
            ['firstName' => 'Andrey', 'lastName' => 'Santos', 'birthday' => '2004-05-03', 'Position' => 'Midfielder','Number' => 8],
            ['firstName' => 'Pape', 'lastName' => 'Diong', 'birthday' => '2006-06-15', 'Position' => 'Midfielder','Number' => 17],
            ['firstName' => 'Nolan', 'lastName' => 'Ferro', 'birthday' => '2006-01-18', 'Position' => 'Midfielder','Number' => 38],
            ['firstName' => 'Eliès', 'lastName' => 'Araar Fernandez', 'birthday' => '2006-10-07', 'Position' => 'Midfielder','Number' => 39],
            ['firstName' => 'Samir', 'lastName' => 'El Mourabet', 'birthday' => '2005-10-06', 'Position' => 'Midfielder','Number' => 39],
            ['firstName' => 'Abdoul', 'lastName' => 'Ouattara', 'birthday' => '2005-10-22', 'Position' => 'Midfielder','Number' => 42],


            // Forwards
            ['firstName' => 'Diego', 'lastName' => 'Moreira', 'birthday' => '2004-08-06', 'Position' => 'Forward','Number' => 7],
            ['firstName' => 'Miloš', 'lastName' => 'Lukovic', 'birthday' => '2005-11-18', 'Position' => 'Forward','Number' => 9],
            ['firstName' => 'Emanuel', 'lastName' => 'Emegha', 'birthday' => '2003-02-03', 'Position' => 'Forward','Number' => 10],
            ['firstName' => 'Moïse', 'lastName' => 'Sahi Dion', 'birthday' => '2001-12-20', 'Position' => 'Forward','Number' => 11],
            ['firstName' => 'Sekou', 'lastName' => 'Mara', 'birthday' => '2002-07-30', 'Position' => 'Forward','Number' => 14],
            ['firstName' => 'Sebastian', 'lastName' => 'Nanasi', 'birthday' => '2002-05-16', 'Position' => 'Forward','Number' => 15],
            ['firstName' => 'Habib', 'lastName' => 'Diarra', 'birthday' => '2004-01-03', 'Position' => 'Forward','Number' => 19],
            ['firstName' => 'Dilane', 'lastName' => 'Bakwa', 'birthday' => '2002-08-26', 'Position' => 'Forward','Number' => 26],
            ['firstName' => 'Tidiane', 'lastName' => 'Diallo', 'birthday' => '2006-05-28', 'Position' => 'Forward','Number' => 35],
            ['firstName' => 'Jérémy', 'lastName' => 'Sebas', 'birthday' => '2003-04-14', 'Position' => 'Forward','Number' => 40],
        ];

        foreach ($players as $playerData) {
            $player = new Players();
            $player->setFirstName($playerData['firstName']);
            $player->setLastName($playerData['lastName']);
            $player->setBirthday(new \DateTimeImmutable($playerData['birthday']));
            $player->setPosition($playerData['Position']);
            $player->setNumber($playerData['Number']);
            $player->setTeam($Strasbourg);

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
