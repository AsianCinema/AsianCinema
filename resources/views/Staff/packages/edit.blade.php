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
        <a href="{{ route('staff_package_edit', ['id' => $package->id]) }}" itemprop="url"
           class="l-breadcrumb-item-link">
            <span itemprop="title" class="l-breadcrumb-item-link-title">Edit Package</span>
        </a>
    </li>
@endsection

@section('content')
    <div class="container box">
        <h2>Edit: {{ $package->description }}</h2>
        <div class="table-responsive">
            <form role="form" method="POST"
                  action="{{ route('staff_package_edit',['id' => $package->id]) }}">
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
                        <th>Supporter (Days)</th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <td><input type="text" name="position" value="{{ $package->position }}" class="form-control"/></td>
                        <td><input type="text" name="description" value="{{ $package->description }}" class="form-control"/></td>
                        <td><input type="number" step="0.01" name="cost" value="{{ $package->cost }}" class="form-control"/></td>
                        <td><input type="number" name="upload_value" value="{{ $package->upload_value }}" class="form-control"/></td>
                        <td><input type="number" name="invite_value" value="{{ $package->invite_value }}" class="form-control"/></td>
			            <td><input type="number" name="bonus_value" value="{{ $package->bonus_value }}" class="form-control"/></td>
                        <td><input type="number" name="vip_value" value="{{ $package->vip_value }}" class="form-control"/></td>
                    </tr>
                    </tbody>
                </table>
                </div>
                <button type="submit" class="btn btn-default">Save</button>
            </form>
        </div>
    </div>
@endsection
