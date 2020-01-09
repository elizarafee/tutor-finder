@if(auth()->user()->type == 1)
    @include('students.picture')
    <a href="{{ url('/students/'.$student->id) }}" class="btn btn-sm btn-outline-success">View details</a>
@elseif(auth()->user()->type == 2)
    @if($connection['connected'])
        @include('students.picture')
        <a href="{{ url('/students/'.$student->id) }}" class="btn btn-sm btn-outline-success">View details</a>
    @elseif($connection['request'] == 'received')
        <i class="far fa-id-badge fa-6x text-dark mb-3"></i>
        <a href="{{ url('/students/'.$student->id) }}" class="btn btn-sm btn-outline-dark">Accept request</a>
    @elseif($connection['request'] == 'sent')
        <i class="far fa-id-badge fa-6x text-info mb-3"></i>
        @include('students.modals.cancel')
    @else
        <i class="far fa-id-badge fa-6x text-light mb-3"></i>
        @include('students.modals.connect')
    @endif
@endif