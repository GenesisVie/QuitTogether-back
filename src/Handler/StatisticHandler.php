<?php

namespace App\Handler;


use App\Entity\Article;
use App\Entity\Children;
use App\Entity\School;
use App\Entity\Statistics;
use App\Entity\User;
use App\Entity\UserStat;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class StatisticHandler
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    // Function qui vient rajouter un statistique a l'utilisateur si les conditions sont valables
    public function updateUserStats(User $user): void
    {
        $now = new \DateTime('now');
        $stoppedAt = $user->getStoppedAt();
        $datediff = date_diff($stoppedAt, $now);
        $packageCost = $user->getPackageCost();
        $averagePerDay = $user->getAveragePerDay();

        $unsmokedStat = $datediff->format('%a') * $averagePerDay;
        $statistics = $this->em->getRepository(Statistics::class)->validStats($unsmokedStat);
        $userStats = $user->getUserStats();
        /** @var Statistics $statistic */
        foreach ($statistics as $statistic) {
            $userStatDB = $this->em->getRepository(UserStat::class)->findOneBy(['statistic' => $statistic, 'user'=>$user]);
            if ($userStatDB === null ) {
                $userStat = new UserStat();
                $userStat->setTitle($statistic->getTitle());
                $userStat->setLifetimeSaved($statistic->getLifetimeSaved());
                $userStat->setCigarettesSaved($statistic->getUnsmokedCigarette());
                $userStat->setDate(new \DateTime('now'));
                $userStat->setMoneyEconomised($user->getPackageCost() * (round($statistic->getUnsmokedCigarette() / 20, 1)));
                $userStat->setStatistic($statistic);
                $userStat->setImageUrl($statistic->getImage());
                $userStat->setUser($user);
                $user->addUserStat($userStat);
                $this->em->persist($userStat);
                $this->em->persist($user);
            }else{
                $userStatDB->setTitle($statistic->getTitle());
                $userStatDB->setLifetimeSaved($statistic->getLifetimeSaved());
                $userStatDB->setCigarettesSaved($statistic->getUnsmokedCigarette());
                $userStatDB->setDate(new \DateTime('now'));
                $userStatDB->setMoneyEconomised($user->getPackageCost() * (round($statistic->getUnsmokedCigarette() / 20, 1)));
                $userStatDB->setStatistic($statistic);
                $userStatDB->setImageUrl($statistic->getImage());
                $userStatDB->setUser($user);
                $user->addUserStat($userStatDB);
                $this->em->persist($userStatDB);
                $this->em->persist($user);
            }
        }

        $this->em->persist($user);
        $this->em->flush();
    }
}
