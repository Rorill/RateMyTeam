<?php
namespace App\DataFixtures;

use App\Entity\Players;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\Integer;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
class AuxerrePlayersFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $AJA = $this->getReference('AJA');

        $players = [
            // goals
            ['firstName' => 'Donovan', 'lastName' => 'Leon', 'birthday' => '1992-11-03', 'Position' => 'Goal','Number' => 16],
            ['firstName' => 'Tom', 'lastName'=> 'Negrel', 'birthday' => '2003-04-13', 'Position' => 'Goal','Number' => 30],
            ['firstName' => 'Raphael', 'lastName'=> 'Adiceam', 'birthday' => '1990-07-03', 'Position' => 'Goal','Number' => 37],
            ['firstName' => 'Theo','lastName'=> 'De Percin', 'birthday' => '2001-02-02', 'Position' => 'Goal','Number' => 40],

            // defenders

            ['firstName' => 'Gabriel', 'lastName'=> 'Osho', 'birthday' => '1998-08-14', 'Position' => 'Defender','Number' => 3],
            ['firstName' => 'Jubal', 'lastName'=> 'Rocha Mendes Junior', 'birthday' => '1993-08-29', 'Position' => 'Defender','Number' => 4],
            ['firstName' => 'Théo', 'lastName'=> 'Pellenard', 'birthday' => '1994-03-04', 'Position' => 'Defender','Number' => 5],
            ['firstName' => 'Saad', 'lastName'=> 'Agouzoul', 'birthday' => '1997-08-10', 'Position' => 'Defender','Number' => 6],
            ['firstName' => 'Gideon', 'lastName' => 'Mensah', 'birthday' => '1998-07-18', 'Position' => 'Defender','Number' => 14],
            ['firstName' => 'Sinaly', 'lastName' => 'Diomande', 'birthday' => '2001-08-09', 'Position' => 'Defender','Number' => 20],
            ['firstName' => 'Ki-Jana', 'lastName' => 'Hoever', 'birthday' => '2002-01-18', 'Position' => 'Defender','Number' => 23],
            ['firstName' => 'Ange-Loic', 'lastName' => 'N\'\Gatta', 'birthday' => '2003-12-11', 'Position' => 'Defender','Number' => 24],
            ['firstName' => 'Paul', 'lastName' => 'Joly', 'birthday' => '2000-06-07', 'Position' => 'Defender','Number' => 26],
            ['firstName' => 'Madiou', 'lastName' => 'Keita', 'birthday' => '2004-08-29', 'Position' => 'Defender','Number' => 31],
            ['firstName' => 'Clément', 'lastName' => 'Akpa', 'birthday' => '2001-11-24', 'Position' => 'Defender','Number' => 92],

            // midfileders

            ['firstName' => 'Nathan', 'lastName' => 'Buayi-Kiala', 'birthday' => '2004-02-29', 'Position' => 'Midfielder','Number' => 8],
            ['firstName' => 'Assane', 'lastName' => 'Diousse', 'birthday' => '1997-09-20', 'Position' => 'Midfielder','Number' => 18],
            ['firstName' => 'Himad', 'lastName' => 'Abdelli', 'birthday' => '1999-11-17', 'Position' => 'Midfielder','Number' => 10],
            ['firstName' => 'Hamed Junior', 'lastName' => 'Traore', 'birthday' => '2000-01-14', 'Position' => 'Midfielder','Number' => 25],
            ['firstName' => 'Kevin', 'lastName' => 'Danois', 'birthday' => '2004-06-28', 'Position' => 'Midfielder','Number' => 27],
            ['firstName' => 'Nicolas', 'lastName' => 'Mercier', 'birthday' => '2003-01-30', 'Position' => 'Midfielder','Number' => 27],
            ['firstName' => 'Elisha', 'lastName' => 'Owusu', 'birthday' => '1997-11-07', 'Position' => 'Midfielder','Number' => 42],
            ['firstName' => 'Aristide', 'lastName' => 'Zossou', 'birthday' => '2005-06-14', 'Position' => 'Midfielder','Number' => 77],
            ['firstName' => 'Rayan', 'lastName' => 'Raveloson', 'birthday' => '1997-01-16', 'Position' => 'Midfielder','Number' => 97],



            //Forward
            ['firstName' => 'Theo', 'lastName' => 'Bair', 'birthday' => '1999-08-27', 'Position' => 'Forward','Number' => 9],
            ['firstName' => 'Gaetan', 'lastName' => 'Perrin', 'birthday' => '1996-06-07', 'Position' => 'Forward','Number' => 10],
            ['firstName' => 'Eros', 'lastName' => 'Maddy', 'birthday' => '2001-02-05', 'Position' => 'Forward','Number' => 11],
            ['firstName' => 'Lassine', 'lastName' => 'Sinayoko', 'birthday' => '1999-12-08', 'Position' => 'Forward','Number' => 17],
            ['firstName' => 'Florian', 'lastName' => 'Aye', 'birthday' => '1997-01-19', 'Position' => 'Forward','Number' => 19],
            ['firstName' => 'Lasso', 'lastName' => 'Coulibaly', 'birthday' => '2002-10-19', 'Position' => 'Forward','Number' => 21],
            ['firstName' => 'Tidiane', 'lastName' => 'Diawara', 'birthday' => '2005-04-29', 'Position' => 'Forward','Number' => 22],
            ['firstName' => 'Ado', 'lastName' => 'Onaiwu', 'birthday' => '1995-11-08', 'Position' => 'Forward','Number' => 45],
        ];

        foreach ($players as $playerData) {
            $player = new Players();
            $player->setFirstName($playerData['firstName']);
            $player->setLastName($playerData['lastName']);
            $player->setBirthday(new \DateTimeImmutable($playerData['birthday']));
            $player->setPosition($playerData['Position']);
            $player->setNumber($playerData['Number']);
            $player->setTeam($AJA);

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

