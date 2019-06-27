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

namespace App\Http\Controllers\Staff;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Package;
use App\Models\Donation;
use Illuminate\Http\Request;
use App\Helpers\StringHelper;
use App\Models\PrivateMessage;
use App\Models\BonTransactions;
use App\Models\DonationPackage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DonationsController extends Controller
{
    /**
     * Get All Donations.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $donations = Donation::latest()->paginate(25);
    
        return view('Staff.donations.index', ['donations' => $donations]);
    }

    /**
     * Donation Create Form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $users = User::oldest('username')->get();
        $packages = DonationPackage::all()->sortBy('cost');

        return view('Staff.donations.add',['users' => $users, 'packages' => $packages]);
    }

    /**
     * Create A New Donation.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $now = Carbon::now();
        $donation = new Donation();
        $staff = auth()->user();
        $userID = $request->input('userID');
        $itemID = $request->input('itemID');
        $v = validator($request->all(), [
            'userID'  => 'required|numeric|exists:users,id',
            'itemID' => 'required|numeric|min:0',
        ]);
        if ($v->fails()) {
            return redirect()->route('staff_donation_index')
                ->withErrors($v->errors());
        } else {
            $package = DonationPackage::findOrFail($itemID);
            if (!$package) {
                 return redirect()->route('staff_donation_index')
                     ->withErrors('Donation Package Not Found!');
            }
            $recipient = User::where('id','=',$userID)->first();
            if (!$recipient) {
                 return redirect()->route('staff_donation_index')
                     ->withErrors('Donation User Not Found!');
            }
            $donation->status = 1;
            $donation->bonus_value = $package->bonus_value;
            $donation->freeleech_value = $package->freeleech_value;
            $donation->upload_value = $package->upload_value;
            $donation->invite_value = $package->invite_value;
            $donation->vip_value = $package->vip_value;
            if ($donation->vip_value > 0) { 
                $donation->vip_expires = $now->copy()->addDays($package->vip_value)->toDateTimeString();
            }
            else {
                $donation->vip_expires = null;
            }
            $donation->package_id = $package->id;
            $donation->transaction = '';
            $donation->user_id = $recipient->id;
            $donation->cost = $package->cost;
            $donation->save();
            
            $new_vip_expire = null;

            $checks = Donation::whereRaw('user_id = ? AND status != ?',[$donation->user_id,0])->get();
            foreach($checks as $check) {
                if($check->vip_expires > $now->copy()->toDateTimeString() && $check->vip_expires > $new_vip_expire) {
                    $new_vip_expire = $check->vip_expires;
                }
            }
            if($package->bonus_value > 0) {
                $recipient->seedbonus = $recipient->seedbonus+$package->bonus_value;
                $transaction = new BonTransactions();
                $transaction->itemID = 0;
                $transaction->name = 'donation';
                $transaction->cost = $package->bonus_value;
                $transaction->sender = 1;
                $transaction->receiver = $recipient->id;
                $transaction->comment = '';
				$transaction->donation_id = $donation->id;
                $transaction->torrent_id = null;
                $transaction->save();
            }

            $recipient->invites = $recipient->invites+$package->invite_value;
            $recipient->uploaded = $recipient->uploaded+$package->upload_value;
            $recipient->group_id = 22;
            $recipient->save();

            $pm = new PrivateMessage();
            $pm->sender_id = $staff->id;
            $pm->receiver_id = $recipient->id;
            $pm->subject = "{$staff->username} Has Applied A Donation To Your Account";
            $pm->message = "{$staff->username} Has Applied A Donation To Your Account. Thank you so much for donating and helping keep this site alive and well!";
            $pm->save();

            // Activity Log
            \LogActivity::addToLog("Staff Member {$staff->username} has added a {$donation->cost} donation package to {$recipient->username}.");

            return redirect()->route('staff_donation_index')
                ->withSuccess('Donation Added!');
        }
    }

    /**
     * Donation Approval Form.
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function approveForm($id)
    {
        $donation = Donation::findOrFail($id);
        return view('Staff.donations.approve', ['donation' => $donation]);
    }

    /**
     * Approve A Donation.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse
     */
    public function approve(Request $request, $id)
    {
        $now = Carbon::now();
        $staff = auth()->user();
        $donation = Donation::findOrFail($id);
        $recipient = User::where('id', '=', $donation->user_id)->first();
        if (! $recipient) {
            return redirect()->route('staff_donation_index')
                ->withErrors('Donating User Could Not Be Found!');
        }
        else {
            $recipient = User::where('id','=',$donation->user_id)->first();
            if (!$recipient) {
                 return redirect()->route('staff_donation_index')
                     ->withErrors('Donating User Could Not Be Found!');
            }
            $donation->status = 1;
            if ($donation->vip_value > 0) { 
                $donation->vip_expires = $now->copy()->addDays($donation->vip_value)->toDateTimeString();
            }
            else {
                $donation->vip_expires = null;
            }
            $donation->save();
            
            $new_vip_expire = null;

            $checks = Donation::whereRaw('user_id = ? AND status != ?',[$donation->user_id,0])->get();
            foreach($checks as $check) {
                if($check->vip_expires > $now->copy()->toDateTimeString() && $check->vip_expires > $new_vip_expire) {
                    $new_vip_expire = $check->vip_expires;
                }
            }

            if($donation->bonus_value > 0) {
                $recipient->seedbonus = $recipient->seedbonus+$donation->bonus_value;
                $transaction = new BonTransactions();
                $transaction->itemID = 0;
                $transaction->name = 'donation';
                $transaction->cost = $donation->bonus_value;
                $transaction->sender = 1;
                $transaction->receiver = $recipient->id;
                $transaction->comment = '';
				$transaction->donation_id = $donation->id;
                $transaction->torrent_id = null;
                $transaction->save();
            }

            $recipient->invites = $recipient->invites+$donation->invite_value;
            $recipient->uploaded = $recipient->uploaded+$donation->upload_value;
            $recipient->group_id = 22; // Need to change this to a Group call to remove hard coding ... and that is why hard coding is bad.
            $recipient->save();

            $pm = new PrivateMessage();
            $pm->sender_id = $staff->id;
            $pm->receiver_id = $recipient->id;
            $pm->subject = "Your donation from, {$donation->created_at} ,has been approved by {$staff->username}";
            $pm->message = "Your donation from, {$donation->created_at} ,has been approved by {$staff->username}. 
            The donations transaction ID has been verified. Thank you so much for donating and helping keep this site alive and well!";
            $pm->save();

            // Activity Log
            \LogActivity::addToLog("Staff Member {$staff->username} has approved a {$donation->cost} donation package for {$recipient->username}.");

            return redirect()->route('staff_donation_index')
                ->withSuccess('Donation Approved!');
        }
    }

    /**
     * Donation Rejection Form.
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function rejectForm($id)
    {
        $donation = Donation::findOrFail($id);

        return view('Staff.donations.reject', ['donation' => $donation]);
    }

    /**
     * Reject A Donation.
     *
     * @param \Illuminate\Http\Request $request
     * @param $id
     *
     * @return Illuminate\Http\RedirectResponse
     */
    public function reject(Request $request, $id)
    {
        $donation = Donation::findOrFail($id);
        $staff = auth()->user();
        $recipient = User::where('id', '=', $donation->user_id)->first();
        if (! $recipient) {
            return redirect()->route('staff_donation_index')
                ->withErrors('Donating User Could Not Be Found!');
        }

        $pm = new PrivateMessage();
        $pm->sender_id = $staff->id;
        $pm->receiver_id = $recipient->id;
        $pm->subject = "Your donation from, {$donation->created_at} ,has been rejected by {$staff->username}";
        $pm->message = "Your donation from, {$donation->created_at} ,has been rejected by {$staff->username}. 
        The donations transaction ID could not be verified. If you feel this is in error dont worry. Mistakes happen. Just PM me back.";
        $pm->save();

        $donation->delete();

        // Activity Log
        \LogActivity::addToLog("Staff Member {$staff->username} has rejected a {$donation->cost} donation package from {$recipient->username}.");

        return redirect()->route('staff_donation_index')
            ->withSuccess('Donation Rejected!');
    }

    /**
     * Donation Reverse Form.
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function reverseForm($id)
    {
        $donation = Donation::findOrFail($id);
        return view('Staff.donations.reverse', ['donation' => $donation]);
    }

    /**
     * Reverse A Donation.
     *
     * @param \Illuminate\Http\Request $request
     * @param $id
     *
     * @return Illuminate\Http\RedirectResponse
     */
    public function reverse(Request $request, $id)
    {
        $now = Carbon::now();
        $donation = Donation::findOrFail($id);
        $staff = auth()->user();

        $recipient = User::where('id', '=', $donation->user_id)->first();
        if (! $recipient) {
            return redirect()->route('staff_donation_index')
                ->withErrors('Donating User Could Not Be Found!');
        }
        else {
            $donation->delete();
            
            $new_vip_expire = null;

            $checks = Donation::whereRaw('user_id = ? AND status != ?',[$donation->user_id,0])->get();
            foreach($checks as $check) {
                if($check->vip_expires > $now->copy()->toDateTimeString() && $check->vip_expires > $new_vip_expire) {
                    $new_vip_expire = $check->vip_expires;
                }
            }
          
            if($donation->bonus_value > 0) {
                $transaction = BonTransactions::where('donation_id', '=', $donation->id)->first();
                if ($transaction) {
                    $recipient->seedbonus = $recipient->seedbonus-$donation->bonus_value;
                    $transaction->delete();
                }
            }
            $recipient->invites = $recipient->invites-$donation->invite_value;
            $recipient->uploaded = $recipient->uploaded-$donation->upload_value;
            $recipient->group_id = 3;
            $recipient->save();
        }

        // Activity Log
        \LogActivity::addToLog("Staff Member {$staff->username} has reversed a {$donation->cost} donation package for {$recipient->username}.");

        return redirect()->route('staff_donation_index')
            ->withSuccess('Donations Reversed!');
    }
}
