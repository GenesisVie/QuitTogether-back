<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CreateUserCommand extends Command
{
    protected static $defaultName = 'app:create-user';
    private $entityManager;
    private $passwordEncoder;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription("Création d'un Admin ")
            ->addArgument('email', InputArgument::OPTIONAL, 'Email')
            ->addArgument('password', InputArgument::OPTIONAL, 'Password')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $email = $input->getArgument('email');
        $password = $input->getArgument('password');

        $user = new User();
        $user->setFirstname($email);
        $user->setLastname($email);
        $user->setUpdatedAt( new \DateTime('now'));
        $user->setCreatedAt( new \DateTime('now'));
        $user->setStoppedAt( new \DateTime('now'));
        $user->setBirthday( new \DateTime('now'));
        $user->setEmail($email);
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user, $password
        ));
        $user->setRoles(['ROLE_USER','ROLE_ADMIN']);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}
