<?php

namespace App\Http\Controllers;

use App\Models\ItemDetail;
use App\Http\Requests\ItemDetailRequest;
use App\Services\ItemDetailService;
use Illuminate\Http\Request;

class ItemDetailController extends Controller
{
    protected $itemDetailService;

    public function __construct(ItemDetailService $itemDetailService)
    {
        $this->itemDetailService = $itemDetailService;
    }
    
    public function create()
    {
        //
    }
    
    public function store(ItemDetailRequest $request)
    {
        $this->itemDetailService->store($request->validated());
    }
    
    public function show(ItemDetail $itemDetail)
    {
        $details = ItemDetail::getAllDetails($itemDetail);

        return redirect()
            ->route('itemDetail.index')
            ->with('Success', '');
    }
    
    public function edit(ItemDetail $itemDetail)
    {
        //
    }
    
    public function update(ItemDetailRequest $request, ItemDetail $itemDetail)
    {
        //
    }
    
    public function destroy(ItemDetail $itemDetail)
    {
        //
    }
}
