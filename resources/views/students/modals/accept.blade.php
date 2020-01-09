 <!-- approve profile modal -->
 <button type="button" class="btn btn-sm btn-outline-success mr-2" data-toggle="modal"
   data-target="#approve-profile-modal">
   Accept request
 </button>
 <div class="modal fade" id="approve-profile-modal" tabindex="-1" role="dialog"
   aria-labelledby="approve-profile-modalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
     <div class="modal-content">

       <form method="POST" action="{{ url('/connects/'.$student->user_id.'/accept') }}">
         @csrf
         @method('PUT')

         <div class="modal-header">
           <h5 class="modal-title" id="approve-profile-modalLabel">Profile approve</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <p>
             Are you sure to approve profile of {{ $student->user_first_name.' '.$student->user_last_name}}?
             <span class="badge badge-info">Please verify proof of identification before approve the profile</span>
           </p>
         </div>

         <div class="modal-footer">
           <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
           <button type="submit" class="btn btn-sm btn-success">Approve</button>
         </div>
     </div>
     </form>
   </div>
 </div>