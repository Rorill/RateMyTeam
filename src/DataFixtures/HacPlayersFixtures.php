<?php
namespace App\DataFixtures;

use App\Entity\Players;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\Integer;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class HacPlayersFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $Hac = $this->getReference('HAC');

        $players = [
            // goals
            ['firstName' => 'Mathieu', 'lastName'=> 'Gorgelin', 'birthday' => '1990-08-05', 'Position' => 'Goal','Number' => 1],
            ['firstName' => 'Arthur','lastName'=> 'Desmas', 'birthday' => '1994-04-07', 'Position' => 'Goal','Number' => 30],
            ['firstName' => 'Paul', 'lastName'=> 'Argney', 'birthday' => '2006-05-23', 'Position' => 'Goal','Number' => 50],


            // defenders

            ['firstName' => 'Gautier', 'lastName'=> 'Lloris', 'birthday' => '1995-07-18', 'Position' => 'Defender','Number' => 4],
            ['firstName' => 'Etienne', 'lastName'=> 'Youte', 'birthday' => '2002-01-14', 'Position' => 'Defender','Number' => 6],
            ['firstName' => 'Loïc', 'lastName'=> 'Nego', 'birthday' => '1991-01-15', 'Position' => 'Defender','Number' => 7],
            ['firstName' => 'Matheo', 'lastName'=> 'Bodmer', 'birthday' => '2004-05-06', 'Position' => 'Defender','Number' => 12],
            ['firstName' => 'Oualid', 'lastName' => 'El Hajjam', 'birthday' => '1991-02-19', 'Position' => 'Defender','Number' => 17],
            ['firstName' => 'Yanis', 'lastName' => 'Zouaoui', 'birthday' => '1998-04-28', 'Position' => 'Defender','Number' => 18],
            ['firstName' => 'Yoann', 'lastName' => 'Salmier', 'birthday' => '1992-11-21', 'Position' => 'Defender','Number' => 22],
            ['firstName' => 'Christopher', 'lastName' => 'Operi', 'birthday' => '1997-04-29', 'Position' => 'Defender','Number' => 27],
            ['firstName' => 'Timothée', 'lastName' => 'Pembele', 'birthday' => '2002-09-09', 'Position' => 'Defender','Number' => 32],
            ['firstName' => 'Arouna', 'lastName' => 'Sangante', 'birthday' => '2002-04-12', 'Position' => 'Defender','Number' => 93],


            // midfileders

            ['firstName' => 'Oussama', 'lastName' => 'Targhalline', 'birthday' => '2002-05-20', 'Position' => 'Midfielder','Number' => 5],
            ['firstName' => 'Yassine', 'lastName' => 'Kechta', 'birthday' => '2002-02-25', 'Position' => 'Midfielder','Number' => 8],
            ['firstName' => 'Daler', 'lastName' => 'Kuziaev', 'birthday' => '1993-01-15', 'Position' => 'Midfielder','Number' => 14],
            ['firstName' => 'Rassoul', 'lastName' => 'Ndiaye', 'birthday' => '2001-12-11', 'Position' => 'Midfielder','Number' => 19],
            ['firstName' => 'Guy-Noël', 'lastName' => 'Zohouri', 'birthday' => '2007-02-01', 'Position' => 'Midfielder','Number' => 24],
            ['firstName' => 'Alois', 'lastName' => 'Confais', 'birthday' => '1996-09-07', 'Position' => 'Midfielder','Number' => 25],
            ['firstName' => 'Ismail', 'lastName' => 'Bouneb', 'birthday' => '2006-06-07', 'Position' => 'Midfielder','Number' => 44],
            ['firstName' => 'Daren', 'lastName' => 'Mosengo', 'birthday' => '2006-08-11', 'Position' => 'Midfielder','Number' => 78],
            ['firstName' => 'Abdoulaye', 'lastName' => 'Toure', 'birthday' => '1994-03-03', 'Position' => 'Midfielder','Number' => 94],




            //Forward
            ['firstName' => 'Yann', 'lastName' => 'Kitala', 'birthday' => '1998-04-09', 'Position' => 'Forward','Number' => 9],
            ['firstName' => 'Josue', 'lastName' => 'Casimir', 'birthday' => '2001-09-24', 'Position' => 'Forward','Number' => 10],
            ['firstName' => 'Emmanuel', 'lastName' => 'Sabbi', 'birthday' => '1997-12-24', 'Position' => 'Forward','Number' => 11],
            ['firstName' => 'Elysee', 'lastName' => 'Logbo', 'birthday' => '2004-05-06', 'Position' => 'Forward','Number' => 20],
            ['firstName' => 'André', 'lastName' => 'Ayew', 'birthday' => '1989-12-17', 'Position' => 'Forward','Number' => 28],
            ['firstName' => 'Samuel', 'lastName' => 'Grandsir', 'birthday' => '1996-08-14', 'Position' => 'Forward','Number' => 29],
            ['firstName' => 'Issa', 'lastName' => 'Soumare', 'birthday' => '2000-10-10', 'Position' => 'Forward','Number' => 45],
            ['firstName' => 'Ilyes', 'lastName' => 'Housni', 'birthday' => '2005-02-14', 'Position' => 'Forward','Number' => 46],
            ['firstName' => 'Ruben', 'lastName' => 'Londja', 'birthday' => '2008-06-10', 'Position' => 'Forward','Number' => 70],
            ['firstName' => 'Steve', 'lastName' => 'Ngoura', 'birthday' => '2005-02-22', 'Position' => 'Forward','Number' => 77],

        ];

        foreach ($players as $playerData) {
            $player = new Players();
            $player->setFirstName($playerData['firstName']);
            $player->setLastName($playerData['lastName']);
            $player->setBirthday(new \DateTimeImmutable($playerData['birthday']));
            $player->setPosition($playerData['Position']);
            $player->setNumber($playerData['Number']);
            $player->setTeam($Hac);

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
