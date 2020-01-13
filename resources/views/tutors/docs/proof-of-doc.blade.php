@if($tutor->proof_of_doc == '')
    <i class="far fa-image fa-9x text-light"></i>
@else
    <img src="{{ asset('storage/'.$tutor->proof_of_doc) }}" class="img-thumbnail" alt="Proof of Document">
@endif