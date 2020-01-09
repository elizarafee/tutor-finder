<!-- connection request modal -->
<button type="button" title="Sent at {{date('j F Y g:iA', strtotime($connection['time']))}}"
  class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#cancel-{{$tutor->id}}-request-modal">
  Cancel request
</button>

<!-- Modal -->
<div class="modal fade" id="cancel-{{$tutor->id}}-request-modal" tabindex="-1" role="dialog"
  aria-labelledby="cancel-request-modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="POST" action="{{ url('/connects/'.$tutor->user_id) }}">
        @csrf
        @method('DELETE')
        <div class="modal-header">
          <h5 class="modal-title" id="cancel-request-modalLabel">Cancel request</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <p class="text-left">Are you sure to send cancel the connection request?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-sm btn-danger">Yes</button>
        </div>
      </form>
    </div>
  </div>
</div>