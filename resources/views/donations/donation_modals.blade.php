{{-- Donate Modal --}}
@foreach ($packages as $package)
<div class="modal fade" id="modal_donation_{{ $package->id }}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <meta charset="utf-8">
            <title>Donate:</title>
            <form role="form" method="POST" action="{{ route('add_donation') }}">
            @csrf
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="myModalLabel"><strong>Donate $ {{ $package->cost }} USD</strong></h4>
            </div>
            <div class="modal-body">
			To make a donation and become a Supporter, you must complete the following steps:
				For Crypto:
				<div class="xt-jp">
					1: Copy one the following crypto wallet addresses.<br />
					@foreach($gateways as $gateway)
						<div class="label label-default" style=" display: inline-block;"> {{$gateway->name }} </div>
						<input class="form-control" type="text" disabled value="{{ $gateway->address }}" />
					@endforeach
					2: Send <strong>$ {{ $package->cost }} USD</strong> to cryto wallet of your choice.<br />
					5: Take note of the transaction ID after you have paid.<br />
					6: Enter the transaction ID below.
				</div>
			<div class="xt-e">
			<div class="xt-g">
			Amount:<br />
                <input type="number" name="amount" value="{{ $package->cost }}" placerholder=""
                    class="form-control" disabled/>
			</div>
			<div class="xt-g">
			Transaction ID:<br />
                 <input type="text" name="transaction" value="" placerholder=""
                    class="form-control"/>
			</div>
			<div class="xt-g">
			    <input type="hidden" name="itemID" value="{{ $package->id }}" />
	                <button type="submit" class="btn btn-primary">Donate</button>
			</div>
			</div>
			<div class="xt-fpv">* Transactions may take up to 48 hours to process.</div>
			</div>
			<div class="modal-footer">
				<button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Close</button>
			</div>
			</form>
        </div>
    </div>
</div>
@endforeach