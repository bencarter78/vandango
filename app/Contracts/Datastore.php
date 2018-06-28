<?php
namespace App\Contracts;


interface Datastore
{
    public function query($sql);
}