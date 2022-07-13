<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ContactRepository::class)
 */
class Contact
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(
     *    message="You should give us your name please"
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Assert\NotBlank(
     *    message="You must enter your mail "
     * )
     *  * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email."
     * )
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     * * * @Assert\NotBlank(
     *    message="You can't send an email without it's subject !!"
     * )
     * * @Assert\Length(
     *      min = 15,
     *      max = 80,
     *      minMessage = "Your subject  must be at least {{ limit }} characters long",
     *      maxMessage = "Your subject  must be cannot be longer than {{ limit }} characters"
     * )
     */
    private $subject;

    /**
     * @ORM\Column(type="text")
     * * @Assert\NotBlank(
     *    message="You can't send an empty message !!"
     * )
     */
    private $message;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }
}
