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
        <a href="{{ route('staff_donation_add') }}" itemprop="url" class="l-breadcrumb-item-link">
            <span itemprop="title" class="l-breadcrumb-item-link-title">Add Donation</span>
        </a>
    </li>
@endsection

@section('content')
    <div class="container box">
        <h2>Add New Donation</h2>
        <div class="table-responsive">
            <form role="form" method="POST" action="{{ route('staff_donation_add') }}">
                @csrf
            	<div class="form-group">
               		<label for="users">Select a User</label>
                	<select class="form-control user-select-placeholder-single" name="userID">
                   	 @foreach ($users as $user)
                        	<option value="{{ $user->id }}">{{ $user->username }}</option>
                    	@endforeach
                	</select>
            	</div>
            	<div class="form-group">
               		<label for="users">Select a Package</label>
                	<select class="form-control user-select-placeholder-single" name="itemID">
                   	 @foreach ($packages as $package)
                        	<option value="{{ $package->id }}">{{ $package->description }} [ $ {{ $package->cost }} ]</option>
                    	@endforeach
                	</select>
            	</div>
                <button type="submit" class="btn btn-default">Add</button>
            </form>
        </div>
    </div>
@endsection
