<?php
namespace App\DataFixtures;

use App\Entity\Players;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\Integer;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ToulousePlayersFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $Toulouse = $this->getReference('TFC');
        $players = [



            // Goalkeepers
            ['firstName' => 'Alex', 'lastName' => 'Dominguez', 'birthday' => '1998-07-30', 'Position' => 'Goal','Number' => 30],
            ['firstName' => 'Justin', 'lastName'=> 'Lacombe', 'birthday' => '2003-04-09', 'Position' => 'Goal','Number' => 40],
            ['firstName' => 'Guillaume', 'lastName'=> 'Restes', 'birthday' => '2005-03-11', 'Position' => 'Goal','Number' => 50],
            ['firstName' => 'Mathys Sauveur', 'lastName'=> 'Niflore', 'birthday' => '2007-03-02', 'Position' => 'Goal','Number' => 60],



            // Defenders
            ['firstName' => 'Rasmus','lastName'=> 'Nicolaisen', 'birthday' => '1997-03-16', 'Position' => 'Defender','Number' => 2],
            ['firstName' => 'Mark', 'lastName'=> 'Mckenzie', 'birthday' => '1999-02-25', 'Position' => 'Defender','Number' => 3],
            ['firstName' => 'Charlie', 'lastName' => 'Cresswell', 'birthday' => '2002-08-17', 'Position' => 'Defender','Number' => 4],
            ['firstName' => 'Umit', 'lastName' => 'Akdag ', 'birthday' => '2003-10-06', 'Position' => 'Defender','Number' => 6],
            ['firstName' => 'Warren', 'lastName' => 'Kamanzi', 'birthday' => '2000-11-11', 'Position' => 'Defender','Number' => 12],
            ['firstName' => 'Gabriel', 'lastName' => 'Suazo', 'birthday' => '1997-08-09', 'Position' => 'Defender','Number' => 17],
            ['firstName' => 'Djibril', 'lastName' => 'Sidibe', 'birthday' => '1992-07-29', 'Position' => 'Defender','Number' => 19],
            ['firstName' => 'Dayann', 'lastName' => 'Methalie', 'birthday' => '2006-02-15', 'Position' => 'Defender','Number' => 24],
            ['firstName' => 'Ylies', 'lastName' => 'Aradj', 'birthday' => '2005-06-05', 'Position' => 'Defender','Number' => 26],
            ['firstName' => 'Nicolas', 'lastName' => 'Wasbauer', 'birthday' => '2004-07-04', 'Position' => 'Defender','Number' => 27],
            ['firstName' => 'Jaydee', 'lastName' => 'Canvot', 'birthday' => '2006-07-29', 'Position' => 'Defender','Number' => 29],

            // Midfielders
            ['firstName' => 'Denis', 'lastName' => 'Genreau', 'birthday' => '1999-05-21', 'Position' => 'Midfielder','Number' => 5],
            ['firstName' => 'Vincent', 'lastName' => 'Sierro', 'birthday' => '1995-10-08', 'Position' => 'Midfielder','Number' => 8],
            ['firstName' => 'Yann', 'lastName' => 'Gboho', 'birthday' => '2001-01-14', 'Position' => 'Midfielder','Number' => 10],
            ['firstName' => 'Aron', 'lastName' => 'Donnum', 'birthday' => '1998-04-20', 'Position' => 'Midfielder','Number' => 15],
            ['firstName' => 'Niklas', 'lastName' => 'Schmidt', 'birthday' => '1998-03-01', 'Position' => 'Midfielder','Number' => 20],
            ['firstName' => 'Miha', 'lastName' => 'Zajc', 'birthday' => '1994-07-01', 'Position' => 'Midfielder','Number' => 21],
            ['firstName' => 'Rafik', 'lastName' => 'Messali', 'birthday' => '2003-04-28', 'Position' => 'Midfielder','Number' => 22],
            ['firstName' => 'Cristian', 'lastName' => 'Casseres Jr', 'birthday' => '2000-01-20', 'Position' => 'Midfielder','Number' => 23],
            ['firstName' => 'Mathis', 'lastName' => 'Saka', 'birthday' => '2006-09-20', 'Position' => 'Midfielder','Number' => 39],


            // Forwards
            ['firstName' => 'Zakaria', 'lastName' => 'Aboukhlal', 'birthday' => '2000-02-18', 'Position' => 'Forward','Number' => 7],
            ['firstName' => 'Frank', 'lastName' => 'Magri', 'birthday' => '1999-09-04', 'Position' => 'Forward','Number' => 9],
            ['firstName' => 'Joshua', 'lastName' => 'King', 'birthday' => '1992-01-15', 'Position' => 'Forward','Number' => 13],
            ['firstName' => 'Noah', 'lastName' => 'Edjouma', 'birthday' => '2005-10-04', 'Position' => 'Forward','Number' => 31],
            ['firstName' => 'Edhy', 'lastName' => 'Zuliani', 'birthday' => '2004-08-11', 'Position' => 'Forward','Number' => 37],
            ['firstName' => 'Shavy', 'lastName' => 'Babicka', 'birthday' => '2000-06-01', 'Position' => 'Forward','Number' => 80],
        ];

        foreach ($players as $playerData) {
            $player = new Players();
            $player->setFirstName($playerData['firstName']);
            $player->setLastName($playerData['lastName']);
            $player->setBirthday(new \DateTimeImmutable($playerData['birthday']));
            $player->setPosition($playerData['Position']);
            $player->setNumber($playerData['Number']);
            $player->setTeam($Toulouse);

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
