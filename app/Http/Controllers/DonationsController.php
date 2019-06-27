<?php
/**
 * NOTICE OF LICENSE.
 *
 * UNIT3D is open-sourced software licensed under the GNU General Public License v3.0
 * The details is bundled with this project in the file LICENSE.txt.
 *
 * @project    UNIT3D
 *
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html/ GNU Affero General Public License v3.0
 * @author     HDVinnie
 */

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Donation;
use Illuminate\Http\Request;
use App\Helpers\StringHelper;
use App\Models\DonationGateway;
use App\Models\DonationPackage;
use App\Http\Controllers\Controller;

class DonationsController extends Controller
{
    /**
     * Get Add Donation Forum.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $packages = DonationPackage::all()->sortBy('position');
        $gateways = DonationGateway::all();
        return view('donations.add', ['packages' => $packages, 'gateways' => $gateways]);
    }

    /**
     * Send A Donation To Owner/Admin.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse
     */
     
    public function store(Request $request)
    {
        $donation = new Donation();
        $itemID = $request->input('itemID');
        $transaction = $request->input('transaction');

        $v = validator($request->all(), [
        'itemID' => 'required|numeric|min:0|max:9999',
        'transaction'=> 'required|alpha_num|min:1|max:255',
        ]);
        
        if ($v->fails()) {
            return redirect()->route('add_donation_form')
                ->withErrors($v->errors());
        } else {
            
            $package = DonationPackage::where('id', '=', $itemID)->first();
            if (! $package) {
                 return redirect()->route('add_donation_form')
                    ->withErrors('Selected Package Could Not Be Found!');
            }
            $recipient = User::where('id', '=', auth()->user()->id)->first();
            if (! $recipient) {
                 return redirect()->route('add_donation_form')
                    ->withErrors('Donating User Could Not Be Found!');
            }
            
            $donation->status = 0;
            $donation->bonus_value = $package->bonus_value;
            $donation->freeleech_value = $package->freeleech_value;
            $donation->upload_value = $package->upload_value;
            $donation->invite_value = $package->invite_value;
            $donation->vip_value = $package->vip_value;
            $donation->package_id = $itemID;
            $donation->user_id = $recipient->id;
            $donation->transaction = $transaction;
            $donation->cost = $package->cost;
            $donation->save();

            // Activity Log
            \LogActivity::addToLog("Member {$recipient->username} has donated {$donation->cost}.");

            return redirect()->route('add_donation_form')
                ->withSuccess('Thank You For Supporting Us! Please allow for upto 48 hours for staff to confirm transaction.');
        }
    }
}
