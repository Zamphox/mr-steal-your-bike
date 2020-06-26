<?php


namespace App\Http\Services\CrimeCases;

use App\CrimeCase;
use App\Officer;
use App\Http\Services\CrimeCaseManagementService as CrimeCaseManagementInterface;
use Illuminate\Pagination\Paginator;

class CrimeCaseManagementService implements CrimeCaseManagementInterface
{
    /**
     * @param $data
     * @throws \Exception
     * @return Officer
     */
    public function createNewCrimeCase(array $data)
    {
        $officer = $this->getFirstAvailableOfficer();

        $case = new CrimeCase();
        $case->reported_by = $data['full_name'];
        $case->contact = $data['contact_info'];
        $case->body = $data['case_report'];
        $case->officer_id = $officer->id;
        $case->save();

        $officer->is_available = 0;
        $officer->save();

        return $officer;
    }

    public function getOfficersList(int $page = 1, $searchQuery = ''){
        $searchQuery = '%' . $searchQuery . '%';
        Paginator::resolveCurrentPage($page);
        $officers = Officer::where('name', 'LIKE', $searchQuery)
            ->orWhere('surname', 'LIKE', $searchQuery)
            ->orderBy('name')->paginate(15);

        return $officers;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    private function getFirstAvailableOfficer(){
        $officer = Officer::where('is_available', 1)->orderBy('updated_at', 'ASC')->first();
        if(!$officer){
            throw new \Exception('No officers available');
        }
        return $officer;
    }

    public function closeCase(CrimeCase $case)
    {
        $officer = $case->officer;
        $case->delete();
        $officer->is_available = 1;
        $officer->save();
    }
}
