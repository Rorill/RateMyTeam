<?php
namespace App\DataFixtures;

use App\Entity\Players;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\Integer;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class MonacoPlayersFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $Monaco = $this->getReference('ASM');
        $players = [



            // Goalkeepers
            ['firstName' => 'Radoslaw', 'lastName' => 'Majecki', 'birthday' => '1999-11-16', 'Position' => 'Goal','Number' => 1],
            ['firstName' => 'Philipp', 'lastName'=> 'Köhn', 'birthday' => '1998-04-02', 'Position' => 'Goal','Number' => 16],
            ['firstName' => 'Jules', 'lastName'=> 'Stawiecki', 'birthday' => '2007-04-10', 'Position' => 'Goal','Number' => 40],
            ['firstName' => 'Yann', 'lastName'=> 'Lienard', 'birthday' => '2003-03-16', 'Position' => 'Goal','Number' => 50],



            // Defenders
            ['firstName' => 'Vanderson','lastName'=> 'de Oliveira Campos', 'birthday' => '2001-06-21', 'Position' => 'Defender','Number' => 2],
            ['firstName' => 'Jordan', 'lastName'=> 'Teze', 'birthday' => '1999-09-30', 'Position' => 'Defender','Number' => 4],
            ['firstName' => 'Thilo', 'lastName' => 'Kehrer', 'birthday' => '1996-09-21', 'Position' => 'Defender','Number' => 5],
            ['firstName' => 'Caio', 'lastName' => 'Henrique ', 'birthday' => '1997-07-31', 'Position' => 'Defender','Number' => 12],
            ['firstName' => 'Wilfried', 'lastName' => 'Singo', 'birthday' => '2000-12-25', 'Position' => 'Defender','Number' => 17],
            ['firstName' => 'Kassoum', 'lastName' => 'Ouattara', 'birthday' => '2004-10-14', 'Position' => 'Defender','Number' => 20],
            ['firstName' => 'Mohammed', 'lastName' => 'Salisu', 'birthday' => '1999-02-17', 'Position' => 'Defender','Number' => 22],
            ['firstName' => 'Nazim', 'lastName' => 'Babai', 'birthday' => '2003-01-14', 'Position' => 'Defender','Number' => 43],
            ['firstName' => 'Samuel Kondi', 'lastName' => 'Nibombe', 'birthday' => '2007-08-15', 'Position' => 'Defender','Number' => 44],
            ['firstName' => 'Aurélien', 'lastName' => 'Platret', 'birthday' => '2003-02-20', 'Position' => 'Defender','Number' => 46],

            // Midfielders
            ['firstName' => 'Denis', 'lastName' => 'Zakaria', 'birthday' => '1996-11-20', 'Position' => 'Midfielder','Number' => 6],
            ['firstName' => 'Eliesse', 'lastName' => 'Ben Seghir', 'birthday' => '2005-02-16', 'Position' => 'Midfielder','Number' => 7],
            ['firstName' => 'Eliot', 'lastName' => 'Matazo', 'birthday' => '2002-02-15', 'Position' => 'Midfielder','Number' => 8],
            ['firstName' => 'Aleksandr', 'lastName' => 'Golovin', 'birthday' => '1996-05-30', 'Position' => 'Midfielder','Number' => 10],
            ['firstName' => 'Maghnes', 'lastName' => 'Akliouche', 'birthday' => '2002-02-25', 'Position' => 'Midfielder','Number' => 11],
            ['firstName' => 'Lamine', 'lastName' => 'Camara', 'birthday' => '2004-01-01', 'Position' => 'Midfielder','Number' => 15],
            ['firstName' => 'Mamadou', 'lastName' => 'Coulibaly', 'birthday' => '2004-04-21', 'Position' => 'Midfielder','Number' => 28],
            ['firstName' => 'Edan', 'lastName' => 'Diop', 'birthday' => '2004-08-28', 'Position' => 'Midfielder','Number' => 37],
            ['firstName' => 'Saïmon', 'lastName' => 'Bouabre', 'birthday' => '2006-06-01', 'Position' => 'Midfielder','Number' => 42],
            ['firstName' => 'Mayssam', 'lastName' => 'Benama', 'birthday' => '2005-03-09', 'Position' => 'Midfielder','Number' => 47],
            ['firstName' => 'Soungoutou', 'lastName' => 'Magassa', 'birthday' => '2003-10-08', 'Position' => 'Midfielder','Number' => 88],


            // Forwards
            ['firstName' => 'Folarin', 'lastName' => 'Balogun', 'birthday' => '2001-07-03', 'Position' => 'Forward','Number' => 9],
            ['firstName' => 'Takumi', 'lastName' => 'Minamino', 'birthday' => '1995-01-16', 'Position' => 'Forward','Number' => 18],
            ['firstName' => 'George', 'lastName' => 'Ilenikhena', 'birthday' => '2006-08-18', 'Position' => 'Forward','Number' => 21],
            ['firstName' => 'Krépin', 'lastName' => 'Diatta', 'birthday' => '1999-02-25', 'Position' => 'Forward','Number' => 27],
            ['firstName' => 'Breel', 'lastName' => 'Embolo', 'birthday' => '1997-02-14', 'Position' => 'Forward','Number' => 36],
            ['firstName' => 'Lucas', 'lastName' => 'Michal', 'birthday' => '2005-06-22', 'Position' => 'Forward','Number' => 41],
        ];

        foreach ($players as $playerData) {
            $player = new Players();
            $player->setFirstName($playerData['firstName']);
            $player->setLastName($playerData['lastName']);
            $player->setBirthday(new \DateTimeImmutable($playerData['birthday']));
            $player->setPosition($playerData['Position']);
            $player->setNumber($playerData['Number']);
            $player->setTeam($Monaco);

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
