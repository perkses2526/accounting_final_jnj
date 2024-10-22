<!DOCTYPE html>
<html>

<head>
    <title>Ticket Status Updated</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            color: #2c3e50;
        }

        .info-box {
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            padding: 15px;
            margin-bottom: 20px;
        }

        .info-item {
            margin-bottom: 10px;
        }

        .label {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Ticket Status Updated</h1>
        <p>Your ticket has been updated with the following details:</p>

        <div class="info-box">
            <div class="info-item">
                <span class="label">Status: {{ $ticket->status }}
            </div>
            @if ($ticket->reason_if_denied)
                <div class="info-item">
                    <span class="label">Reason (if denied): {{ $ticket->reason_if_denied }}
                </div>
            @endif
            <div class="info-item">
                <span class="label">Date Updated: {{ $ticket->date_status_updated }}
            </div>
            <div class="info-item">
                <span class="label">Approved By: {{ $ticket->first_name }} {{ $ticket->last_name }}
            </div>
            <div class="info-item">
                <span class="label">Transaction: {{ $ticket->transaction_name }}
            </div>
        </div>

        <p>If you have any questions or concerns, please don't hesitate to contact us.</p>
        <p>Thank you for using our service!</p>
    </div>
</body>

</html>
