<?php
/**
 * Created by PhpStorm.
 * User: volki
 * Date: 20.04.2019
 * Time: 18:22
 */
namespace App\Interfaces;

use App\Entity\Provider;

interface ProviderInterface
{
    function addProvider(Provider $provider):array;

}