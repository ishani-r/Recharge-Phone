<?php

namespace App\Repositories;

use App\Contracts\SettingContract;
use App\Models\Setting;

class SettingRepository implements SettingContract
{
    public function store(array $array)
    {
        $set = new Setting;
        $set->terms_and_conditions = $array['terms_and_conditions'];
        $set->privacy_policy = $array['privacy_policy'];
        $set->status = 'Active';
        $set->save();
        return $set;
    }

    public function show($id)
    {
        $set = Setting::find($id);
        return $set;
    }

    public function update(array $array, $id)
    {
        $set = Setting::find($id);
        $set->terms_and_conditions = $array['terms_and_conditions'];
        $set->privacy_policy = $array['privacy_policy'];
        $set->save();
        return $set;
    }

    public function destroy($id)
    {
        $set = Setting::find($id);
        $set->delete();
        return $set;
    }
}

?>