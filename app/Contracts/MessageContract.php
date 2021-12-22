<?php

namespace App\Contracts;

Interface MessageContract
{
    public function store(array $array);
    public function show(array $array);
}

?>