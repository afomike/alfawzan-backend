@extends('layouts.app')

@section('title', 'My Receipts')

@section('content')
<h2>My Receipts</h2>

<table class="table table-striped mt-4">
    <thead>
        <tr>
            <th>Receipt Number</th>
            <th>Payment Reference</th>
            <th>Amount</th>
            <th>Generated At</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($receipts as $receipt)
        <tr>
            <td>{{ $receipt->receipt_number }}</td>
            <td>{{ $receipt->payment->payment_reference }}</td>
            <td>₦{{ number_format($receipt->payment->amount, 2) }}</td>
            <td>{{ $receipt->generated_at->format('M d, Y H:i') }}</td>
            <td>
                <a href="{{ route('user.receipts.show', $receipt) }}" class="btn btn-sm btn-info">View</a>
                <a href="{{ route('user.receipts.download', $receipt) }}" class="btn btn-sm btn-success">Download</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $receipts->links() }}
@endsection

