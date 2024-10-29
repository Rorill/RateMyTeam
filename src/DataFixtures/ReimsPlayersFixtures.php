<?php
namespace App\DataFixtures;

use App\Entity\ReimsPlayers;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\Integer;

class ReimsPlayersFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $players = [



            // Goalkeepers
            ['firstName' => 'Ludovic', 'lastName' => 'Butelle', 'birthday' => '1983-04-03', 'Position' => 'Goal','Number' => 20],
            ['firstName' => 'Alexandre', 'lastName'=> 'Olliero', 'birthday' => '1996-02-15', 'Position' => 'Goal','Number' => 20],
            ['firstName' => 'Soumaila', 'lastName'=> 'Sylla', 'birthday' => '2004-03-15', 'Position' => 'Goal','Number' => 60],
            ['firstName' => 'Yehvann', 'lastName'=> 'Diouf', 'birthday' => '2003-03-16', 'Position' => 'Goal','Number' => 94],



            // Defenders
            ['firstName' => 'Joseph','lastName'=> 'Okumu', 'birthday' => '1997-05-26', 'Position' => 'Defender','Number' => 2],
            ['firstName' => 'Maxime', 'lastName'=> 'Busi', 'birthday' => '1999-10-14', 'Position' => 'Defender','Number' => 4],
            ['firstName' => 'Emmanuel', 'lastName' => 'Agbadou', 'birthday' => '1997v-06-17', 'Position' => 'Defender','Number' => 5],
            ['firstName' => 'Sergio', 'lastName' => 'Akieme ', 'birthday' => '1997-12-16', 'Position' => 'Defender','Number' => 18],
            ['firstName' => 'Cédric', 'lastName' => 'Kipre', 'birthday' => '1996-12-09', 'Position' => 'Defender','Number' => 21],
            ['firstName' => 'Aurélio', 'lastName' => 'Buta', 'birthday' => '1997-02-10', 'Position' => 'Defender','Number' => 23],
            ['firstName' => 'Thibault', 'lastName' => 'De Smet', 'birthday' => '1998-06-05', 'Position' => 'Defender','Number' => 25],
            ['firstName' => 'Maiky', 'lastName' => 'De La Cruz', 'birthday' => '2004-08-13', 'Position' => 'Defender','Number' => 42],
            ['firstName' => 'Kobi', 'lastName' => 'Henry', 'birthday' => '2004-04-26', 'Position' => 'Defender','Number' => 44],
            ['firstName' => 'Nhoa', 'lastName' => 'Sangui', 'birthday' => '2006-02-27', 'Position' => 'Defender','Number' => 55],
            ['firstName' => 'Abdoul', 'lastName' => 'Kone', 'birthday' => '2005-04-22', 'Position' => 'Defender','Number' => 92],


            // Midfielders
            ['firstName' => 'Valentin', 'lastName' => 'Atangana Edoa', 'birthday' => '2005-08-25', 'Position' => 'Midfielder','Number' => 6],
            ['firstName' => 'Teddy', 'lastName' => 'Teuma', 'birthday' => '1993-09-30', 'Position' => 'Midfielder','Number' => 10],
            ['firstName' => 'Marshall', 'lastName' => 'Munetsi', 'birthday' => '1996-06-22', 'Position' => 'Midfielder','Number' => 15],
            ['firstName' => 'Gabriel', 'lastName' => 'Moscardo', 'birthday' => '2005-09-28', 'Position' => 'Midfielder','Number' => 19],
            ['firstName' => 'Samuel', 'lastName' => 'Koeberle', 'birthday' => '2004-11-26', 'Position' => 'Midfielder','Number' => 48],
            ['firstName' => 'Mohamed', 'lastName' => 'Bamba', 'birthday' => '2004-10-08', 'Position' => 'Midfielder','Number' => 63],
            ['firstName' => 'Yaya', 'lastName' => 'Fofana', 'birthday' => '2004-06-12', 'Position' => 'Midfielder','Number' => 71],
            ['firstName' => 'Amadou', 'lastName' => 'Koné', 'birthday' => '2005-06-14', 'Position' => 'Midfielder','Number' => 72],


            // Forwards
            ['firstName' => 'Junya', 'lastName' => 'Ito', 'birthday' => '1993-03-09', 'Position' => 'Forward','Number' => 7],
            ['firstName' => 'Mohamed', 'lastName' => 'Daramy', 'birthday' => '2002-01-07', 'Position' => 'Forward','Number' => 9],
            ['firstName' => 'Amine', 'lastName' => 'Salama', 'birthday' => '2000-07-18', 'Position' => 'Forward','Number' => 11],
            ['firstName' => 'Réda', 'lastName' => 'Khadra', 'birthday' => '2001-07-04', 'Position' => 'Forward','Number' => 14],
            ['firstName' => 'Keito', 'lastName' => 'Nakamura', 'birthday' => '2000-07-28', 'Position' => 'Forward','Number' => 17],
            ['firstName' => 'Oumar', 'lastName' => 'Diakite', 'birthday' => '2003-12-20', 'Position' => 'Forward','Number' => 22],
            ['firstName' => 'Mamadou', 'lastName' => 'Diakhon', 'birthday' => '2005-09-22', 'Position' => 'Forward','Number' => 67],
            ['firstName' => 'Ikechukwu', 'lastName' => 'Orazi', 'birthday' => '2005-06-22', 'Position' => 'Forward','Number' => 73],
            ['firstName' => 'Niama Pape', 'lastName' => 'Sissoko', 'birthday' => '2005-06-22', 'Position' => 'Forward','Number' => 74],

        ];

        foreach ($players as $playerData) {
            $player = new ReimsPlayers();
            $player->setFirstName($playerData['firstName']);
            $player->setLastName($playerData['lastName']);
            $player->setBirthday(new \DateTimeImmutable($playerData['birthday']));
            $player->setPosition($playerData['Position']);
            $player->setNumber($playerData['Number']);
            $manager->persist($player);
        }

        $manager->flush();
    }
}