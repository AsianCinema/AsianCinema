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

class DonationGateway extends Model
{
    use SoftDeletes;

    /**
     * The Database Table Used By The Model.
     *
     * @var string
     */
    protected $table = 'donation_gateways';

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


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
