 <!-- activate profile modal -->
 <button type="button" class="btn btn-sm btn-outline-success mr-2" data-toggle="modal" data-target="#activate-profile-modal">
            Activate profile
          </button>
          <div class="modal fade" id="activate-profile-modal" tabindex="-1" role="dialog" aria-labelledby="activate-profile-modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">

                <form method="POST" action="{{ url('/profile/activate') }}">
                  @csrf
                  @method('PUT')

                  <div class="modal-header">
                    <h5 class="modal-title" id="activate-profile-modalLabel">Activate profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p class="text-left">
                      Are you sure to activate your profile?
                     </p>
                  </div>

                  <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-sm btn-success">Activate</button>
                  </div>
              </div>
              </form>
            </div>
          </div>