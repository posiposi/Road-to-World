<?php

namespace App;

use App\Bike as EloquentBike;
use Core\src\Bike\Domain\Models\Bike as DomainBike;
use App\Consts\Url;
use App\Enums\BikeStatus;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use core\src\Bike\Domain\Models\BikeId;
use Illuminate\Support\Facades\Storage;
use Core\src\Bike\UseCase\UpdateBikeImage\UpdateBikeImage;
use Illuminate\Database\Eloquent\Builder;

class Bike extends Model
{
    protected $table = 'bikes';

    private $uploadBikeImage;

    protected $fillable = [
        'name', 'brand', 'status', 'bike_address', 'image_path', 'price', 'remark',
    ];

    /** 一対多の記述(バイクは複数のユーザに従属) */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /** 多対多の記述(多数のバイクが中間テーブルを通して多数のユーザに予約される。) */
    public function reserved()
    {
        return $this->belongsToMany(User::class, 'reservations', 'bike_id', 'user_id');
    }

    /** 一対多の記述(バイクは複数のコメントを所有) */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /** 一対多の記述(バイクは複数の予約を所持) */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function getByBikeId(BikeId $bikeId): EloquentBike
    {
        return $this->newQuery()
            ->where('id', $bikeId->toInt())
            ->first();
    }

    public function updateBike(DomainBike $bike, string $imagePath, int $userId): void
    {
        $this->newQuery()
            ->where('id', $bike->bikeId()->toInt())
            ->update([
                'id' => $bike->bikeId()->toInt(),
                'user_id' => $userId,
                'name' => $bike->bikeName()->toString(),
                'brand' => $bike->brand()->toString(),
                'status' => $bike->status()->toString(),
                'bike_address' => $bike->bikeAddress()->toString(),
                'image_path' => $imagePath,
                'price' => $bike->price()->toInt(),
                'remark' => $bike->remark()->toString()
            ]);
    }

    /**
     * @return DomainBike
     */
    public function toModel(): DomainBike
    {
        return DomainBike::ofByArray($this->attributesToArray());
    }

    /**
     * 予約有無の確認
     * 
     * 該当する予約がすでにあるかを確認する
     * 
     * @param array $day 週初めの月曜日の日付
     * @param int $hours 00〜23時までの時間(1時間ずつ増加)
     * @param string $minutes 00or30分(30分単位で増加)
     * @param int $day_add 曜日ごとに0〜7を代入するための値(月曜なら0、火曜なら1といったように)
     * 
     * @return boolean 予約ありでtrue、予約なしでfalse
     */
    public function is_reservations($day, $hours, $minutes, $day_add)
    {
        $dt = Carbon::create($day)->addDay($day_add);
        $dt->hour = $hours;
        $dt->minute = $minutes;
        return $this->reservations()->where([['start_at', '<=', $dt], ['end_at', '>', $dt]])->exists();
    }

    /**
     * 自転車を登録する
     *
     * @param object $request 登録する自転車の情報
     * @return void
     */
    public function registerBike($request)
    {
        // リクエストから登録する自転車のインスタンスを生成
        $bike = $request->user()->bikes()->create([
            'brand' => $request->brand,
            'name' => $request->name,
            'status' => $request->status,
            'bike_address' => $request->bike_address,
            'price' => $request->price,
            'remark' => $request->remark,
        ]);

        // S3へ画像をアップロードする
        $bike->image_path = $this->uploadBikeImage->execute($request->image_path);
        // 自転車情報をDBへ保存する
        $bike->save();
    }

    /**
     * 自転車を検索する
     *
     * @param object $request 検索条件
     * @return array 検索結果
     */
    public function doSearchBikes($request)
    {
        // Bikeモデルのクエリ発行用インスタンス生成
        $query = Bike::query();
        // 検索条件:自転車モデル名
        $search_name = $request->input('search_name');
        // 検索条件:ブランド名
        $search_brand = $request->input('search_brand');
        // 検索条件:引き渡し場所
        $search_address = $request->input('search_address');
        // 検索条件:価格
        $search_price = $request->input('search_price');
        if (!empty('search_name')) {
            $query->where('name', 'like', '%' . $this->escapeWord($search_name) . '%');
        }
        if (!empty('search_brand')) {
            $query->where('brand', 'like', '%' . $this->escapeWord($search_brand) . '%');
        }
        if (!empty('search_address')) {
            $query->where('bike_address', 'like', '%' . $this->escapeWord($search_address) . '%');
        }
        $bikes = $query->get();
        // 検索結果を配列にして返却する
        return [$bikes, $search_name, $search_brand, $search_address, $search_price];
    }

    /**
     * 自転車の保管状態を論理名で設定する
     *
     * @param string $bike_status 自転車の保管状態
     * @return string 自転車の保管状態論理名
     */
    public function getBikeStatusLogicalName(string $bike_status)
    {
        // 自転車の保管状態の論理名を返却する
        return BikeStatus::from($bike_status)->label_BikeStatus();
    }

    /**
     * like検索時にエスケープワードを設定する
     *
     * @param string $search_word エスケープをする検索語句 
     * @return array エスケープ処理を行った検索語句
     */
    private function escapeWord($search_word, string $char = '\\')
    {
        return str_replace(
            [$char, '%', '_'],
            [$char . $char, $char . '%', $char . '_'],
            $search_word
        );
    }
}
