<?php
namespace App\DataFixtures;

use App\Entity\AngersPlayers;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use phpDocumentor\Reflection\Types\Integer;

class AngersPlayerFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $players = [
            ['firstName' => 'Melvin', 'lastName' => 'Zinga', 'birthday' => '2002-03-16', 'Position' => 'Goal','Number' => 16],
            ['firstName' => 'Yahia', 'lastName'=> 'Fofana', 'birthday' => '2000-08-21', 'Position' => 'Goal','Number' => 30],
            ['firstName' => 'Oumar', 'lastName'=> 'Pona', 'birthday' => '2006-06-21', 'Position' => 'Goal','Number' => 40],
            ['firstName' => 'Théo', 'lastName'=> 'Pellenard', 'birthday' => '1994-03-04', 'Position' => 'Defender','Number' => 5],
            ['firstName' => 'Saad', 'lastName'=> 'Agouzoul', 'birthday' => '1997-08-10', 'Position' => 'Defender','Number' => 6],
            ['firstName' => 'Gideon', 'lastName' => 'Mensah', 'birthday' => '1997-07-18', 'Position' => 'Defender','Number' => 14],
            ['firstName' => 'Jordan', 'lastName' => 'Lefort', 'birthday' => '1993-08-09', 'Position' => 'Defender','Number' => 21],
            ['firstName' => 'Cédric', 'lastName' => 'Houtondji', 'birthday' => '1994-01-19', 'Position' => 'Defender','Number' => 22],
            ['firstName' => 'Abdoulaye', 'lastName' => 'Bamba', 'birthday' => '1990-04-25', 'Position' => 'Defender','Number' => 25],
            ['firstName' => 'Florent', 'lastName' => 'Hanin', 'birthday' => '1990-02-04', 'Position' => 'Defender','Number' => 26],
            ['firstName' => 'Ousmane', 'lastName' => 'Camara', 'birthday' => '2003-03-06', 'Position' => 'Defender','Number' => 29],
            ['firstName' => 'Yacine', 'lastName' => 'Gaya', 'birthday' => '2004-12-15', 'Position' => 'Defender','Number' => 70],
            ['firstName' => 'Jean-Eudes', 'lastName' => 'Aholou', 'birthday' => '1994-03-20', 'Position' => 'Midfielder','Number' => 6],
            ['firstName' => 'Joseph', 'lastName' => 'Lopy', 'birthday' => '1992-03-15', 'Position' => 'Midfielder','Number' => 6],
            ['firstName' => 'Himad', 'lastName' => 'Abdelli', 'birthday' => '1999-11-17', 'Position' => 'Midfielder','Number' => 10],
            ['firstName' => 'Zinedine', 'lastName' => 'Ould Khaled', 'birthday' => '2000-01-14', 'Position' => 'Midfielder','Number' => 12],
            ['firstName' => 'Yassin', 'lastName' => 'Belkhdim', 'birthday' => '2002-02-14', 'Position' => 'Midfielder','Number' => 14],
            ['firstName' => 'Pierrick', 'lastName' => 'Capelle', 'birthday' => '1987-04-15', 'Position' => 'Midfielder','Number' => 15],
            ['firstName' => 'Justin', 'lastName' => 'Kalumba', 'birthday' => '2004-12-25', 'Position' => 'Midfielder','Number' => 17],
            ['firstName' => 'Zinedine', 'lastName' => 'Ferhat', 'birthday' => '1993-03-01', 'Position' => 'Midfielder','Number' => 20],
            ['firstName' => 'Adrien', 'lastName' => 'Hunou', 'birthday' => '1994-01-19', 'Position' => 'Midfielder','Number' => 23],
            ['firstName' => 'Emmanuel', 'lastName' => 'Biumla', 'birthday' => '2005-05-08', 'Position' => 'Midfielder','Number' => 24],
            ['firstName' => 'Lilian', 'lastName' => 'Raolisoa', 'birthday' => '2000-06-16', 'Position' => 'Midfielder','Number' => 27],
            ['firstName' => 'Farid', 'lastName' => 'El Melali', 'birthday' => '1997-07-13', 'Position' => 'Midfielder','Number' => 28],
            ['firstName' => 'Haris', 'lastName' => 'Belkebla', 'birthday' => '1994-01-28', 'Position' => 'Midfielder','Number' => 93],
            ['firstName' => 'Ibrahima', 'lastName' => 'Niane', 'birthday' => '1999-03-11', 'Position' => 'Forward','Number' => 7],
            ['firstName' => 'Loïs', 'lastName' => 'Diony', 'birthday' => '1992-12-20', 'Position' => 'Forward','Number' => 9],
            ['firstName' => 'Sidiki', 'lastName' => 'Cherif', 'birthday' => '2006-12-15', 'Position' => 'Forward','Number' => 11],
            ['firstName' => 'Jim', 'lastName' => 'Allevinah', 'birthday' => '1995-02-27', 'Position' => 'Forward','Number' => 18],
            ['firstName' => 'Estéban', 'lastName' => 'Lepaul', 'birthday' => '2000-04-18', 'Position' => 'Forward','Number' => 19],
            ['firstName' => 'Bamba', 'lastName' => 'Dieng', 'birthday' => '2000-03-23', 'Position' => 'Forward','Number' => 99],
        ];

        foreach ($players as $playerData) {
            $player = new AngersPlayers();
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
