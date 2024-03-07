<?php
/**
 * Created by PhpStorm.
 * User: tete
 * Date: 4/24/19
 * Time: 3:25 PM
 */

namespace App\Http\Traits;


use App\Models\Setting;
use Illuminate\Http\Request;

trait SettingOperation
{
    public function RegisterSetting(Request $request){
        $data = $request->all();
        foreach ($data as $key => $value) {
            if ($key == '_token' || !$value) continue;
            {
//                if (!is_string($value[0]) and $value[0]->isFile())  {
//                    $value[0]=new_uploader($value[0],'header');
//                }
                Setting::where(['name' => $key])->update(['ar_value' => $value[0], 'en_value' => (isset($value[1])) ? $value[1]
                    : $value[0]]);
            }

        }
    }

}