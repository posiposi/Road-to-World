<?php

namespace Core\src\Bike\Domain\Models;

use Core\src\Bike\Domain\Models\BikeAddress;
use Core\src\Bike\Domain\Models\BikeId;
use Core\src\Bike\Domain\Models\BikeName;
use Core\src\Bike\Domain\Models\Brand;
use Core\src\Bike\Domain\Models\ImagePath;
use Core\src\Bike\Domain\Models\Price;
use Core\src\Bike\Domain\Models\Remark;
use Core\src\Bike\Domain\Models\Status;
use Core\src\User\Domain\Models\UserId;

final class Bike
{
    /** @param BikeId */
    private $bikeId;
    /** @param UserId */
    private $userId;
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
        UserId $userId,
        Brand $brand,
        BikeName $bikeName,
        BikeAddress $bikeAddress,
        Price $price,
        Status $status,
        Remark $remark,
        ImagePath $imagePath,
    ) {
        $this->bikeId = $bikeId;
        $this->userId = $userId;
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

    public function userId(): UserId
    {
        return $this->userId;
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

    public function imagePath(): ImagePath
    {
        return $this->imagePath;
    }

    /**
     * 配列からオブジェクトを生成する
     *
     * @param array $values
     */
    public static function ofByArray(array $values): Bike
    {
        return new self(
            BikeId::of($values['id']),
            UserId::of($values['user_id']),
            Brand::of($values['brand']),
            BikeName::of($values['name']),
            BikeAddress::of($values['bike_address']),
            Price::of($values['price']),
            Status::of($values['status']),
            Remark::of($values['remark']),
            ImagePath::of($values['image_path']),
        );
    }

    /**
     * オブジェクトから配列を生成
     *
     * @param Bike $bike
     */
    public static function modelToArray(Bike $bike): array
    {
        return [
            'id' => $bike->bikeId()->toInt(),
            'user_id' => $bike->userId()->toInt(),
            'brand' => $bike->brand()->toString(),
            'name' => $bike->bikeName()->toString(),
            'bike_address' => $bike->bikeAddress()->toString(),
            'price' => $bike->price()->toInt(),
            'status' => $bike->status()->toString(),
            'remark' => $bike->remark()->toString(),
            'image_path' => $bike->imagePath()->toString(),
        ];
    }
}
