<?php
/**
 * NOTICE OF LICENSE
 *
 * UNIT3D is open-sourced software licensed under the GNU General Public License v3.0
 * The details is bundled with this project in the file LICENSE.txt.
 *
 * @project    UNIT3D
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html/ GNU Affero General Public License v3.0
 * @author     Mr.G
 */

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Carbon\Carbon;

class AutoRemoveUserVip extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auto:remove_user_vip';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically Change A Users VIP Class If Requirements Met';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $current = Carbon::now();
        $users = User::whereRaw('vip_expires_at > ?', 0)->get();
        foreach ($users as $user) {
            if ($user->vip_expires_at < $current->copy()->toDateTimeString()) {
				$user->vip_expires_at = null;
				$user->group_id = 3;
				$user->save();
            }
        }
    }
}
