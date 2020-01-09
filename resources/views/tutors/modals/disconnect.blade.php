<!-- Button trigger modal -->
<button type="button" class="btn btn-sm btn-outline-primary mr-2" data-toggle="modal"
  data-target="#disconnect-profile-modal">
  Remove connection
</button>

<!-- Modal -->
<div class="modal fade" id="disconnect-profile-modal" tabindex="-1" role="dialog"
  aria-labelledby="disconnect-profile-modalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <form method="POST" action="{{ url('/connects/'.$tutor->user_id.'/disconnect') }}">
        @csrf
        @method('PUT')

        <div class="modal-header">
          <h5 class="modal-title" id="disconnect-profile-modalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <p class="text-left">Are you sure to disconnect with {{ $tutor->user_first_name.' '.$tutor->user_last_name}}?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-sm btn-danger">Disconnect</button>
        </div>
      </form>
    </div>
  </div>
</div>