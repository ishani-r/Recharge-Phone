<?php

namespace App\Contracts;

Interface SettingContract 
{
    public function store(array $array);
    public function show($id);
    public function update(array $array, $id);
    public function destroy($id);
}

?>