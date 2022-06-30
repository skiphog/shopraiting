@push('styles')
    <link rel="stylesheet" href="/css/modal.css">
    <link rel="stylesheet" href="/css/modal-attention.css">
    <link rel="stylesheet" href="/css/modal-error.css">
@endpush

<div class="modal">
    <div class="modal__header">
        <div class="modal__title">Спасибо!</div>
        <svg class="icon modal__close" width="16px" height="16px">
            <use xlink:href="/img/sprite.svg#close"></use>
        </svg>
    </div>
    <div class="modal__text"></div>
</div>
<div class="modal-error">
    <div class="modal-error__header">
        <div class="modal-error__title">Ой!</div>
        <svg class="icon modal-error__close" width="16px" height="16px">
            <use xlink:href="/img/sprite.svg#close"></use>
        </svg>
    </div>
    <div class="modal-error__text"></div>
</div>

@push('scripts')
    <script src="/js/modal.js"></script>
@endpush