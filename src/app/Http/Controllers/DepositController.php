<?php
namespace App\Http\Controllers;

use App\Commands\Deposit\GetDepositsList;
use App\Http\Request\Deposit\GetDepositRequest;
use App\Http\Resources\DepositResource;
use App\Http\Resources\DepositsViewResource;
use Illuminate\Contracts\View\View;

class DepositController extends Controller
{
    private readonly GetDepositsList $command;

    public function __construct(GetDepositsList $command)
    {
        $this->command = $command;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the deposits.
     *
     * @param GetDepositRequest $request The request instance containing the necessary parameters.
     * @return \Illuminate\View\View The view displaying the list of deposits.
     */
    public function index(GetDepositRequest $request):View
    {
      $list = $this->command->execute($request);
      $data = DepositResource::collection($list);
      $result = DepositsViewResource::make($data);

      return view('deposit.index',$result->toArray($request));
    }
}
