<?php 
namespace App\Exceptions\V1;

use Exception;

class CustomException extends Exception
{
   const INVALID_USER = 1001;
   const INCOMPLTET_DERAILS = 1002,
}
?>