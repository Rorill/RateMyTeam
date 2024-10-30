<?php
namespace App\DataFixtures;

use App\Entity\Players;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\Integer;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class MontpellierPlayersFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {
        $Montpellier = $this->getReference('MHSC');

        $players = [


            // Goalkeepers
            ['firstName' => 'Belmin', 'lastName' => 'Dizdarevic', 'birthday' => '2001-08-09', 'Position' => 'Goal','Number' => 1],
            ['firstName' => 'Dimitry', 'lastName'=> 'Bertaud', 'birthday' => '1998-06-06', 'Position' => 'Goal','Number' => 16],
            ['firstName' => 'Benjamin', 'lastName'=> 'Lecomte', 'birthday' => '1991-04-26', 'Position' => 'Goal','Number' => 40],



            // Defenders
            ['firstName' => 'Issiaga','lastName'=> 'Sylla', 'birthday' => '1994-01-01', 'Position' => 'Defender','Number' => 3],
            ['firstName' => 'Boubakar Kiki', 'lastName'=> 'Kouyate', 'birthday' => '1997-04-15', 'Position' => 'Defender','Number' => 4],
            ['firstName' => 'Modibo', 'lastName' => 'Sagnan', 'birthday' => '1999-04-14', 'Position' => 'Defender','Number' => 5],
            ['firstName' => 'Christopher', 'lastName' => 'Jullien ', 'birthday' => '1993-04-22', 'Position' => 'Defender','Number' => 6],
            ['firstName' => 'Théo', 'lastName' => 'Sainte-Luce', 'birthday' => '1998-10-20', 'Position' => 'Defender','Number' => 17],
            ['firstName' => 'Lucas', 'lastName' => 'Mincarelli', 'birthday' => '2004-01-05', 'Position' => 'Defender','Number' => 21],
            ['firstName' => 'Becir', 'lastName' => 'Omeragic', 'birthday' => '2002-10-20', 'Position' => 'Defender','Number' => 27],
            ['firstName' => 'Enzo', 'lastName' => 'Tchato', 'birthday' => '2002-11-23', 'Position' => 'Defender','Number' => 29],
            ['firstName' => 'Falaye', 'lastName' => 'Sacko', 'birthday' => '1995-05-01', 'Position' => 'Defender','Number' => 77],

            // Midfielders
            ['firstName' => 'Mousa', 'lastName' => 'Tamari', 'birthday' => '1997-06-10', 'Position' => 'Midfielder','Number' => 9],
            ['firstName' => 'Téji', 'lastName' => 'Savanier', 'birthday' => '1991-12-22', 'Position' => 'Midfielder','Number' => 11],
            ['firstName' => 'Jordan', 'lastName' => 'Ferri', 'birthday' => '1992-03-12', 'Position' => 'Midfielder','Number' => 12],
            ['firstName' => 'Joris', 'lastName' => 'Chotard', 'birthday' => '2001-09-24', 'Position' => 'Midfielder','Number' => 13],
            ['firstName' => 'Othmane', 'lastName' => 'Maamma', 'birthday' => '2005-10-06', 'Position' => 'Midfielder','Number' => 14],
            ['firstName' => 'Gabriel', 'lastName' => 'Bares', 'birthday' => '2000-08-29', 'Position' => 'Midfielder','Number' => 15],
            ['firstName' => 'Rabby', 'lastName' => 'Nzingoula', 'birthday' => '2005-11-25', 'Position' => 'Midfielder','Number' => 19],
            ['firstName' => 'Birama', 'lastName' => 'Toure', 'birthday' => '1992-06-06', 'Position' => 'Midfielder','Number' => 20],
            ['firstName' => 'Khalil', 'lastName' => 'Fayad', 'birthday' => '2004-06-09', 'Position' => 'Midfielder','Number' => 22],


            // Forwards
            ['firstName' => 'Arnaud', 'lastName' => 'Nordin', 'birthday' => '1998-06-17', 'Position' => 'Forward','Number' => 7],
            ['firstName' => 'Akor', 'lastName' => 'Adams', 'birthday' => '2000-01-29', 'Position' => 'Forward','Number' => 8],
            ['firstName' => 'Wahbi', 'lastName' => 'Khazri', 'birthday' => '1991-02-08', 'Position' => 'Forward','Number' => 10],
            ['firstName' => 'Glenn', 'lastName' => 'Ngosso', 'birthday' => '2004-01-12', 'Position' => 'Forward','Number' => 28],
            ['firstName' => 'Tanguy', 'lastName' => 'Coulibaly', 'birthday' => '2001-02-18', 'Position' => 'Forward','Number' => 70],
        ];

        foreach ($players as $playerData) {
            $player = new Players();
            $player->setFirstName($playerData['firstName']);
            $player->setLastName($playerData['lastName']);
            $player->setBirthday(new \DateTimeImmutable($playerData['birthday']));
            $player->setPosition($playerData['Position']);
            $player->setNumber($playerData['Number']);
            $player->setTeam($Montpellier);

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
