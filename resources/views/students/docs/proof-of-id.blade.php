@if($student->proof_of_id == '')
    <i class="far fa-address-card fa-8x text-info"></i>
@else
    <img src="{{ asset('storage/'.$student->proof_of_id) }}" class="img-thumbnail" alt="Profile Picture">
@endif