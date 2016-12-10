<?php

namespace MasterPeace\Bundle\BookBundle\Controller;

use MasterPeace\Bundle\BookBundle\Entity\Book;
use MasterPeace\Bundle\BookBundle\Form\BookType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BookTeacherController extends Controller
{
    /**
     * @Route ("/book")
     *
     * @return Response
     */
    public function indexAction(): Response
    {
        return $this->redirectToRoute('teacher_book_list');
    }

    /**
     * @Route ("/book/list", name="teacher_book_list")
     *
     * @return Response
     */
    public function listAction(): Response
    {
        $em = $this
            ->getDoctrine()
            ->getManager();
        $books = $em
            ->getRepository('MasterPeaceBookBundle:Book')
            ->findAll();

        return $this->render('MasterPeaceBookBundle:Book/Teacher:list.html.twig', [
            'books' => $books,
        ]);
    }

    /**
     * @Route ("/book/view/{id}", name="teacher_book_view")
     *
     * @param Book $book
     *
     * @return Response
     */
    public function viewAction(Book $book): Response
    {
        return $this->render('MasterPeaceBookBundle:Book/Teacher:view.html.twig', [
            'book' => $book,
        ]);
    }

    /**
     * @Route ("/book/create", name="teacher_book_create")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function createAction(Request $request): Response
    {
        $book = new Book();
        $book->setTeacher($this->getUser());
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($book);
            $em->flush();

            return $this->redirectToRoute('teacher_book_list');
        }

        return $this->render('MasterPeaceBookBundle:Book/Teacher:create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route ("/book/edit/{id}", name="teacher_book_edit")
     *
     * @param Book $book
     * @param Request $request
     *
     * @return Response
     */
    public function editAction(Request $request, Book $book): Response
    {
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($form->getData());
            $em->flush();

            return $this->redirectToRoute('teacher_book_view', [
                'id' => $book->getId(),
            ]);
        }

        return $this->render('MasterPeaceBookBundle:Book/Teacher:edit.html.twig', [
            'form' => $form->createView(),
            'book' => $book,
        ]);
    }

    /**
     * @Route ("/book/delete/{id}", name="teacher_book_delete")
     *
     * @param Book $book
     *
     * @return Response
     */
    public function deleteAction(Book $book): Response
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($book);
        $em->flush();

        return $this->redirectToRoute('teacher_book_list');
    }
}