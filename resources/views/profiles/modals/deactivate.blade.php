<!-- deactivate profile modal -->
<button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal" data-target="#deactivate-profile-modal">
            Deactivate profile
          </button>
          <div class="modal fade" id="deactivate-profile-modal" tabindex="-1" role="dialog" aria-labelledby="deactivate-profile-modalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">

                <form method="POST" action="{{ url('/profile/deactivate') }}">
                  @csrf
                  @method('PUT')

                  <div class="modal-header">
                    <h5 class="modal-title" id="deactivate-profile-modalLabel">Deactivate profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                  <p class="text-left">
                  If you deactivate your profile no tutors will be able to find you. Are you sure to deactivate your profile? 
                     </p>
                  </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-sm btn-danger">Deactivate</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>