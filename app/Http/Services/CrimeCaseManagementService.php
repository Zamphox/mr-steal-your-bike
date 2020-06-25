<?php


namespace App\Http\Services;


interface CrimeCaseManagementService
{
    /**
     * @param array $data
     * @return mixed
     */
    public function createNewCrimeCase(array $data);
}
