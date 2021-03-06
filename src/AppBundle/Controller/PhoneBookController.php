<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use AppBundle\Entity\PhoneBook;

class PhoneBookController extends FOSRestController
{
    /**
     * @Rest\Get("/users")
     */
    public function getAction()
    {
        $restresult = $this->getDoctrine()->getRepository(PhoneBook::class)->findAll();
        if ($restresult === null) {
            return new View("there are no users exist", Response::HTTP_NOT_FOUND);
        }

        return $restresult;
    }

    /**
     * @Rest\Get("/users/{id}")
     */
    public function idAction($id)
    {
        $singleresult = $this->getDoctrine()->getRepository(PhoneBook::class)->find($id);
        if ($singleresult === null) {
            return new View("user not found", Response::HTTP_NOT_FOUND);
        }
        return $singleresult;
    }

    /**
     * @Rest\Get("/users/search/{name}")
     */
    public function searchdAction($name)
    {
        $singleresult = $this->getDoctrine()->getRepository(PhoneBook::class)->findBy(['name' => $name]);
        if ($singleresult === null) {
            return new View("user not found", Response::HTTP_NOT_FOUND);
        }
        return $singleresult;
    }

    /**
     * @Rest\Post("/users")
     */
    public function postAction(Request $request)
    {
        $data = new PhoneBook();
        $name = $request->get('name');
        $phone = $request->get('phone');
        if(empty($name) || empty($phone))
        {
            return new View("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_ACCEPTABLE);
        }
        $data->setName($name);
        $data->setPhone($phone);
        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();
        return new View("User Added Successfully", Response::HTTP_OK);
    }

    /**
     * @Rest\Put("/users/{id}")
     */
    public function updateAction($id,Request $request)
    {
        $data = new PhoneBook();
        $name = $request->get('name');
        $phone = $request->get('phone');
        $sn = $this->getDoctrine()->getManager();
        $user = $this->getDoctrine()->getRepository(PhoneBook::class)->find($id);
        if (!$name && !$phone) {
            return new View("User name or phone cannot be empty", Response::HTTP_NOT_ACCEPTABLE);
        }

        if ($name) {
            $user->setName($name);
        }

        if ($phone) {
            $user->setPhone($phone);
        }

        $sn->flush();

        return new View("Updated Successfully", Response::HTTP_NOT_ACCEPTABLE);
    }

    /**
     * @Rest\Delete("/users/{id}")
     */
    public function deleteAction($id)
    {
        $data = new PhoneBook();
        $sn = $this->getDoctrine()->getManager();
        $user = $this->getDoctrine()->getRepository(PhoneBook::class)->find($id);
        if (empty($user)) {
            return new View("user not found", Response::HTTP_NOT_FOUND);
        }
        else {
            $sn->remove($user);
            $sn->flush();
        }
        return new View("deleted successfully", Response::HTTP_OK);
    }
}