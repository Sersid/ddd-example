<?php
declare(strict_types=1);

namespace App\Catalog\Brand\Domain\Entity;

class Brand
{
    private Id $id;
    private Name $name;
    private Description $description;

    public function __construct(Id $id, Name $name, Description $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function getDescription(): Description
    {
        return $this->description;
    }
}
