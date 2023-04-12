<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Message
 *
 * @ORM\Table(name="message", indexes={@ORM\Index(name="fk_conv", columns={"to_conv"}), @ORM\Index(name="fk_sender", columns={"from_user"})})
 * @ORM\Entity
 */
class Message
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_message", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idMessage;

    /**
     * @var string
     *
     * @ORM\Column(name="message_text", type="text", length=65535, nullable=false)
     */
    private $messageText;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_time", type="datetime", nullable=false, options={"default"="current_timestamp()"})
     */
    private $dateTime = 'current_timestamp()';

    /**
     * @var \Conv
     *
     * @ORM\ManyToOne(targetEntity="Conv")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="to_conv", referencedColumnName="id")
     * })
     */
    private $toConv;

    /**
     * @var \Utilisateur
     *
     * @ORM\ManyToOne(targetEntity="Utilisateur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="from_user", referencedColumnName="id")
     * })
     */
    private $fromUser;

    public function getIdMessage(): ?int
    {
        return $this->idMessage;
    }

    public function getMessageText(): ?string
    {
        return $this->messageText;
    }

    public function setMessageText(string $messageText): self
    {
        $this->messageText = $messageText;

        return $this;
    }

    public function getDateTime(): ?\DateTimeInterface
    {
        return $this->dateTime;
    }

    public function setDateTime(\DateTimeInterface $dateTime): self
    {
        $this->dateTime = $dateTime;

        return $this;
    }

    public function getToConv(): ?Conv
    {
        return $this->toConv;
    }

    public function setToConv(?Conv $toConv): self
    {
        $this->toConv = $toConv;

        return $this;
    }

    public function getFromUser(): ?Utilisateur
    {
        return $this->fromUser;
    }

    public function setFromUser(?Utilisateur $fromUser): self
    {
        $this->fromUser = $fromUser;

        return $this;
    }


}
