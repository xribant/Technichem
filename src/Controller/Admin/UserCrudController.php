<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Services\PasswordGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use Doctrine\ORM\EntityManagerInterface;
use DateTimeImmutable;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserCrudController extends AbstractCrudController
{
    public function __construct(
        private PasswordGenerator $passwordGenerator,
        private UserPasswordHasherInterface $passwordHasher
    ){
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function createEntity(string $entityFqcn)
    {
        $user = new User();
        $password = $this->passwordGenerator->getRandomAlphaNumStr();
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $password
        );
        $user->setPassword($hashedPassword);

        return $user;
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $user = $this->getUser();
        if (!$user instanceof User) {
            throw new \LogicException('Currently logged in user is not an instance of User?!');
        }
        $entityInstance
            ->setUpdatedAt(new DateTimeImmutable());
        parent::updateEntity($entityManager, $entityInstance);
    }
    
    public function configureFields(string $pageName): iterable
    {
        
        yield TextField::new('fullname', 'Nom')->onlyOnIndex();
        yield TextField::new('first_name', 'Prénom')->onlyOnForms();
        yield TextField::new('last_name', 'Nom')->onlyOnForms();
        yield TextField::new('email', 'E-Mail');
        yield CollectionField::new('roles', 'Rôles');
        yield DateTimeField::new('created_at', 'Créé le')->onlyOnIndex();
        yield DateTimeField::new('updated_at', 'Modifié le')->onlyOnIndex();

    }
    
}
