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

use Illuminate\Http\Request;
use App\Models\DonationGateway;
use App\Http\Controllers\Controller;

class GatewaysController extends Controller
{
    /**
     * Get All Donation Gateways.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $gateways = DonationGateway::orderBy('position')->paginate(25);

        return view('Staff.gateways.index', ['gateways' => $gateways]);
    }

    /**
     * Donation Gateway Add Form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function addForm()
    {
        return view('Staff.gateways.add');
    }

    /**
     * Add A Donation Package.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return Illuminate\Http\RedirectResponse
     */
    public function add(Request $request)
    {
        $gateway = new DonationGateway();
        $gateway->position = $request->input('position');
        $gateway->name = $request->input('name');
        $gateway->address = $request->input('address');
        $gateway->status = $request->input('status');

        $v = validator($gateway->toArray(), [
            'address' => 'required|unique:donation_gateways',
            'name' => 'required',
            'status' => 'required',
            'position' => 'min:0|max:9999999',
        ]);

        if ($v->fails()) {
            return redirect()->route('staff_gateway_index')
                ->withErrors($v->errors());
        } else {
            $gateway->save();

            return redirect()->route('staff_gateway_index')
                ->withSuccess('Donation Gateway Added Successfully!');
        }
    }

    /**
     * Donation Package Edit Form.
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editForm($id)
    {
        $package = DonationPackage::findOrFail($id);

        return view('Staff.packages.edit', ['package' => $package, 'id' => $id]);
    }

    /**
     * Edit A Donation Package.
     *
     * @param \Illuminate\Http\Request $request
     * @param $id
     *
     * @return Illuminate\Http\RedirectResponse
     */
    public function edit(Request $request, $id)
    {
        $package = DonationPackage::findOrFail($id);
        $package->description = $request->input('description');
        $package->cost = $request->input('cost');
        $package->upload_value = $request->input('upload_value');
        $package->invite_value = $request->input('invite_value');
        $package->vip_value = $request->input('vip_value');
        $package->freeleech_value = $request->input('freeleech_value');
        $package->bonus_value = $request->input('bonus_value');
        $package->position = $request->input('position');

        $v = validator($package->toArray(), [
            'description' => 'required',
            'cost' => 'required|numeric',
            'bonus_value' => 'min:0|max:999999999',
            'upload_value' => 'min:0|max:9999',
            'invite_value' => 'min:0|max:9999',
            'vip_value' => 'min:0|max:9999',
            'freeleech_value' => 'min:0|max:9999',
            'position' => 'min:0|max:9999999',
        ]);

        if ($v->fails()) {
            return redirect()->route('staff_package_index')
                ->withErrors($v->errors());
        } else {
            $package->save();

            return redirect()->route('staff_package_index')
                ->withSuccess('Donation Package Edited Successfully!');
        }
    }

    /**
     * Donation Package Delete Form.
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function deleteForm($id)
    {
        $package = DonationPackage::findOrFail($id);

        return view('Staff.gateways.delete', ['package' => $package]);
    }

    /**
     * Delete A Donation Package.
     *
     * @param \Illuminate\Http\Request $request
     * @param $id
     *
     * @return Illuminate\Http\RedirectResponse
     */

    public function delete(Request $request, $id)
    {
        $package = DonationPackage::findOrFail($id);
        $package->delete();

        return redirect()->route('staff_package_index')
            ->withSuccess('Donation Package Deleted Successfully!');
    }
}
