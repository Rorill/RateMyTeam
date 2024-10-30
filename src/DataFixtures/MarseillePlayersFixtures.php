<?php
namespace App\DataFixtures;

use App\Entity\Players;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\Integer;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class MarseillePlayersFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $Marseille = $this->getReference('OM');
        $players = [

            // Goalkeepers
            ['firstName' => 'Géronimo', 'lastName' => 'Rulli', 'birthday' => '1992-05-20', 'Position' => 'Goal','Number' => 1],
            ['firstName' => 'Jeffrey', 'lastName'=> 'De Lange', 'birthday' => '1998-04-01', 'Position' => 'Goal','Number' => 12],
            ['firstName' => 'Ruben', 'lastName'=> 'Blanco', 'birthday' => '1995-07-25', 'Position' => 'Goal','Number' => 36],
            ['firstName' => 'Jelle', 'lastName'=> 'Van Neck', 'birthday' => '2004-03-07', 'Position' => 'Goal','Number' => 40],



            // Defenders
            ['firstName' => 'Quentin','lastName'=> 'Merlin', 'birthday' => '2002-05-16', 'Position' => 'Defender','Number' => 3],
            ['firstName' => 'Leonardo', 'lastName'=> 'Balerdi', 'birthday' => '1999-01-26', 'Position' => 'Defender','Number' => 5],
            ['firstName' => 'Ulisses', 'lastName' => 'Garcia', 'birthday' => '1996-01-11', 'Position' => 'Defender','Number' => 6],
            ['firstName' => 'Derek', 'lastName' => 'Cornelius', 'birthday' => '1997-11-25', 'Position' => 'Defender','Number' => 13],
            ['firstName' => 'Bamo', 'lastName' => 'Meite', 'birthday' => '2001-12-03', 'Position' => 'Defender','Number' => 18],
            ['firstName' => 'Lilian', 'lastName' => 'Brassier', 'birthday' => '1999-11-02', 'Position' => 'Defender','Number' => 20],
            ['firstName' => 'Pol', 'lastName' => 'Lirola', 'birthday' => '1997-08-13', 'Position' => 'Defender','Number' => 29],
            ['firstName' => 'Stéphane', 'lastName' => 'Sparagna', 'birthday' => '1995-02-17', 'Position' => 'Defender','Number' => 33],
            ['firstName' => 'Roggerio', 'lastName' => 'Nyakossi', 'birthday' => '2004-01-13', 'Position' => 'Defender','Number' => 46],
            ['firstName' => 'Yakine', 'lastName' => 'Said Mmadi', 'birthday' => '1995-02-17', 'Position' => 'Defender','Number' => 48],
            ['firstName' => 'Amir', 'lastName' => 'Murillo', 'birthday' => '1995-02-17', 'Position' => 'Defender','Number' => 62],
            ['firstName' => 'Chancel', 'lastName' => 'Mbemba', 'birthday' => '1995-02-17', 'Position' => 'Defender','Number' => 99],

            // Midfielders
            ['firstName' => 'Matteo', 'lastName' => 'Guendouzi', 'birthday' => '1999-04-14', 'Position' => 'Midfielder','Number' => 6],
            ['firstName' => 'Valentin', 'lastName' => 'Carboni', 'birthday' => '2000-02-15', 'Position' => 'Midfielder','Number' => 7],
            ['firstName' => 'Amine', 'lastName' => 'Harit', 'birthday' => '1997-06-18', 'Position' => 'Midfielder','Number' => 11],
            ['firstName' => 'Geoffrey', 'lastName' => 'Kondogbia', 'birthday' => '1993-02-15', 'Position' => 'Midfielder','Number' => 19],
            ['firstName' => 'Valentin', 'lastName' => 'Rongier', 'birthday' => '1994-12-07', 'Position' => 'Midfielder','Number' => 21],
            ['firstName' => 'Pierre-Emile', 'lastName' => 'Højbjerg', 'birthday' => '1995-08-05', 'Position' => 'Midfielder','Number' => 23],
            ['firstName' => 'Adrien', 'lastName' => 'Rabiot', 'birthday' => '1995-04-03', 'Position' => 'Midfielder','Number' => 25],
            ['firstName' => 'Bilal', 'lastName' => 'Nadir', 'birthday' => '2003-11-28', 'Position' => 'Midfielder','Number' => 26],
            ['firstName' => 'Emran', 'lastName' => 'Soglo', 'birthday' => '2005-07-11', 'Position' => 'Midfielder','Number' => 37],
            ['firstName' => 'Raimane', 'lastName' => 'Daou', 'birthday' => '2004-11-20', 'Position' => 'Midfielder','Number' => 42],
            ['firstName' => 'Gael', 'lastName' => 'Lafont', 'birthday' => '2006-06-07', 'Position' => 'Midfielder','Number' => 47],
            ['firstName' => 'Darryl', 'lastName' => 'Bakola', 'birthday' => '2007-11-30', 'Position' => 'Midfielder','Number' => 50],
            ['firstName' => 'Ismaël', 'lastName' => 'Kone', 'birthday' => '2002-06-16', 'Position' => 'Midfielder','Number' => 51],


            // Forwards
            ['firstName' => 'Neal', 'lastName' => 'Maupay', 'birthday' => '1996-08-14', 'Position' => 'Forward','Number' => 8],
            ['firstName' => 'Elye', 'lastName' => 'Wahi', 'birthday' => '2003-01-02', 'Position' => 'Forward','Number' => 9],
            ['firstName' => 'Mason', 'lastName' => 'Greenwood', 'birthday' => '2001-10-01', 'Position' => 'Forward','Number' => 10],
            ['firstName' => 'Faris', 'lastName' => 'Moumbagna', 'birthday' => '2000-07-01', 'Position' => 'Forward','Number' => 14],
            ['firstName' => 'Jonathan', 'lastName' => 'Rowe', 'birthday' => '2003-04-30', 'Position' => 'Forward','Number' => 17],
            ['firstName' => 'Enzo', 'lastName' => 'Sternal', 'birthday' => '2007-07-28', 'Position' => 'Forward','Number' => 22],
            ['firstName' => 'François', 'lastName' => 'Mughe', 'birthday' => '2004-06-16', 'Position' => 'Forward','Number' => 24],
            ['firstName' => 'Sofiane', 'lastName' => 'Sidi Ali', 'birthday' => '1995-07-14', 'Position' => 'Forward','Number' => 41],
            ['firstName' => 'Emmanuel Alexi', 'lastName' => 'Koum Mbondo', 'birthday' => '2006-02-05', 'Position' => 'Forward','Number' => 43],
            ['firstName' => 'Luis', 'lastName' => 'Henrique', 'birthday' => '2001-12-14', 'Position' => 'Forward','Number' => 44],
            ['firstName' => 'Iùri', 'lastName' => 'Moreira', 'birthday' => '2004-03-20', 'Position' => 'Forward','Number' => 47],


        ];

        foreach ($players as $playerData) {
            $player = new Players();
            $player->setFirstName($playerData['firstName']);
            $player->setLastName($playerData['lastName']);
            $player->setBirthday(new \DateTimeImmutable($playerData['birthday']));
            $player->setPosition($playerData['Position']);
            $player->setNumber($playerData['Number']);
            $player->setTeam($Marseille);

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
