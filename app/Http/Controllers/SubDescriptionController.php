<?php

namespace App\Http\Controllers;

use App\Models\subDescription;
use App\Models\ItemDetail;
use App\Models\Item;
use App\Http\Requests\SubDescriptionRequest;
use App\Services\SubDescriptionService;
use Illuminate\Support\Facades\Auth;

class SubDescriptionController extends Controller
{
    protected $subDescriptionService;
    
    public function __construct(SubDescriptionService $subDescriptionService)
    {
        $this->subDescriptionService = $subDescriptionService;
    }

    public function subDescriptionStore(SubDescriptionRequest $request, ItemDetail $itemDetail, Item $item)
    {
        $this->subDescriptionService->store($request->validated(), $itemDetail);

        return redirect()
            ->route(Auth::user()->role . '.item.show', $item->id)
            ->with('success', 'You have successfully added an item detail!');
    }

    public function subDescriptionEdit(SubDescription $subDescription, ItemDetail $itemDetail)
    {
        return view();
    }
    
    public function subDescriptionUpdate(SubDescriptionRequest $request, SubDescription $subDescription, ItemDetail $itemDetail)
    {
        $this->subDescriptionService->update($request->validated(), $itemDetail);

        return redirect()
            ->route(Auth::user()->role . '.itemDetail.show', $itemDetail)
            ->with('success', 'You have successfully updated an item detail!');
    }
    
    public function destroy(subDescription $subDescription, ItemDetail $itemDetail)
    {
        $this->subDescriptionService->destroy($subDescription);

        return redirect()
            ->route(Auth::user()->role . '.itemDetail.show', $itemDetail)
            ->with('success', 'You have successfully deleted an item detail!');
    }
}
