<?php

namespace App\DataFixtures;

use App\Entity\Statistics;
use App\Entity\User;
use App\Entity\UserStat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;

class zStatisticFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 1000; $i += 100) {
            $statistic = new Statistics();
            $statistic->setTitle('Statistic-' . $i);
            $statistic->setDescription('Bravo ' . $i . ' clopes non fumées');
            $statistic->setLifetimeSaved( $i /2);
            $statistic->setUpdatedAt(\DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')));
            $statistic->setUnsmokedCigarette( $i);
            $statistic->setMoneyEconomised( $i);
            $statistic->setImage('stats.png');
            $manager->persist($statistic);
        }
        $manager->flush();

        $statistics = $manager->getRepository(Statistics::class)->findAll();
        $users = $manager->getRepository(User::class)->findAll();
        foreach ($statistics as $statistic) {
            foreach ($users as $user) {
                $userStat = new UserStat();
                $userStat->setTitle($statistic->getTitle());
                $userStat->setLifetimeSaved($statistic->getLifetimeSaved());
                $userStat->setCigarettesSaved($statistic->getUnsmokedCigarette());
                $userStat->setDate(\DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')));
                $userStat->setMoneyEconomised($user->getPackageCost()  * (round($statistic->getUnsmokedCigarette() / 20, 1)));
                $userStat->setStatistic($statistic);
                $userStat->setImageUrl($statistic->getImage());
                $userStat->setUser($user);
                $manager->persist($userStat);
            }
        }
        $manager->flush();
    }
}
