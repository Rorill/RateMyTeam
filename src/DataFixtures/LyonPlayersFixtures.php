<?php
namespace App\DataFixtures;

use App\Entity\Players;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\Integer;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class LyonPlayersFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $Lyon = $this->getReference('OL');
        $players = [

            // Goalkeepers
            ['firstName' => 'Anthony', 'lastName' => 'Lopes', 'birthday' => '1990-10-01', 'Position' => 'Goal','Number' => 1],
            ['firstName' => 'Lucas', 'lastName'=> 'Perri', 'birthday' => '1997-12-10', 'Position' => 'Goal','Number' => 23],
            ['firstName' => 'Justin', 'lastName'=> 'Bengui', 'birthday' => '2005-07-09', 'Position' => 'Goal','Number' => 30],
            ['firstName' => 'Remy', 'lastName'=> 'Descamps', 'birthday' => '1996-06-25', 'Position' => 'Goal','Number' => 40],
            ['firstName' => 'Lassine', 'lastName'=> 'Diarra', 'birthday' => '2002-11-11', 'Position' => 'Goal','Number' => 50],



            // Defenders
            ['firstName' => 'Nicolás','lastName'=> 'Tagliafico', 'birthday' => '1992-08-31', 'Position' => 'Defender','Number' => 3],
            ['firstName' => 'Abner Vinicius', 'lastName'=> 'Da Silva Santos', 'birthday' => '2000-05-27', 'Position' => 'Defender','Number' => 16],
            ['firstName' => 'Moussa', 'lastName' => 'Niakhate', 'birthday' => '1996-03-08', 'Position' => 'Defender','Number' => 19],
            ['firstName' => 'Saël', 'lastName' => 'Kumbedi', 'birthday' => '2005-03-26', 'Position' => 'Defender','Number' => 20],
            ['firstName' => 'Clinton', 'lastName' => 'Mata', 'birthday' => '1992-11-07', 'Position' => 'Defender','Number' => 22],
            ['firstName' => 'Warmed', 'lastName' => 'Omari', 'birthday' => '2000-04-23', 'Position' => 'Defender','Number' => 27],
            ['firstName' => 'Duje', 'lastName' => 'Caleta-Car', 'birthday' => '1996-09-17', 'Position' => 'Defender','Number' => 55],
            ['firstName' => 'Ainsley', 'lastName' => 'Maitland-Niles', 'birthday' => '1997-08-29', 'Position' => 'Defender','Number' => 98],

            // Midfielders
            ['firstName' => 'Paul', 'lastName' => 'Akouokou', 'birthday' => '1997-12-20', 'Position' => 'Midfielder','Number' => 4],
            ['firstName' => 'Maxence', 'lastName' => 'Caqueret', 'birthday' => '2000-02-15', 'Position' => 'Midfielder','Number' => 6],
            ['firstName' => 'Jordan', 'lastName' => 'Veretout', 'birthday' => '1993-03-01', 'Position' => 'Midfielder','Number' => 7],
            ['firstName' => 'Corentin', 'lastName' => 'Tolisso', 'birthday' => '1994-08-03', 'Position' => 'Midfielder','Number' => 8],
            ['firstName' => 'Francis', 'lastName' => 'Tessmann', 'birthday' => '2001-09-24', 'Position' => 'Midfielder','Number' => 15],
            ['firstName' => 'Chaïm', 'lastName' => 'El Djebali', 'birthday' => '2004-02-07', 'Position' => 'Midfielder','Number' => 26],
            ['firstName' => 'Florent', 'lastName' => 'Da Silva', 'birthday' => '2003-04-02', 'Position' => 'Midfielder','Number' => 28],
            ['firstName' => 'Nemanja', 'lastName' => 'Matic', 'birthday' => '1988-08-01', 'Position' => 'Midfielder','Number' => 31],
            ['firstName' => 'Mahamadou', 'lastName' => 'Diawara', 'birthday' => '2005-02-17', 'Position' => 'Midfielder','Number' => 34],

            // Forwards
            ['firstName' => 'Gift', 'lastName' => 'Orban', 'birthday' => '2002-07-17', 'Position' => 'Forward','Number' => 9],
            ['firstName' => 'Alexandre', 'lastName' => 'Lacazette', 'birthday' => '1991-05-28', 'Position' => 'Forward','Number' => 10],
            ['firstName' => 'Malick', 'lastName' => 'Fofana', 'birthday' => '2005-03-31', 'Position' => 'Forward','Number' => 11],
            ['firstName' => 'Wilfried', 'lastName' => 'Zaha', 'birthday' => '1992-11-10', 'Position' => 'Forward','Number' => 12],
            ['firstName' => 'Saïd', 'lastName' => 'Benrahma', 'birthday' => '1995-08-10', 'Position' => 'Forward','Number' => 17],
            ['firstName' => 'Rayan', 'lastName' => 'Cherki', 'birthday' => '2003-08-17', 'Position' => 'Forward','Number' => 18],
            ['firstName' => 'Enzo', 'lastName' => 'Molebe', 'birthday' => '2007-09-18', 'Position' => 'Forward','Number' => 29],
            ['firstName' => 'Ernest', 'lastName' => 'Nuamah', 'birthday' => '2003-11-01', 'Position' => 'Forward','Number' => 37],
            ['firstName' => 'Georges', 'lastName' => 'Mikautadze', 'birthday' => '2000-10-31', 'Position' => 'Forward','Number' => 69],

        ];

        foreach ($players as $playerData) {
            $player = new Players();
            $player->setFirstName($playerData['firstName']);
            $player->setLastName($playerData['lastName']);
            $player->setBirthday(new \DateTimeImmutable($playerData['birthday']));
            $player->setPosition($playerData['Position']);
            $player->setNumber($playerData['Number']);
            $player->setTeam($Lyon);

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

