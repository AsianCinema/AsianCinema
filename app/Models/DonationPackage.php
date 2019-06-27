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
 * @author     Mr.G
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DonationPackage extends Model
{
    use SoftDeletes;

    /**
     * The Database Table Used By The Model.
     *
     * @var string
     */
    protected $table = 'donation_packages';

    /**
     * Indicates If The Model Should Be Timestamped.
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * The Attributes That Should Be Mutated To Dates.
     *
     * @var array
     */
    protected $dates = ['created_at','updated_at','deleted_at'];

    /**
     * The Attributes That Should Be Casted To Native Types
     *
     * @var array
     */
	protected $casts = [
    	'position' => 'integer',
	    'upload_value' => 'integer',
	    'freeleech_value' => 'integer',
	    'vip_value' => 'integer',
	    'invite_value' => 'integer',
	    'bonus_value' => 'integer',
	    'cost' => 'decimal:2'
	];

	public function setFreeleechValueAttribute($value)
    {
		if($value) {
			$this->attributes['freeleech_value'] = $value;
		} else {
			$this->attributes['freeleech_value'] = 0;
		}
	}


	public function setInviteValueAttribute($value)
    {
	    if($value) {
	        $this->attributes['invite_value'] = $value;
	    } else {
	        $this->attributes['invite_value'] = 0;
	    }
	}

	public function setVipValueAttribute($value)
    {
	    if($value) {
	        $this->attributes['vip_value'] = $value;
	    } else {
	        $this->attributes['vip_value'] = 0;
	    }
	}

	public function setBonusValueAttribute($value)
    {
	    if($value) {
	        $this->attributes['bonus_value'] = $value;
	    } else {
	        $this->attributes['bonus_value'] = 0;
	    }
	}

	public function setUploadValueAttribute($value)
    {
	    if($value) {
	        $this->attributes['upload_value'] = $value;
	    } else {
	        $this->attributes['upload_value'] = 0;
	    }
	}

	public function setPositionAttribute($value)
    {
		if($value) {
			$this->attributes['position']=$value;
		}
		else {
			$this->attributes['position']=0;
		}
	}
}
