<?php

namespace App\Http\Controllers;

use App\Http\Services\CrimeCaseManagementService;
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
}
