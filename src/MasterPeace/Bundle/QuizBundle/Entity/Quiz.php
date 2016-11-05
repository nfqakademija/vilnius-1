<?php

namespace MasterPeace\Bundle\QuizBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use MasterPeace\Bundle\BookBundle\Entity\Book;
use MasterPeace\Bundle\BookBundle\Entity\Question;
use MasterPeace\Bundle\UserBundle\Entity\User;

/**
 * Quiz
 *
 * @ORM\Table(name="quiz")
 * @ORM\Entity
 */
class Quiz
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="\MasterPeace\Bundle\UserBundle\Entity\User", inversedBy="user")
     * @ORM\JoinColumn(name="teacher_id", referencedColumnName="id")
     */
    private $teacher;

    /**
     * @var Book
     *
     * @ORM\ManyToOne(targetEntity="\MasterPeace\Bundle\BookBundle\Entity\Book", inversedBy="book")
     * @ORM\JoinColumn(name="book_id", referencedColumnName="id")
     */
    private $book;

    /**
     * @var ArrayCollection|Question[]
     *
     * @ORM\ManyToMany(targetEntity="\MasterPeace\Bundle\BookBundle\Entity\Question", inversedBy="quiz")
     * @ORM\JoinTable(name="quiz_question")
     */
    private $questions;

    public function __construct()
    {
        $this->questions = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $title
     *
     * @return Quiz
     */
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param User $teacher
     *
     * @return Quiz
     */
    public function setTeacher(User $teacher)
    {
        $this->teacher = $teacher;

        return $this;
    }

    /**
     * @return User
     */
    public function getTeacher()
    {
        return $this->teacher;
    }

    /**
     * @param Book $book
     *
     * @return Quiz
     */
    public function setBook(Book $book)
    {
        $this->book = $book;

        return $this;
    }

    /**
     * @return Book
     */
    public function getBook()
    {
        return $this->book;
    }

    /**
     * @param Question $question
     *
     * @return Quiz
     */
    public function addQuestion(Question $question)
    {
        $this->questions[] = $question;

        return $this;
    }

    /**
     * @param Question $question
     */
    public function removeQuestion(Question $question)
    {
        $this->questions->removeElement($question);
    }

    /**
     * @return ArrayCollection|Question[]
     */
    public function getQuestions()
    {
        return $this->questions;
    }
}