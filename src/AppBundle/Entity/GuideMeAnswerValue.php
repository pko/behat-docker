<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="b2csf_guideme_answer_value")
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GuideMeAnswerValueRepository")
 */
class GuideMeAnswerValue {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\GuideMeAnswer", cascade={"persist", "remove"}, inversedBy="answerValue")
     * @ORM\JoinColumn(name="answer_id", referencedColumnName="id")
     */
    private $answer;

    /**
     * @var string
     *
     * @ORM\Column(name="offer_code", type="string", length=2)
     */
    private $offerCode;

    /**
     * @var integer
     *
     * @ORM\Column(name="value", type="integer", options={"default" = 0})
     */
    private $value;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return GuideMeAnswerValue
     */
    public function setId(int $id): GuideMeAnswerValue
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * @param mixed $answer
     * @return GuideMeAnswerValue
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;
        return $this;
    }

    /**
     * @return string
     */
    public function getOfferCode(): string
    {
        return $this->offerCode;
    }

    /**
     * @param string $offerCode
     * @return GuideMeAnswerValue
     */
    public function setOfferCode(string $offerCode): GuideMeAnswerValue
    {
        $this->offerCode = $offerCode;
        return $this;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @param int $value
     * @return GuideMeAnswerValue
     */
    public function setValue(int $value): GuideMeAnswerValue
    {
        $this->value = $value;
        return $this;
    }
}
