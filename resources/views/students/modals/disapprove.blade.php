<!-- disapprove profile modal -->
<button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#disapprove-profile-modal">
            Disapprove the profile
          </button>
          <div class="modal fade" id="disapprove-profile-modal" tabindex="-1" role="dialog" aria-labelledby="disapprove-profile-modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">

                <form method="POST" action="{{ url('/profiles/'.$student->user_id.'/disapprove') }}">
                  @csrf
                  @method('PUT')

                  <div class="modal-header">
                    <h5 class="modal-title" id="disapprove-profile-modalLabel">Profile disapprove</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div class="form-row">
                      <label>Please provide reason</label>
                      <textarea name="reason" class="form-control" placeholder="Why you are disapproving this profile?"></textarea>
                    </div>
                  </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-sm btn-danger">Disapprove</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>