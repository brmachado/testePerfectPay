<?php

namespace App\Http\Controllers;

 use App\Services\TicketPaymentService;
 use App\Services\CardPaymentService;
 use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('payment', ['mpKey' =>  env('MP_KEY')]);
    }

    public function ticketPayment(
        Request $request,
        TicketPaymentService $ticketPaymentService
    ) {
        try {
            $returnService = $ticketPaymentService->service($request->all());

            if(!$returnService['status'])
                throw new \Exception('Erro ao efetuar pagamento');

            return view('paymentTicketReturn', ['ticketUrl' => $returnService['url']]);
        } catch (\Exception $exception) {
            return view('paymentError', ['exception' => $exception]);
        }
    }

    public function cardPayment(
        Request $request,
        CardPaymentService $cardPaymentService
    ) {
        try {
            $returnService = $cardPaymentService->service($request->all());

            if(!$returnService['status'])
                throw new \Exception('Erro ao efetuar pagamento');

            return response()->json($returnService);
        } catch (\Exception $exception) {
            return response()->json([
                'success' => false,
                'error' => $exception->getMessage()
            ]);
        }
    }
}
