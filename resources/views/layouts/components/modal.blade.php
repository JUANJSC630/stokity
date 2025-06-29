<div class="modal fade" id="{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="{{ $labelId }}" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="{{ $labelId }}">{{ $title }}</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{ $slot }}
      </div>
      @isset($footer)
      <div class="modal-footer">
        {{ $footer }}
      </div>
      @endisset
    </div>
  </div>
</div>
