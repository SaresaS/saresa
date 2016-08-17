<?php
/**
 * Created by PhpStorm.
 * User: saresa
 * Date: 7/18/16
 * Time: 3:08 PM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Person;
use AppBundle\Form\NewPersonForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FormController extends Controller
{
    /**
     * @Route("/home", name="home")
     */
    public function showHome ()
    {
        $templating = $this->container->get('templating');
        $html= $templating->render('pages/show.html.twig', [
            'Home'
        ]);

        return new Response($html);
    }

    /**
     * @Route("/form", name="form")
     * @return Response
     */
    public function showForm (Request $request)
    {
        $form = $this->createForm(NewPersonForm::class);

        //only handles data on POST
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $person = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($person);
            $em->flush();

            $this->addFlash('success', 'New person added!');
            return $this->redirectToRoute('list');
        }
        return  $this->render('pages/form.html.twig', [
            'Form' => $form->createView()
        ]);
    }

    /**
     * @Route("/list", name="list")
     */
    public function showAction()
    {
        $em= $this->getDoctrine()->getManager();
        $person = $em->getRepository('AppBundle:Person')
            ->findAll();

        return $this->render('pages/last.html.twig', [
            'person'=>$person,
        ]);
    }
}