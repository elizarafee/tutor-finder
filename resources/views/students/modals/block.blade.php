<!-- Button trigger modal -->
<button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#profile-block-Modal">
  Block this profile
</button>

<!-- Modal -->
<div class="modal fade" id="profile-block-Modal" tabindex="-1" role="dialog" aria-labelledby="profile-block-ModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <form method="POST" action="{{ url('/profiles/'.$student->user_id.'/block') }}">
        @csrf
        @method('PUT')

        <div class="modal-header">
          <h5 class="modal-title" id="profile-block-ModalLabel">Block profile</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <p class="text-left">Are you sure to block {{ $student->user_first_name.' '.$student->user_last_name}}?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-sm btn-danger">Block</button>
        </div>
      </form>
    </div>

  </div>
</div>