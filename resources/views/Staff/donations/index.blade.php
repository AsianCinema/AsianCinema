@extends('layout.default')

@section('breadcrumb')
    <li>
        <a href="{{ route('staff_dashboard') }}" itemprop="url" class="l-breadcrumb-item-link">
            <span itemprop="title" class="l-breadcrumb-item-link-title">Staff Dashboard</span>
        </a>
    </li>
    <li class="active">
        <a href="{{ route('staff_donation_index') }}" itemprop="url" class="l-breadcrumb-item-link">
            <span itemprop="title" class="l-breadcrumb-item-link-title">Donations</span>
        </a>
    </li>
@endsection

@section('content')
    <div class="container box">
        <h2>Donations</h2>
        <a href="{{ route('staff_donation_add_form') }}" class="btn btn-primary">Add New Donation</a>
        <div class="table-responsive">
            <table class="table table-condensed table-striped table-bordered table-hover">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>User</th>
					<th>Transaction ID</th>
                    <th>Amount</th>
                    <th>Upload</th>
                    <th>Invite #</th>
			        <th>Bonus #</th>
                    <th>Supporter</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($donations as $donation)
                    <tr>
                        <td>{{ $donation->created_at }}</td>
                        <td>
                        <a class="text-bold" href="{{ route('profile', ['username' => $donation->user->username, 'id' => $donation->user->id ]) }}">{{ $donation->user->username }}</a>
                        </td>
                        <td>{{ $donation->transaction }}</td>
                        <td>$ {{ $donation->cost }}</td>
                        <td>{{ App\Helpers\StringHelper::formatBytes($donation->upload_value,2) }}</td>
                        <td>{{ $donation->invite_value }}</td>
			            <td>{{ $donation->bonus_value }}</td>
                        <td>{{ $donation->vip_value }} day(s)</td>
						@if ($donation->status == 0)
                        <td>
                        <a href="{{ route('staff_donation_approve', ['id' => $donation->id]) }}" class="btn btn-success">Approve</a>
                        <a href="{{ route('staff_donation_reject', ['id' => $donation->id]) }}" class="btn btn-danger">Reject</a>
                        </td>
						@endif
						@if ($donation->status == 1)
                        <td>
                        <a href="{{ route('staff_donation_reverse', ['id' => $donation->id]) }}" class="btn btn-danger">Reverse</a>
						</td>
						@endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-center">
            {{ $donations->links() }}
        </div>
    </div>
@endsection
