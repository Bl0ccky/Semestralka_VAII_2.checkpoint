<?php

namespace App\Models;

use App\Core\Model;

class Tour extends Model
{
    public function __construct(public int $id = 0,
                                public ?string $name = null,
                                public int $price = 0,
                                public ?string $date = null,
                                public ?string $info = null,
                                public ?string $image = null,
                                public int $number_of_orders = 0,
                                public int $capacity = 5)
    {
    }

    static public function setDbColumns()
    {
        return ['id', 'name', 'price', 'date', 'info', 'image', 'number_of_orders', 'capacity'];
    }

    static public function setTableName()
    {
        return "tours";
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    /**
     * @return string|null
     */
    public function getDate(): ?string
    {
        return $this->date;
    }

    /**
     * @param string|null $date
     */
    public function setDate(?string $date): void
    {
        $this->date = $date;
    }

    /**
     * @return string|null
     */
    public function getInfo(): ?string
    {
        return $this->info;
    }

    /**
     * @param string|null $info
     */
    public function setInfo(?string $info): void
    {
        $this->info = $info;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * @param string|null $image
     */
    public function setImage(?string $image): void
    {
        $this->image = $image;
    }

    /**
     * @return int
     */
    public function getNumberOfOrders(): int
    {
        return $this->number_of_orders;
    }

    /**
     * @param int $number_of_orders
     */
    public function setNumberOfOrders(int $number_of_orders): void
    {
        $this->number_of_orders = $number_of_orders;
    }

    /**
     * @return int
     */
    public function getCapacity(): int
    {
        return $this->capacity;
    }

    /**
     * @param int $capacity
     */
    public function setCapacity(int $capacity): void
    {
        $this->capacity = $capacity;
    }

    public function addTourMember()
    {
        if(!$this->isFull())
        {
            $this->number_of_orders++;
        }

    }

    public function removeTourMember()
    {
        if($this->number_of_orders > 0)
        {
            $this->number_of_orders--;
        }

    }

    public function isFull()
    {
        if($this->number_of_orders == $this->capacity)
        {
            return true;
        }
    }


}