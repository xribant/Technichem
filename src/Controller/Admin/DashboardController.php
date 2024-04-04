<?php

namespace App\Controller\Admin;

use App\Entity\Block;
use App\Entity\CompanyData;
use App\Entity\Label;
use App\Entity\Page;
use App\Entity\ProductCategory;
use App\Entity\Slide;
use App\Entity\SocialNetwork;
use App\Entity\User;
use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\Security\Core\User\UserInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);

        return $this->redirect($adminUrlGenerator->setController(CompanyDataCrudController::class)->generateUrl());

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Technichem');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('Contenu');

        yield MenuItem::linkToCrud('Détails Société', 'fa fa-circle-info', CompanyData::class)
            ->setAction('edit')
            ->setEntityId(1);

        yield MenuItem::linkToCrud('Réseaux sociaux', 'fa-solid fa-share-nodes', SocialNetwork::class);

        yield MenuItem::linkToCrud('Homepage Slider', 'fa-solid fa-image', Slide::class);

        yield MenuItem::subMenu('Pages', 'fa fa-file-lines')->setSubItems([
            MenuItem::linkToCrud('Homepage', 'fa fa-tags', Page::class)
                ->setAction('edit')
                ->setEntityId(8),
            MenuItem::linkToCrud('Nos produits', 'fa fa-file-text', Page::class)
                ->setAction('edit')
                ->setEntityId(9),
            MenuItem::linkToCrud('Nos services', 'fa fa-comment', Page::class),
        ]);
       

        yield MenuItem::section('Catalogue');
        yield MenuItem::linkToCrud('Catégories de produits', 'fa-solid fa-table-list', ProductCategory::class);
        yield MenuItem::linkToCrud('Produits', 'fa-solid fa-flask-vial', Product::class);
        yield MenuItem::linkToCrud('Labels', 'fa-solid fa-award', Label::class);
        
        /* SUPER ADMIN SECTION */
        yield MenuItem::section('Super Admin')->setPermission('ROLE_SUPER_ADMIN');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-users', User::class)->setPermission('ROLE_SUPER_ADMIN');
        yield MenuItem::linkToCrud('Pages', 'fas fa-file', Page::class)->setPermission('ROLE_SUPER_ADMIN');
        yield MenuItem::linkToCrud('Blocs', 'fa-solid fa-cubes-stacked', Block::class)->setPermission('ROLE_SUPER_ADMIN');

    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        // Usually it's better to call the parent method because that gives you a
        // user menu with some menu items already created ("sign out", "exit impersonation", etc.)
        // if you prefer to create the user menu from scratch, use: return UserMenu::new()->...
        return parent::configureUserMenu($user)
            // use the given $user object to get the user name
            ->setName($user->getFullName());
            
    }
}
