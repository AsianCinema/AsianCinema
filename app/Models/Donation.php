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

class Donation extends Model
{
    use SoftDeletes;

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
	    'upload_value' => 'integer',
	    'freeleech_value' => 'integer',
	    'vip_value' => 'integer',
	    'bonus_value' => 'integer',
	    'invite_value' => 'integer',
	    'cost' => 'decimal:2'
	];
	
	public function user()
    {
        return $this->belongsTo(User::class);
    }
	
	public function setTransactionAttribute($value)
    {
		if($value == "") {
			$this->attributes['transaction'] = "N/A";
		}
		else {
			$this->attributes['transaction'] = $value;
		}
    }
}
