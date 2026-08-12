<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Wasll Ticket</title>
</head>

<body>

    <h1>Your ticket is confirmed</h1>

    <p>
        <strong>Ticket Number:</strong>
        {{ $ticket->ticket_number }}
    </p>

    <p>
        <strong>Trip:</strong>
        {{ $ticket->booking->trip->pickup_location }}
        →
        {{ $ticket->booking->trip->destination_location }}
    </p>

    <p>
        <strong>Departure:</strong>
        {{ $ticket->booking->trip->scheduled_departure }}
    </p>

    <p>
        <strong>Seat:</strong>
        {{ $ticket->booking->seat->seat_number }}
    </p>

    <p>
        <strong>Amount:</strong>
        {{ $ticket->amount }}
    </p>

    <p>
        Thanks for booking with us.
    </p>

</body>
</html>