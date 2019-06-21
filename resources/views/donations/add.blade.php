@extends('layout.default')

@section('breadcrumb')
    <li>
        <a href="{{ route('add_donation_form') }}" itemprop="url" class="l-breadcrumb-item-link">
            <span itemprop="title" class="l-breadcrumb-item-link-title">{{ config('other.title') }} Donate</span>
        </a>
    </li>
@endsection

@section('content')
	<div class="container">
		<div class="block">
			<div class="header gradient yellow">
				<div class="inner_content">
					<h1>Donate</h1>
				</div>
			</div>

			<div class="well text-center">
				Become a Supporter of {{ config('other.title') }}!
				<br>
				Thank you for showing an interest in making a donation to the site. Before sending a donation, please read this page carefully.<br /><br />
				<strong>What do I get for donating?</strong><br />
				Every donor will get Supporter Group which has the following benefits:<br />
				Immunity to the auto-ban because of low ratio.<br />
				Immunity From Hit an Run System.<br />
				Global Freeleech.<br />
				Bypass Upload Moderation.
				<br>
				<br>
				<strong>I am already a Supporter, can I donate again?</strong><br />
				Yes you can, Supporter expiry will be added on top of your existing Supporter expiry date. <br /><br />

				<strong>Thanks to the generosity of individuals like yourself, {{ config('other.title') }} will be able to continue providing the best service at all times.</strong><br /><br />
			</div>

			<h1 class="text-center">Donor Plans</h1>
			<hr>

			<div class="row">
			@foreach ($packages as $key => $package)
					<div class="col-sm-3">
						<div class="well well-sm">
							<div class="tags">
								{{ ++$key }}
							</div>
							<div class="text-center">
								<h3 class="text-bold text-pink">{{ $package->description }}</h3>
								<span class="text-bold text-green">$ {{ $package->cost }} USD</span>
							</div>
							<br>
							<div class="text-center">
								@if($package->upload_value)
									<span class="badge-extra">{{ App\Helpers\StringHelper::formatBytes($package->upload_value,2) }} upload credit</span><br />
								@endif

								@if($package->invite_value)
									<span class="badge-extra">{{ $package->invite_value }} invite(s)</span><br />
								@endif

								@if($package->bonus_value)
									<span class="badge-extra">{{ $package->bonus_value }} bonus point(s)</span><br />
								@endif

								@if($package->freeleech_value)
									<span class="badge-extra">{{ $package->freeleech_value }} day(s) of Supporter Group</span><br />
								@endif
								<br>
								<div class="text-center">
									<div class="donate"><strong><a href="#/" data-toggle="modal" data-target="#modal_donation_{{ $package->id }}" class="btn btn-md btn-primary">Donate</a></strong></div>
								</div>
							</div>
						</div>
					</div>
			@endforeach
			</div>
		</div>
@include('donations.donation_modals', ['packages' => $packages])
@endsection
