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

return [

    /*
    |--------------------------------------------------------------------------
    | Codebase Name
    |--------------------------------------------------------------------------
    |
    | Name of Codebase
    |
    */

    'codebase' => 'UNIT3D Nex-Gen Torrent Tracker v1.9.4',

    /*
    |--------------------------------------------------------------------------
    | Site title
    |--------------------------------------------------------------------------
    |
    | Title of Site
    |
    */

    'title' => 'AsianCinema',

    /*
    |--------------------------------------------------------------------------
    | Site SubTitle
    |--------------------------------------------------------------------------
    |
    | SubTitle
    |
    */

    'subTitle' => 'Where Quality Matters',

    /*
    |--------------------------------------------------------------------------
    | Site email
    |--------------------------------------------------------------------------
    |
    | Email address to send emails
    |
    */

    'email' => env('DEFAULT_OWNER_EMAIL', 'unit3d@none.com'),

    /*
    |--------------------------------------------------------------------------
    | Meta description
    |--------------------------------------------------------------------------
    |
    | Default meta description content
    |
    */

    'meta_description' => 'Where Quality Matters',

    /*
    |--------------------------------------------------------------------------
    | Site Birthdate
    |--------------------------------------------------------------------------
    |
    | Date Site Was Born
    |
    */
    'birthdate' => 'December 5th 2018',

    /*
    |--------------------------------------------------------------------------
    | Freelech State
    |--------------------------------------------------------------------------
    |
    | Global Freeleech
    |
    */
    'freeleech' => '0',

    'freeleech_until' => '01/12/2020 11:59 PM EST',

    /*
    |--------------------------------------------------------------------------
    | Double Upload State
    |--------------------------------------------------------------------------
    |
    | Global Double Upload
    |
    */
    'doubleup' => '1',

    /*
    |--------------------------------------------------------------------------
    | Min Ratio
    |--------------------------------------------------------------------------
    |
    | Minimum Ratio To Download
    |
    */

    'ratio' => 0.4,

    /*
    |--------------------------------------------------------------------------
    | Private tracker
    |--------------------------------------------------------------------------
    |
    | Registered member only can access to the site
    |
    */
    'private' => true,

    /*
    |--------------------------------------------------------------------------
    | Invite only
    |--------------------------------------------------------------------------
    |
    | Invite System On/Off (Open Reg / Closed)
    | Expire time in days
    |
    | Restricted mode for invites. If set to true, invites will be restricted
    | Exempt these groups from the invite restrictions
    */
    'invite-only'   => '1',
    'invite_expire' => '2',

    'invites_restriced' => false,
    'invite_groups'     => [
        'Administrator',
        'Owner',
    ],

    /*
    |--------------------------------------------------------------------------
    | Max Seedbox Records (USER)
    |--------------------------------------------------------------------------
    |
    | Users max seedboxs allowed
    |
    */
    'max_cli' => '3',

    /*
    |--------------------------------------------------------------------------
    | Default Users Stats
    |--------------------------------------------------------------------------
    |
    | This will be the upload and download given to new members. (In Bytes!)
    | Default: 50GB Upload and 1GB Download
    */
    'default_upload'   => '53687091200',
    'default_download' => '1073741824',

    /*
    |--------------------------------------------------------------------------
    | Default Site Style
    |--------------------------------------------------------------------------
    | 0 = Light Theme
    | 1 = Galactic Theme
    | 2 = Dark Blue Theme
    | 3 = Dark Green Theme
    | 4 = Dark Pink Theme
    | 5 = Dark Purple Theme
    | 6 = Dark Red Theme
    | 7 = Dark Teal Theme
    | 8 = Dark Yellow Theme
    */
    'default_style' => 0,

    /*
    |--------------------------------------------------------------------------
    | Default Font Awesome Style
    |--------------------------------------------------------------------------
    | fas = Solid
    | far = Regular
    | fal = Light
    */
    'font-awesome' => 'fas',

    /*
    |--------------------------------------------------------------------------
    | Application Signups
    |--------------------------------------------------------------------------
    | True/1 = Enabled
    | False/0 = Disabled
    */
    'application_signups' => '0',

    /*
    |--------------------------------------------------------------------------
    | Rules Page URL
    |--------------------------------------------------------------------------
    | Example: rules.1
    */
    'rules_url' => 'https://'.parse_url(env('APP_URL'), PHP_URL_HOST).'/page/rules.1',

    /*
    |--------------------------------------------------------------------------
    | FAQ Page URL
    |--------------------------------------------------------------------------
    | Example: faq.2
    */
    'faq_url' => 'https://'.parse_url(env('APP_URL'), PHP_URL_HOST).'/page/faq.2',
];
