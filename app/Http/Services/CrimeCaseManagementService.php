<?php


namespace App\Http\Services;


use App\CrimeCase;

interface CrimeCaseManagementService
{
    /**
     * @param array $data
     * @return mixed
     */
    public function createNewCrimeCase(array $data);

    /**
     * @param int $page
     * @param $searchQuery
     * @return mixed
     */
    public function getOfficersList(int $page = 1, $searchQuery);

    public function closeCase(CrimeCase $case);
}
