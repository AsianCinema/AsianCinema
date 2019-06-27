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
use App\Models\DonationPackage;
use App\Http\Controllers\Controller;

class PackagesController extends Controller
{
    /**
     * Get All Donation Package Types.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $packages = DonationPackage::orderBy('position')->paginate(25);

        return view('Staff.packages.index', ['packages' => $packages]);
    }

    /**
     * Donation Package Add Form.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function addForm()
    {
        return view('Staff.packages.add');
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
        $package = new DonationPackage();
        $package->description = $request->input('description');
        $package->cost = $request->input('cost');
        $package->upload_value = $request->input('upload_value');
        $package->invite_value = $request->input('invite_value');
        $package->vip_value = $request->input('vip_value');
        $package->freeleech_value = $request->input('vip_value');
	    $package->bonus_value = $request->input('bonus_value');
        $package->position = $request->input('position');
		
        $v = validator($package->toArray(), [
        'description' => 'required|unique:donation_packages',
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
                ->withSuccess('Donation Package Added Successfully!');
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
        $package->freeleech_value = $request->input('vip_value');
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

        return view('Staff.packages.delete', ['package' => $package]);
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
