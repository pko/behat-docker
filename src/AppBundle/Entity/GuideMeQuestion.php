<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="b2csf_guideme_question")
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GuideMeQuestionRepository")
 */
class GuideMeQuestion {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\GuideMeAnswer", mappedBy="question")
     */
    private $answer;

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
     * @var integer
     *
     * @ORM\Column(name="pounderation", type="integer", options={"default" = 0})
     */
    private $pounderation;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return GuideMeQuestion
     */
    public function setId(int $id): GuideMeQuestion
    {
        $this->id = $id;
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
     * @return GuideMeQuestion
     */
    public function setCode(string $code): GuideMeQuestion
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
     * @return GuideMeQuestion
     */
    public function setLabel(string $label): GuideMeQuestion
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return int
     */
    public function getPounderation(): int
    {
        return $this->pounderation;
    }

    /**
     * @param int $pounderation
     * @return GuideMeQuestion
     */
    public function setPounderation(int $pounderation): GuideMeQuestion
    {
        $this->pounderation = $pounderation;
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
     * @return GuideMeQuestion
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;
        return $this;
    }


}
