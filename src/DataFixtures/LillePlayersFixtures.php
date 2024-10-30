<?php
namespace App\DataFixtures;

use App\Entity\Players;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\Integer;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class LillePlayersFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $Lille = $this->getReference('LOSC');
        $players = [
            // goals
            ['firstName' => 'Vito', 'lastName'=> 'Mannone', 'birthday' => '1988-03-02', 'Position' => 'Goal','Number' => 1],
            ['firstName' => 'Marc-Aurèle','lastName'=> 'Caillard', 'birthday' => '1994-05-12', 'Position' => 'Goal','Number' => 16],
            ['firstName' => 'Lisandru', 'lastName'=> 'Olmeta', 'birthday' => '2005-07-21', 'Position' => 'Goal','Number' => 16],
            ['firstName' => 'Lucas', 'lastName'=> 'Chevalier', 'birthday' => '2001-11-6', 'Position' => 'Goal','Number' => 30],



            // defenders

            ['firstName' => 'Aissa', 'lastName'=> 'Mandi', 'birthday' => '1991-10-22', 'Position' => 'Defender','Number' => 2],
            ['firstName' => 'Victor de Souza Ribeiro', 'lastName'=> 'Alexsandro', 'birthday' => '1999-08-09', 'Position' => 'Defender','Number' => 4],
            ['firstName' => 'Gabriel', 'lastName'=> 'Gudmundsson', 'birthday' => '1999-04-29', 'Position' => 'Defender','Number' => 5],
            ['firstName' => 'Thomas', 'lastName'=> 'Meunier', 'birthday' => '1991-09-12', 'Position' => 'Defender','Number' => 12],
            ['firstName' => 'Akim', 'lastName' => 'Zedadka', 'birthday' => '1995-05-30', 'Position' => 'Defender','Number' => 13],
            ['firstName' => 'Samuel', 'lastName' => 'Umtiti', 'birthday' => '1993-11-14', 'Position' => 'Defender','Number' => 14],
            ['firstName' => 'Bafodé', 'lastName' => 'Diakite', 'birthday' => '2001-01-06', 'Position' => 'Defender','Number' => 18],
            ['firstName' => 'Tiago', 'lastName' => 'Santos', 'birthday' => '2002-07-23', 'Position' => 'Defender','Number' => 22],
            ['firstName' => 'Rafael', 'lastName' => 'Fernandes', 'birthday' => '2002-06-28', 'Position' => 'Defender','Number' => 28],
            ['firstName' => 'Ismaily', 'lastName' => 'Gonçalves dos Santos', 'birthday' => '1990-01-11', 'Position' => 'Defender','Number' => 31],
            ['firstName' => 'Isaac', 'lastName' => 'Cossier', 'birthday' => '2006-11-30', 'Position' => 'Defender','Number' => 35],
            ['firstName' => 'Adame', 'lastName' => 'Faïz', 'birthday' => '2005-06-10', 'Position' => 'Defender','Number' => 35],
            ['firstName' => 'Ousmane', 'lastName' => 'Touré', 'birthday' => '2005-02-18', 'Position' => 'Defender','Number' => 36],




            // midfileders

            ['firstName' => 'Nabil', 'lastName' => 'Bentaleb', 'birthday' => '1994-11-24', 'Position' => 'Midfielder','Number' => 6],
            ['firstName' => 'Hákon', 'lastName' => 'Haraldsson', 'birthday' => '2003-04-10', 'Position' => 'Midfielder','Number' => 7],
            ['firstName' => 'Osame', 'lastName' => 'Sahraoui', 'birthday' => '2001-06-11', 'Position' => 'Midfielder','Number' => 11],
            ['firstName' => 'Ngal\'\ayel', 'lastName' => 'Mukau', 'birthday' => '2004-11-03', 'Position' => 'Midfielder','Number' => 17],
            ['firstName' => 'Mitchel', 'lastName' => 'Bakker', 'birthday' => '2000-06-20', 'Position' => 'Midfielder','Number' => 20],
            ['firstName' => 'Benjamin', 'lastName' => 'Andre', 'birthday' => '1990-08-03', 'Position' => 'Midfielder','Number' => 21],
            ['firstName' => 'Edon', 'lastName' => 'Zhegrova', 'birthday' => '1999-03-31', 'Position' => 'Midfielder','Number' => 23],
            ['firstName' => 'André', 'lastName' => 'Gomes', 'birthday' => '1993-07-30', 'Position' => 'Midfielder','Number' => 26],
            ['firstName' => 'Ethan', 'lastName' => 'Mbappe', 'birthday' => '2006-12-29', 'Position' => 'Midfielder','Number' => 28],
            ['firstName' => 'Ayyoub', 'lastName' => 'Bouaddi', 'birthday' => '2007-10-02', 'Position' => 'Midfielder','Number' => 32],
            ['firstName' => 'Lilian', 'lastName' => 'Baret', 'birthday' => '2006-05-25', 'Position' => 'Midfielder','Number' => 39],
            ['firstName' => 'Valentin', 'lastName' => 'Vanbaleghem', 'birthday' => '2002-10-15', 'Position' => 'Midfielder','Number' => 41],





            //Forward
            ['firstName' => 'Angel', 'lastName' => 'Gomes', 'birthday' => '2000-08-31', 'Position' => 'Forward','Number' => 8],
            ['firstName' => 'Jonathan', 'lastName' => 'David', 'birthday' => '2000-01-14', 'Position' => 'Forward','Number' => 9],
            ['firstName' => 'Rémy', 'lastName' => 'Cabella', 'birthday' => '199-03-08', 'Position' => 'Forward','Number' => 10],
            ['firstName' => 'Matias', 'lastName' => 'Fernandez Pardo', 'birthday' => '1995-04-19', 'Position' => 'Forward','Number' => 19],
            ['firstName' => 'Mohamed', 'lastName' => 'Bayo', 'birthday' => '1998-06-04', 'Position' => 'Forward','Number' => 27],
            ['firstName' => 'Aaron', 'lastName' => 'Malouda', 'birthday' => '2005-11-30', 'Position' => 'Forward','Number' => 34],


        ];

        foreach ($players as $playerData) {
            $player = new Players();
            $player->setFirstName($playerData['firstName']);
            $player->setLastName($playerData['lastName']);
            $player->setBirthday(new \DateTimeImmutable($playerData['birthday']));
            $player->setPosition($playerData['Position']);
            $player->setNumber($playerData['Number']);
            $player->setTeam($Lille);

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
