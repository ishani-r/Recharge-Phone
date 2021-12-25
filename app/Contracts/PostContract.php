<?php

namespace App\Contracts;

Interface PostContract
{
   public function createPost(array $array);
   public function sendRequest(array $array);
}

?>