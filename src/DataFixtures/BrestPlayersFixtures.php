<?php
namespace App\DataFixtures;

use App\Entity\Players;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\Integer;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class BrestPlayersFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {
        $brest = $this->getReference('Brest');

        $players = [
            // goals
            ['firstName' => 'Grégoire', 'lastName'=> 'Coudert', 'birthday' => '1999-04-03', 'Position' => 'Goal','Number' => 30],
            ['firstName' => 'Marco','lastName'=> 'Bizot', 'birthday' => '1991-03-10', 'Position' => 'Goal','Number' => 40],
            ['firstName' => 'Noah', 'lastName'=> 'Jauny', 'birthday' => '2004-08-26', 'Position' => 'Goal','Number' => 50],


            // defenders

            ['firstName' => 'Bradley', 'lastName'=> 'Locko', 'birthday' => '2002-05-06', 'Position' => 'Defender','Number' => 2],
            ['firstName' => 'Abdoulaye', 'lastName'=> 'N\'\Diaye', 'birthday' => '2002-04-10', 'Position' => 'Defender','Number' => 3],
            ['firstName' => 'Brendan', 'lastName'=> 'Chardonnet', 'birthday' => '1994-12-22', 'Position' => 'Defender','Number' => 5],
            ['firstName' => 'Kenny', 'lastName'=> 'Lala', 'birthday' => '1991-10-03', 'Position' => 'Defender','Number' => 7],
            ['firstName' => 'Luck', 'lastName' => 'Zogbe', 'birthday' => '2005-03-24', 'Position' => 'Defender','Number' => 12],
            ['firstName' => 'Massadio', 'lastName' => 'Haidara', 'birthday' => '1992-12-02', 'Position' => 'Defender','Number' => 22],
            ['firstName' => 'Jordan', 'lastName' => 'Amavi', 'birthday' => '1994-03-09', 'Position' => 'Defender','Number' => 23],
            ['firstName' => 'Julien', 'lastName' => 'Le Cardinal', 'birthday' => '1997-08-03', 'Position' => 'Defender','Number' => 25],
            ['firstName' => 'Soumaïla', 'lastName' => 'Coulibaly', 'birthday' => '2003-10-14', 'Position' => 'Defender','Number' => 44],


            // midfileders

            ['firstName' => 'Edimilson', 'lastName' => 'Fernandes Ribeiro', 'birthday' => '1996-04-15', 'Position' => 'Midfielder','Number' => 6],
            ['firstName' => 'Hugo', 'lastName' => 'Magnetti', 'birthday' => '1998-05-30', 'Position' => 'Midfielder','Number' => 8],
            ['firstName' => 'Kamory', 'lastName' => 'Doumbia', 'birthday' => '2003-02-18', 'Position' => 'Midfielder','Number' => 9],
            ['firstName' => 'Romain', 'lastName' => 'Del Castillo', 'birthday' => '1996-03-29', 'Position' => 'Midfielder','Number' => 10],
            ['firstName' => 'Pierre', 'lastName' => 'Lees-Melou', 'birthday' => '1993-05-25', 'Position' => 'Midfielder','Number' => 20],
            ['firstName' => 'Romain', 'lastName' => 'Faivre', 'birthday' => '1998-07-14', 'Position' => 'Midfielder','Number' => 21],
            ['firstName' => 'Mathias', 'lastName' => 'Pereira Lage', 'birthday' => '1996-11-30', 'Position' => 'Midfielder','Number' => 26],
            ['firstName' => 'Jonas', 'lastName' => 'Martin', 'birthday' => '1990-04-16', 'Position' => 'Midfielder','Number' => 28],
            ['firstName' => 'Ibrahim', 'lastName' => 'Salah', 'birthday' => '2001-08-30', 'Position' => 'Midfielder','Number' => 34],
            ['firstName' => 'Mahdi', 'lastName' => 'Camara', 'birthday' => '1998-06-30', 'Position' => 'Midfielder','Number' => 45],




            //Forward
            ['firstName' => 'Axel', 'lastName' => 'Camblan', 'birthday' => '2003-08-30', 'Position' => 'Forward','Number' => 11],
            ['firstName' => 'Mama', 'lastName' => 'Baldé', 'birthday' => '1995-11-06', 'Position' => 'Forward','Number' => 14],
            ['firstName' => 'Abdallah', 'lastName' => 'Sima', 'birthday' => '2001-06-17', 'Position' => 'Forward','Number' => 17],
            ['firstName' => 'Lassine', 'lastName' => 'Ajorque', 'birthday' => '1994-02-25', 'Position' => 'Forward','Number' => 19],

        ];

        foreach ($players as $playerData) {
            $player = new Players();
            $player->setFirstName($playerData['firstName']);
            $player->setLastName($playerData['lastName']);
            $player->setBirthday(new \DateTimeImmutable($playerData['birthday']));
            $player->setPosition($playerData['Position']);
            $player->setNumber($playerData['Number']);
            $player->setTeam($brest);

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

