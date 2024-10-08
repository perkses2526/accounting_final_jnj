<div class="container mt-3">
    <table class="table table-striped table-bordered" id="modaltb">
        <thead>
            <tr>
                <th>#</th>
                <th>Transaction Name</th>
            </tr>
        </thead>
        <tbody>
            @if ($transaction_list->isEmpty())
                <tr>
                    <td colspan="3" class="text-center">No transactions available.</td>
                </tr>
            @else
                @foreach ($transaction_list as $index => $transaction)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ ucwords($transaction->transaction_name) }}</td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
