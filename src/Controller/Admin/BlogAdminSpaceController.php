<?php

namespace App\Controller\Admin;

use App\Entity\Artical;
use App\Entity\Category;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogAdminSpaceController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('PersonalBlog');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
       yield MenuItem::linkToCrud('The Label', 'fas fa-list', Artical::class);
        yield MenuItem::linkToCrud('The Label', 'fas fa-list', Category::class);
        yield MenuItem::linkToCrud('The Label', 'fas fa-list', User::class);


    }
}
