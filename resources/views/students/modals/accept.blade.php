 <!-- accept profile modal -->
 <button type="button" class="btn btn-sm btn-outline-success mr-2" data-toggle="modal"
   data-target="#accept-profile-modal">
   Accept request
 </button>
 <div class="modal fade" id="accept-profile-modal" tabindex="-1" role="dialog"
   aria-labelledby="accept-profile-modalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <form method="POST" action="{{ url('/connects/'.$student->user_id.'/accept') }}">
         @csrf
         @method('PUT')
         <div class="modal-header">
           <h5 class="modal-title" id="accept-profile-modalLabel">Accept request</h5>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
         </div>
         <div class="modal-body">
           <p class="text-left">
             Are you sure to accept request from {{ $student->user_first_name.' '.$student->user_last_name}}?
           </p>
         </div>
         <div class="modal-footer">
           <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
           <button type="submit" class="btn btn-sm btn-success">Accept</button>
         </div>
     </div>
     </form>
   </div>
 </div>