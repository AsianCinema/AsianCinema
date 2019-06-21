@extends('layout.default')

@section('breadcrumb')
    <li>
        <a href="{{ route('staff_dashboard') }}" itemprop="url" class="l-breadcrumb-item-link">
            <span itemprop="title" class="l-breadcrumb-item-link-title">Staff Dashboard</span>
        </a>
    </li>
    <li>
        <a href="{{ route('staff_gateway_index') }}" itemprop="url" class="l-breadcrumb-item-link">
            <span itemprop="title" class="l-breadcrumb-item-link-title">Gateways</span>
        </a>
    </li>
    <li class="active">
        <a href="{{ route('staff_gateway_add') }}" itemprop="url" class="l-breadcrumb-item-link">
            <span itemprop="title" class="l-breadcrumb-item-link-title">Add Gateway</span>
        </a>
    </li>
@endsection

@section('content')
    <div class="container box">
        <h2>Add New Gateway</h2>
        <div class="table-responsive">
            <form role="form" method="POST" action="{{ route('staff_gateway_add') }}">
                @csrf
                <div class="table-responsive">
                <table class="table table-condensed table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Position</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Active</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <input type="number" name="position" value="" placerholder="0"
                                   class="form-control"/>
                        </td>
                        <td>
                            <input type="text" name="name" value="" placeholder="Name" class="form-control"/>
                        </td>
                        <td>
                            <input type="text" name="address" value="" placeholder="Wallet Address"
                                   class="form-control"/>
                        </td>
                        <td>
                            <label for="sd" class="control-label">Active?</label>
                            <div class="radio-inline">
                                <label><input type="radio" name="status" value="1">@lang('common.yes')</label>
                            </div>
                            <div class="radio-inline">
                                <label><input type="radio" name="status" checked="checked" value="0">@lang('common.no')</label>
                            </div>
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
