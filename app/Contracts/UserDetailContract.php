<?php
namespace App\Contracts;

Interface UserDetailContract
{
    public function store(array $array);
    public function show($id);
    // public function update(array $array, $id);
    public function destroy($id);
    public function distance(array $array);
}
?>