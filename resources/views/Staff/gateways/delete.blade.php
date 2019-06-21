@extends('layout.default')

@section('breadcrumb')
    <li>
        <a href="{{ route('staff_dashboard') }}" itemprop="url" class="l-breadcrumb-item-link">
            <span itemprop="title" class="l-breadcrumb-item-link-title">Staff Dashboard</span>
        </a>
    </li>
    <li>
        <a href="{{ route('staff_package_index') }}" itemprop="url" class="l-breadcrumb-item-link">
            <span itemprop="title" class="l-breadcrumb-item-link-title">Packages</span>
        </a>
    </li>
    <li class="active">
        <a href="{{ route('staff_package_delete', ['id' => $package->id]) }}" itemprop="url"
           class="l-breadcrumb-item-link">
            <span itemprop="title" class="l-breadcrumb-item-link-title">Delete Package</span>
        </a>
    </li>
@endsection

@section('content')
    <div class="container box">
        <h2>Delete: {{ $package->description }}</h2>
        <div class="table-responsive">
            <form role="form" method="POST"
                  action="{{ route('staff_package_delete',['id' => $package->id]) }}">
                @csrf
                <div class="table-responsive">
                <table class="table table-condensed table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                    	<th>Position</th>
                        <th>Description</th>
                        <th>Cost</th>
                        <th>Upload (GiB)</th>
			            <th>Invite (#)</th>
			            <th>Bonus (#)</th>
                        <th>VIP (Days)</th>
                        <th>Freeleech (Days)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{ $package->position }}</td>
                        <td>{{ $package->description }}</td>
                        <td>{{ $package->cost }}</td>
                        <td>{{ $package->upload_value }}</td>
                        <td>{{ $package->invite_value }}</td>
			            <td>{{ $package->bonus_value }}</td>
                        <td>{{ $package->vip_value }}</td>
                        <td>{{ $package->freeleech_value }}</td>
                    </tr>
                    </tbody>
                </table>
                </div>
                <button type="submit" class="btn btn-default">Delete</button>
            </form>
        </div>
    </div>
@endsection
