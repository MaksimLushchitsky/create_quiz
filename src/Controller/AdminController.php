<?php

declare(strict_types=1);
namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();

        // usually you'll want to make sure the user is authenticated first
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // returns your User object, or null if the user is not authenticated
        // use inline documentation to tell your editor your exact User class
        /** @var User $user */

        $users = $em->getRepository(User::class)->findAll();

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'users' => $users
        ]);
    }

    /**
     * @Route("/remove/{user}", name="remove_user")
     */
    public function removeUser(User $user, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute("admin");
    }

}
