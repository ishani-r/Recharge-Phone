<?php

namespace App\Repositories;
use App\Contracts\PremiumContract;
use App\Models\Premium;

class PremiumRepository implements PremiumContract
{
    public function store(array $array)
    {
        $pre = new Premium;
        $pre->name = $array['name'];
        $pre->six_months = $array['six_months'];
        $pre->three_months = $array['three_months'];
        $pre->one_months = $array['one_months'];
        $pre->try_days = $array['try_days'];
        $pre->save = $array['save'];
        $pre->status = 'Active';
        $pre->slug = $array['name'];
        $pre->save();
        return redirect()->route('admin.premium.index', compact('pre'));
    }

    public function show($id)
    {
        $pre = Premium::find($id);
        return $pre;
    }

    public function update(array $array,$id)
    {
        $pre = Premium::find($id);
        $pre->name = $array['name'];
        $pre->six_months = $array['six_months'];
        $pre->three_months = $array['three_months'];
        $pre->one_months = $array['one_months'];
        $pre->try_days = $array['try_days'];
        $pre->save = $array['save'];
        $pre->status = 'Active';
        $pre->slug = $array['name'];
        $pre->save();
        return redirect()->route('admin.premium.index',compact('pre'));
    }

    public function destroy($id)
    {
        $pre = Premium::find($id);
        $pre->delete();
        return $pre;
    }
}

?>