<?php
namespace App\DataFixtures;

use App\Entity\Players;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\Integer;

class RennesPlayersFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $Rennes = $this->getReference('SRFC');
        $players = [



            // Goalkeepers
            ['firstName' => 'Gauthier', 'lastName' => 'Gallon', 'birthday' => '1993-04-23', 'Position' => 'Goal','Number' => 23],
            ['firstName' => 'Steve', 'lastName'=> 'Mandanda', 'birthday' => '1985-05-28', 'Position' => 'Goal','Number' => 30],
            ['firstName' => 'Geoffrey', 'lastName'=> 'Lembet', 'birthday' => '1988-09-23', 'Position' => 'Goal','Number' => 40],
            ['firstName' => 'Dogan', 'lastName'=> 'Alemdar', 'birthday' => '2002-10-29', 'Position' => 'Goal','Number' => 80],



            // Defenders
            ['firstName' => 'Adrien','lastName'=> 'Truffert', 'birthday' => '2001-11-20', 'Position' => 'Defender','Number' => 3],
            ['firstName' => 'Christopher', 'lastName'=> 'Wooh', 'birthday' => '2001-09-18', 'Position' => 'Defender','Number' => 4],
            ['firstName' => 'Mikayil', 'lastName' => 'Faye', 'birthday' => '2004-07-14', 'Position' => 'Defender','Number' => 15],
            ['firstName' => 'Mahamadou', 'lastName' => 'Nagida ', 'birthday' => '2005-06-28', 'Position' => 'Defender','Number' => 18],
            ['firstName' => 'Lorenz', 'lastName' => 'Assignon', 'birthday' => '2000-06-22', 'Position' => 'Defender','Number' => 22],
            ['firstName' => 'Abdelhamid', 'lastName' => 'Ait Boudlal', 'birthday' => '2006-04-16', 'Position' => 'Defender','Number' => 48],
            ['firstName' => 'Leo', 'lastName' => 'Østigård', 'birthday' => '1999-11-28', 'Position' => 'Defender','Number' => 55],

            // Midfielders
            ['firstName' => 'Azor', 'lastName' => 'Matusiwa', 'birthday' => '1998-02-28', 'Position' => 'Midfielder','Number' => 6],
            ['firstName' => 'Albert', 'lastName' => 'Grønbæk', 'birthday' => '2001-05-23', 'Position' => 'Midfielder','Number' => 7],
            ['firstName' => 'Baptiste', 'lastName' => 'Santamaria', 'birthday' => '1995-03-09', 'Position' => 'Midfielder','Number' => 8],
            ['firstName' => 'Ludovic', 'lastName' => 'Blas', 'birthday' => '1997-12-31', 'Position' => 'Midfielder','Number' => 11],
            ['firstName' => 'Jordan', 'lastName' => 'James', 'birthday' => '2004-07-02', 'Position' => 'Midfielder','Number' => 17],
            ['firstName' => 'Glen', 'lastName' => 'Kamara', 'birthday' => '1995-10-28', 'Position' => 'Midfielder','Number' => 28],
            ['firstName' => 'Naouirou', 'lastName' => 'Ahamada', 'birthday' => '2002-03-29', 'Position' => 'Midfielder','Number' => 32],
            ['firstName' => 'Hans', 'lastName' => 'Hateboer', 'birthday' => '1994-01-09', 'Position' => 'Midfielder','Number' => 33],
            ['firstName' => 'Alidu', 'lastName' => 'Seidu', 'birthday' => '2000-06-04', 'Position' => 'Midfielder','Number' => 36],
            ['firstName' => 'Djaoui', 'lastName' => 'Cisse', 'birthday' => '2004-01-31', 'Position' => 'Midfielder','Number' => 38],


            // Forwards
            ['firstName' => 'Arnaud', 'lastName' => 'Kalimuendo', 'birthday' => '2002-01-20', 'Position' => 'Forward','Number' => 9],
            ['firstName' => 'Amine', 'lastName' => 'Gouiri', 'birthday' => '2000-02-16', 'Position' => 'Forward','Number' => 10],
            ['firstName' => 'Henrik', 'lastName' => 'Meister', 'birthday' => '2003-11-13', 'Position' => 'Forward','Number' => 19],
            ['firstName' => 'Andrés', 'lastName' => 'Gomez', 'birthday' => '2002-09-12', 'Position' => 'Forward','Number' => 20],
            ['firstName' => 'João Pedro Neves Filipe', 'lastName' => 'Jota', 'birthday' => '1999-03-30', 'Position' => 'Forward','Number' => 27],
            ['firstName' => 'Wilson', 'lastName' => 'Samake', 'birthday' => '2004-03-30', 'Position' => 'Forward','Number' => 52],
        ];

        foreach ($players as $playerData) {
            $player = new Players();
            $player->setFirstName($playerData['firstName']);
            $player->setLastName($playerData['lastName']);
            $player->setBirthday(new \DateTimeImmutable($playerData['birthday']));
            $player->setPosition($playerData['Position']);
            $player->setNumber($playerData['Number']);
            $player->setTeam($Rennes);

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
