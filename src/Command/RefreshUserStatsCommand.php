<?php

namespace App\Command;

use App\Entity\Statistics;
use App\Entity\User;
use App\Handler\StatisticHandler;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

class RefreshUserStatsCommand extends Command
{
    protected static $defaultName = 'app:user-stat:refresh';


    private $em;
    private $handler;


    public function __construct(EntityManagerInterface $em, StatisticHandler $handler)
    {
        $this->em = $em;
        $this->handler= $handler;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Refresh UserStat for all users');

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $statistics = $this->em->getRepository(Statistics::class)->findAll();
        $users = $this->em->getRepository(User::class)->findAll();

        if (null === $statistics || null === $users) {
            throw new NotFoundResourceException('No Bd found');
        }

        /** @var User $user */
        foreach ($users as $user) {
            if ($user->getUserStats() !== null) {
                foreach ($user->getUserStats() as $userStat) {
                    $user->removeUserStat($userStat);
                    $this->em->persist($user);
                }
                $this->em->flush();
            }
            $this->handler->updateUserStats($user);
        }
    }
}
