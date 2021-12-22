<?php

namespace App\Contracts;

Interface PremiumContract
{
    public function store(array $array);
    public function show($id);
    public function update(array $array,$id);
    public function destroy($id);
}

?>