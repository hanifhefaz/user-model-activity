@if (isset($pagination))
    <ul>
        @foreach ($pagination as $logEntry)
            <li>{{ $logEntry }}</li>
        @endforeach
    </ul>
    {{ $pagination->links('pagination::bootstrap-4') }}
@else
    <p>No log content available.</p>
@endif
