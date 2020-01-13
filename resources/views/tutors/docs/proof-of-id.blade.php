@if($tutor->proof_of_id == '')
    <i class="far fa-address-card fa-8x text-light"></i>
@else
    <img src="{{ asset('storage/'.$tutor->proof_of_id) }}" class="img-thumbnail" alt="Proof of Identification">
@endif