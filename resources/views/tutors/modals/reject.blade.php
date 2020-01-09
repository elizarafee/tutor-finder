 <!-- reject profile modal -->
 <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal"
            data-target="#reject-profile-modal">
            Reject request
          </button>
          <div class="modal fade" id="reject-profile-modal" tabindex="-1" role="dialog"
            aria-labelledby="reject-profile-modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">

                <form method="POST" action="{{ url('/connects/'.$tutor->user_id.'/reject') }}">
                  @csrf
                  @method('PUT')

                  <div class="modal-header">
                    <h5 class="modal-title" id="reject-profile-modalLabel">Reject request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p class="text-left">
                      Are you sure to reject connection request from {{ $tutor->user_first_name.' '.$tutor->user_last_name}}?
                    </p>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-danger">Reject</button>
                  </div>
              </div>
              </form>
            </div>
          </div>