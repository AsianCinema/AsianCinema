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
        <a href="{{ route('staff_package_add') }}" itemprop="url" class="l-breadcrumb-item-link">
            <span itemprop="title" class="l-breadcrumb-item-link-title">Add Package</span>
        </a>
    </li>
@endsection

@section('content')
    <div class="container box">
        <h2>Add New Package</h2>
        <div class="table-responsive">
            <form role="form" method="POST" action="{{ route('staff_package_add') }}">
                @csrf
                <div class="table-responsive">
                <table class="table table-condensed table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Position</th>
                        <th>Description</th>
                        <th>Cost</th>
                        <th>Upload (Bytes)</th>
                        <th>Invite (#)</th>
                        <th>Bonus (#)</th>
                        <th>Supporter (Days)</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <input type="number" name="position" value="" placerholder="0"
                                   class="form-control"/>
                        </td>
                        <td>
                            <input type="text" name="description" value="" placeholder="Description" class="form-control"/>
                        </td>
                        <td>
                            <input type="number" step="0.01" name="cost" value="" placeholder="Cost"
                                   class="form-control"/>
                        </td>
                        <td>
                            <input type="number" name="upload_value" value="" placeholder="(If Applicable)"
                                   class="form-control"/>
                        </td>
                        <td>
                            <input type="number" name="invite_value" value="" placeholder="(If Applicable)"
                                   class="form-control"/>
                        </td>
                        <td>
                            <input type="number" name="bonus_value" value="" placeholder="(If Applicable)"
                                   class="form-control"/>
                        </td>
                        <td>
                            <input type="number" name="vip_value" value="" placeholder="(If Applicable)"
                                   class="form-control"/>
                        </td>
                    </tr>
                    </tbody>
                </table>
                </div>
                <button type="submit" class="btn btn-default">Add</button>
            </form>
        </div>
    </div>
@endsection
