<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\User;
use AppBundle\Form\UserType;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="welcome")
     */
    public function indexAction(Request $request)
    {

      $characters = [
        'Daenerys Targaryen' => 'Emilia Clarke',
        'Jon Snow'           => 'Kit Harington',
        'Arya Stark'         => 'Maisie Williams',
        'Melisandre'         => 'Carice van Houten',
        'Khal Drogo'         => 'Jason Momoa',
        'Tyrion Lannister'   => 'Peter Dinklage',
        'Ramsay Bolton'      => 'Iwan Rheon',
        'Petyr Baelish'      => 'Aidan Gillen',
        'Brienne of Tarth'   => 'Gwendoline Christie',
        'Lord Varys'         => 'Conleth Hill'
      ];
      $debug = "eewr";
      // replace this example code with whatever you need
      /*  return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);*/
      return $this->render('default/index.html.twig', array('character' => $characters));

    }

  /**
   * @Route("/register", name="register")
   */
  public function registerAction(Request $request)
  {
    // Create a new blank user and process the form
    $user = new User();
    $form = $this->createForm(UserType::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      // Encode the new users password
      $encoder = $this->get('security.password_encoder');
      $password = $encoder->encodePassword($user, $user->getPlainPassword());
      $user->setPassword($password);

      // Set their role
      $user->setRole('ROLE_USER');

      // Save
      $em = $this->getDoctrine()->getManager();
      $em->persist($user);
      $em->flush();

      return $this->redirectToRoute('login');
    }

    return $this->render('auth/register.html.twig', [
      'form' => $form->createView(),
    ]);
  }


}
