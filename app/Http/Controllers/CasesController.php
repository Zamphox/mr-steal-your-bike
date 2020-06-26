<?php

namespace App\Http\Controllers;

use App\CrimeCase;
use App\Http\Services\CrimeCaseManagementService;
use App\Officer;
use Illuminate\Http\Request;

class CasesController extends Controller
{
    //
    /**
     * @var CrimeCaseManagementService
     */
    private $caseService;

    /**
     * CasesController constructor.
     * @param CrimeCaseManagementService $crimeCaseManagementService
     */
    function __construct(CrimeCaseManagementService $crimeCaseManagementService)
    {
        $this->caseService = $crimeCaseManagementService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request){
        $data = $request->validate([
            'full_name' => ['required', 'max:255'],
            'contact_info' => ['required', 'max:255'],
            'case_report' => ['required']
        ]);

        return response()->json($this->caseService->createNewCrimeCase($data));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOfficersList(Request $request){
        return response()->json(
            $this->caseService
                ->getOfficersList($request->get('page', 1), $request->get('s')));
    }

    public function getOfficerCase(Officer $officer){
        return response()->json($officer->load('case'));
    }

    public function closeCase(CrimeCase $case){
        return$this->caseService->closeCase($case);
    }
}
