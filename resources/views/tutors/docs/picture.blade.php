@if($tutor->picture == '')
<i class="far fa-id-badge text-info fa-6x mb-3"></i>
@else
<img src="{{ asset('storage/'.$tutor->picture) }}" class="img-thumbnail mb-3" alt="Profile Picture">
@endif
