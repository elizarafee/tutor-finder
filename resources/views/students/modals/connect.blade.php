<!-- connection request modal -->
<button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#connection-{{$student->id}}-request-modal">
                    Request to connect
                  </button>

                  <!-- Modal -->
                  <div class="modal fade" id="connection-{{$student->id}}-request-modal" tabindex="-1" role="dialog" aria-labelledby="connection-request-modalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <form method="POST" action="{{ url('/connects/'.$student->user_id) }}">
                          @csrf
                          <div class="modal-header">
                            <h5 class="modal-title" id="connection-request-modalLabel">Request to connect</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <p>Are you sure to send request to connect?</p>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-sm btn-primary">Send</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>