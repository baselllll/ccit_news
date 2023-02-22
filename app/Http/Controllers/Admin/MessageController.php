<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Messages\SendMessageRequest;
use App\Jobs\SMS\SendMessage;
use App\Repositories\CustomersRepository;
use App\Repositories\MessageRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class MessageController extends Controller
{
    public function __construct(MessageRepository $messageRepo, CustomersRepository $customersRepo)
    {
        $this->messageRepo = $messageRepo;
        $this->customersRepo = $customersRepo;
    }

    public function index()
    {
        return view('admin.pages.messages.index');
    }

    public function getAll(Request $request)
    {
        $messages = $this->messageRepo
            ->getAll($request->all())
            ->latest()
            ->get();
        return DataTables::of($messages)
            ->addIndexColumn()

            ->addColumn('customerPhone', function($row){
                return '<strong style="font-size: 16px">'.$row->phone.'</strong>';
            })

            ->addColumn('date', function($row){
                return $row->created_at->format('Y-m-d H:i');
            })

            ->rawColumns([
                'customerPhone',
                'date',
            ])
            ->make(true);
    }

    public function send()
    {
        $customers = $this->customersRepo->getAll()->get();
        return view('admin.pages.messages.send',compact('customers'));
    }

    public function sendMessage(SendMessageRequest $request, MessageRepository $messageRepo)
    {
        $data = $request->validated();
        foreach ($data['customers'] as $value)
        {
            $messageRepo->saveMessage(['phone'=> $value, 'message'=> $data['message']]);
            dispatch(new SendMessage(['phone'=> $value, 'message'=> $data['message']]));
        }

        return response([
            'message' => __('apiMessages.messages.sent'),
        ],200);
    }
}
