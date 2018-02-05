<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="b2csf_guideme_answer")
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GuideMeAnswerRepository")
 */
class GuideMeAnswer {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\GuideMeQuestion", cascade={"persist", "remove"}, inversedBy="answer")
     * @ORM\JoinColumn(name="question_id", referencedColumnName="id")
     */
    private $question;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\GuideMeAnswerValue", mappedBy="answer")
     */
    private $answerValue;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=55)
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=255)
     */
    private $label;

    /**
     * @var string
     *
     * @ORM\Column(name="variability", type="string", length=10, nullable=true)
     */
    private $variability;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return GuideMeAnswer
     */
    public function setId(int $id): GuideMeAnswer
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getQuestion()
    {
        return $this->question;
    }

    /**
     * @param mixed $question
     * @return GuideMeAnswer
     */
    public function setQuestion($question)
    {
        $this->question = $question;
        return $this;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return GuideMeAnswer
     */
    public function setCode(string $code): GuideMeAnswer
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return GuideMeAnswer
     */
    public function setLabel(string $label): GuideMeAnswer
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return string
     */
    public function getVariability(): string
    {
        return $this->variability;
    }

    /**
     * @param string $variability
     * @return GuideMeAnswer
     */
    public function setVariability(string $variability): GuideMeAnswer
    {
        $this->variability = $variability;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAnswerValue()
    {
        return $this->answerValue;
    }

    /**
     * @param mixed $answerValue
     * @return GuideMeAnswer
     */
    public function setAnswerValue($answerValue)
    {
        $this->answerValue = $answerValue;
        return $this;
    }


}
