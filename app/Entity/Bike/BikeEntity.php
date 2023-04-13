<?php

namespace App\Entity\Bike;

use App\Bike as BikeModel;

class BikeEntity
{
    public function __construct(private BikeModel $model)
    {
    }

    public function id(): int
    {
        return $this->model->id;
    }

    public function userId(): int
    {
        return $this->model->user_id;
    }

    public function name(): string
    {
        return $this->model->name;
    }

    public function brand(): string
    {
        return $this->model->brand;
    }

    public function status(): string
    {
        return $this->model->status;
    }

    public function bike_address(): string
    {
        return $this->model->bike_address;
    }

    public function image_path(): string
    {
        return $this->model->image_path;
    }

    public function price(): int
    {
        return $this->model->price;
    }

    public function remark(): string
    {
        return $this->model->remark;
    }

    public function created_at(): string
    {
        return $this->model->created_at;
    }

    public function updated_at(): string
    {
        return $this->model->updated_at;
    }

    public function save(): static
    {
        $this->model->save();
        return $this;
    }
}
