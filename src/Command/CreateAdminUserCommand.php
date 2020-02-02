<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use Doctrine\ORM\EntityManagerInterface;

class CreateAdminUserCommand extends Command
{
    protected static $defaultName = 'app:create-admin-user';

    private $entityManager;
    private $passwordEncoder;
    
    // Injection de dépendance pour EntityManagerInterface et UserPasswordEncoderInterface
    public function __construct(
        string $name = null,
        EntityManagerInterface $entityManager,
        UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->entityManager = $entityManager;
        $this->passwordEncoder = $passwordEncoder;
         // le parent construct est à laisser tel quel
        parent::__construct($name);
    }

    protected function configure()
    {
        $this
            ->setDescription('Cette commande créée un utilisateur admin')
            ->addArgument('email', InputArgument::REQUIRED, 'Email utilisateur Admin')
            ->addArgument('password', InputArgument::REQUIRED, 'Mot de passe utilisateur Admin')
            ->addArgument('firstName', InputArgument::OPTIONAL, 'Prénom Admin')
            ->addArgument('lastName', InputArgument::OPTIONAL, 'Nom Admin')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        
        // permet de poser une question à l'utilisateur dans le terminal
        $helper = $this->getHelper('question');
        $question = new ConfirmationQuestion(
            'Confirmer la création de l\'utilisateur ?',
            false, '/^(y|j)/i');
        
        // permet de poser une question à l'utilisateur dans le terminal
        if (!$helper->ask($input, $output, $question)) {
            return 0;
        }

        $email = $input->getArgument('email');
        $password = $input->getArgument('password');
        $firstName = $input->getArgument('firstName');
        $lastName = $input->getArgument('lastName');

        $io->note(sprintf('User email: %s', $email));
        $io->note(sprintf('User password: %s', $password));
        $io->note(sprintf('User First Name: %s', $firstName ?? ''));
        $io->note(sprintf('User Last Name: %s', $lastName ?? ''));

        $user = new User();
        $hashedPassword = $this->passwordEncoder->encodePassword($user, $password);
        $user->setEmail($email);
        $user->setPassword($hashedPassword);
        $user->setRoles(['ROLE_ADMIN']);
        $user->setFirstName($firstName ?? '');
        $user->setLastName($lastName ?? '');

        
        try {
            $this->entityManager->persist($user);
            $this->entityManager->flush();
        } catch (\Exception $exception) {
            $io->error('A error occured : ' . $exception->getMessage());

            return 0;
        }


        $io->success('Un nouvel Admin utilisateur a été créé');

        return 0;
    }
}
