@push('css')
<link rel="stylesheet" href="{{ asset('/assets/css/reservation_modal.css') }}">
@endpush

<button type="button" id="reservationModalOpenBtn" class="btn btn-primary">予約手続き</button>
<div class="modal" id="reservationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">予約手続き</h5>
                <button id="modal-close-btn" type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group list-unstyled">
                    <form class="reservation-form"
                        action="{{ route('bikes.reservation', ['bikeId' => $bike['bikeId']]) }}" method="post">
                        @csrf
                        <li class="list-group-item">{{ Word::BIKE_INDEX_LABEL['start_date'] }}<input type="date"
                                name="start_date"><br>
                            {{ Word::BIKE_INDEX_LABEL['start_time'] }}
                            <select name="start_time">
                                @foreach($times as $time)
                                <option value="{{ $time }}">{{ $time }}</option>
                                @endforeach
                            </select>
                        </li>
                        <li class="list-group-item">{{ Word::BIKE_INDEX_LABEL['end_date'] }}<input type="date"
                                name="end_date"><br>
                            {{ Word::BIKE_INDEX_LABEL['end_time'] }}
                            <select name="end_time">
                                @foreach($times as $time)
                                <option value="{{ $time }}">{{ $time }}</option>
                                @endforeach
                            </select>
                        </li>
                </ul>
            </div>
            <div class="modal-footer">
                <button id="reservation-btn" type="submit" class="btn btn-primary">予約する</button>
            </div>
            </form>
        </div>
    </div>
</div>
<div class="modalWrapper" id="modalBackground"></div>
@vite('resources/ts/reservationDialog.ts')