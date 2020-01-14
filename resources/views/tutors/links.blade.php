@if(auth()->user()->type == 1)
    @include('tutors.docs.picture')
    <a href="{{ url('/tutors/'.$tutor->id) }}" class="btn btn-sm btn-outline-success">View details</a>
@elseif(auth()->user()->type == 3)
    @if($connection['connected'])
        @include('tutors.docs.picture')
        <a href="{{ url('/tutors/'.$tutor->id) }}" class="btn btn-sm btn-outline-success">View details</a>
    @elseif($connection['request'] == 'received')
        <i class="far fa-id-badge fa-6x text-dark mb-3"></i>
        <a href="{{ url('/tutors/'.$tutor->id) }}" class="btn btn-sm btn-outline-dark">Accept request</a>
    @elseif($connection['request'] == 'sent')
        <i class="far fa-id-badge fa-6x text-info mb-3"></i>
        @include('tutors.modals.cancel')
    @else
        <i class="far fa-id-badge fa-6x text-info mb-3"></i>
        @include('tutors.modals.connect')
    @endif
@endif