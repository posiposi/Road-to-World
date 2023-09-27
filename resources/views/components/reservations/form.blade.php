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
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<div class="modalWrapper" id="modalBackground"></div>
@vite('resources/ts/reservationDialog.ts')