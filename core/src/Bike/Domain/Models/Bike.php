<?php

namespace Core\src\Bike\Domain\Models;

use core\src\Bike\Domain\Models\BikeAddress;
use core\src\Bike\Domain\Models\BikeId;
use core\src\Bike\Domain\Models\BikeName;
use core\src\Bike\Domain\Models\Brand;
use core\src\Bike\Domain\Models\ImagePath;
use core\src\Bike\Domain\Models\Price;
use core\src\Bike\Domain\Models\Remark;
use core\src\Bike\Domain\Models\Status;

final class Bike
{
    /** @param BikeId */
    private $bikeId;
    /** @param Brand */
    private $brand;
    /** @param BikeName */
    private $bikeName;
    /** @param BikeAddress */
    private $bikeAddress;
    /** @param Price */
    private $price;
    /** @param Status */
    private $status;
    /** @param Remark */
    private $remark;
    /** @param ImagePath */
    private $imagePath;

    public function __construct(
        BikeId $bikeId,
        Brand $brand,
        BikeName $bikeName,
        BikeAddress $bikeAddress,
        Price $price,
        Status $status,
        Remark $remark,
        ImagePath $imagePath,
    ) {
        $this->bikeId = $bikeId;
        $this->brand = $brand;
        $this->bikeName = $bikeName;
        $this->bikeAddress = $bikeAddress;
        $this->price = $price;
        $this->status = $status;
        $this->remark = $remark;
        $this->imagePath = $imagePath;
    }

    public function bikeId(): BikeId
    {
        return $this->bikeId;
    }

    public function brand(): Brand
    {
        return $this->brand;
    }

    public function bikeName(): BikeName
    {
        return $this->bikeName;
    }

    public function bikeAddress(): BikeAddress
    {
        return $this->bikeAddress;
    }

    public function price(): Price
    {
        return $this->price;
    }

    public function status(): Status
    {
        return $this->status;
    }

    public function remark(): Remark
    {
        return $this->remark;
    }

    public static function ofByArray(array $values)
    {
        return new self(
            BikeId::of($values['bikeId']),
            Brand::of($values['brand']),
            BikeName::of($values['bikeName']),
            BikeAddress::of($values['bikeAddress']),
            Price::of($values['price']),
            Status::of($values['status']),
            Remark::of($values['remark']),
            ImagePath::of($values['image_path']),
        );
    }
}
