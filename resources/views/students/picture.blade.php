@if($student->picture == '')
<i class="far fa-id-badge fa-6x text-success mb-3"></i>
@else
<img src="{{ asset('storage/'.$student->picture) }}" class="img-thumbnail mb-3" alt="Profile Picture">
@endif
