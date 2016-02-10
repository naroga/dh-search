<?php

namespace Naroga\SearchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * File
 *
 * @ORM\Table(name="file")
 * @ORM\Entity()
 */
class File
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * File constructor.
     * @param $name
     * @param $content
     */
    public function __construct($name, $content)
    {
        $this->name = $name;
        $this->content = $content;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
}
