@extends('layout.default')

@section('breadcrumb')
    <li>
        <a href="{{ route('staff_dashboard') }}" itemprop="url" class="l-breadcrumb-item-link">
            <span itemprop="title" class="l-breadcrumb-item-link-title">Staff Dashboard</span>
        </a>
    </li>
    <li>
        <a href="{{ route('staff_donation_index') }}" itemprop="url" class="l-breadcrumb-item-link">
            <span itemprop="title" class="l-breadcrumb-item-link-title">Donations</span>
        </a>
    </li>
    <li class="active">
        <a href="{{ route('staff_donation_reverse_form', ['id' => $donation->id]) }}" itemprop="url"
           class="l-breadcrumb-item-link">
            <span itemprop="title" class="l-breadcrumb-item-link-title">Reverse Donation</span>
        </a>
    </li>
@endsection

@section('content')
    <div class="container box">
        <h2>Reverse: {{ $donation->transaction }}</h2>
        <div class="table-responsive">
            <form role="form" method="POST"
                  action="{{ route('staff_donation_reverse',['id' => $donation->id]) }}">
                @csrf
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
                    <th>FL</th>
                    <th>VIP</th>
                </tr>
                </thead>
                <tbody>
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
                        <td>{{ $donation->freeleech_value }} day(s)</td>
                        <td>{{ $donation->vip_value }} day(s)</td>
                    </tr>
                </tbody>
            </table>
                </div>
                <button type="submit" class="btn btn-default">Reverse</button>
            </form>
        </div>
    </div>
@endsection
