@extends('layouts.app')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Todoリスト</h1>
            <ul id="list-block">
            </ul>
            <input id="input-message" type="text" class="form-control">
            <button id="btn-message-send" class="btn btn-primary mt-2">送信</button>
        </div>
    </div>
</div>
@vite('resources/ts/sendMessage.ts')