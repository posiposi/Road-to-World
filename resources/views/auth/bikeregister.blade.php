@extends('layouts.app')

@section('content')
<div class="text-center my-4">
    <h1>バイク登録</h1>
</div>

<div class="row">
    <div class="col-sm-6 offset-sm-3">
        <form action="{{ route('bikes.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mt-3">
                <label for="brand">ブランド</label>
                <input class="form-control" type="text" name="brand" value="">
            </div>

            <div class="mt-3">
                <label for="name">モデル名</label>
                <input class="form-control" type="text" name="name" value="">
            </div>

            <div class="mt-3">
                <label for="status">保管状態</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" value="良好" name="status">
                <label class="form-check-label">
                    良好
                </label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" value="普通" name="status">
                <label class="form-check-label">
                    普通
                </label>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" value="悪い" name="status">
                <label class="form-check-label">
                    悪い
                </label>
            </div>

            <div class="mt-3">
                <label for="bike_address">受け渡し場所</label>
                <input class="form-control" type="text" name="bike_address" value="">
            </div>

            <div class="mt-3">
                <label for="price">料金(¥/30分)</label>
                <input class="form-control" type="text" name="price" value="" placeholder="価格はコンマなしで入力してください。">
            </div>

            <div class="mt-3">
                <label for="remark">説明・備考</label>
                <textarea class="form-control" name="remark" cols="50" rows="2" placeholder="150文字以内で入力してください。"
                    maxlength="150"></textarea>
            </div>

            <div class="mt-3">
                <input type="file" name="image_path">
            </div>
            <input class="d-grid mx-auto mt-2 btn btn-success rounded-pill" type="submit" value="登録">
        </form>
    </div>
</div>
@endsection