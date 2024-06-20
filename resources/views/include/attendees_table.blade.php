@foreach ($attendees as $attendee)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $attendee->volunteer->regno }}</td>
        <td>{{ $attendee->volunteer->name }}</td>
        <td>{{ $attendee->volunteer->courses->name }}</td>
        <td>{{ $attendee->volunteer->batches->name }}</td>
    </tr>
@endforeach
