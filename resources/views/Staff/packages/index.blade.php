@extends('layout.default')

@section('breadcrumb')
    <li>
        <a href="{{ route('staff_dashboard') }}" itemprop="url" class="l-breadcrumb-item-link">
            <span itemprop="title" class="l-breadcrumb-item-link-title">Staff Dashboard</span>
        </a>
    </li>
    <li class="active">
        <a href="{{ route('staff_package_index') }}" itemprop="url" class="l-breadcrumb-item-link">
            <span itemprop="title" class="l-breadcrumb-item-link-title">Packages</span>
        </a>
    </li>
@endsection

@section('content')
    <div class="container box">
        <h2>Packages</h2>
        <a href="{{ route('staff_package_add_form') }}" class="btn btn-primary">Add A Package</a>
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
                    <th>Supporter (Days)</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($packages as $package)
                    <tr>
                        <td>{{ $package->position }}</td>
                        <td>
                        <a href="{{ route('staff_package_edit', ['id' => $package->id]) }}">{{ $package->description }}</a>
                        </td>
                        <td>$ {{ $package->cost }}</td>
                        <td>{{ App\Helpers\StringHelper::formatBytes($package->upload_value,2) }}</td>
                        <td>{{ $package->invite_value }}</td>
			            <td>{{ $package->bonus_value }}</td>
                        <td>{{ $package->vip_value }} day(s)</td>
                        <td>
                        <a href="{{ route('staff_package_delete', ['id' => $package->id]) }}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="text-center">
            {{ $packages->links() }}
        </div>
    </div>
@endsection
