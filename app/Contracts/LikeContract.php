<?php
namespace App\Contracts;

Interface LikeContract
{
    public function like(array $array);
    public function showNotification(array $array);
}
?>