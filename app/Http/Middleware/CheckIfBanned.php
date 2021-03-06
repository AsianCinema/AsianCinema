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

namespace App\Http\Middleware;

use Closure;
use App\Models\Group;
use Illuminate\Support\Facades\DB;

class CheckIfBanned
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param string|null              $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $user = $request->user();
        $bannedGroup = Group::select(['id'])->where('slug', '=', 'banned')->first();

        if ($user && $user->group_id == $bannedGroup->id) {
            auth()->logout();
            $request->session()->flush();

            return redirect()->to('login')
                ->withErrors('This account is Banned!');
        }
        $banned_ip = DB::table('ip_ban')->where('ip','=',$request->ip())->get('ip');
        if(count($banned_ip) != 0){
	        return redirect()->to('login')
		        ->withErrors('This IP-Address is Banned!');
        }

        return $next($request);
    }
}
