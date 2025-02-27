<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemDetail;
use App\Models\Type;
use App\Models\SubDescription;
use App\Http\Requests\ItemRequest;
use App\Http\Requests\ItemDetailRequest;
use App\Services\ItemDetailService;
use App\Services\ItemService;
use App\DataTables\CmsDataTable;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SubDescriptionRequest;
use App\Services\SubDescriptionService;

class ItemController extends Controller
{
    protected $itemService;
    protected $itemDetailService;
    protected $subDescriptionService;

    public function __construct(ItemService $itemService, ItemDetailService $itemDetailService, SubDescriptionService $subDescriptionService)
    {
        $this->itemService = $itemService;
        $this->itemDetailService = $itemDetailService;
        $this->subDescriptionService = $subDescriptionService;
    }

    public function index(CmsDataTable $dataTable)
    {
        $title = 'Item';
        $resource = 'item';
        $data = Item::getAllItems();
        $subData = Type::getAllTypes();

        return $dataTable->render('cms.index', compact(
            'dataTable',
            'title',
            'resource',
            'data',
            'subData',
        ));
    }
    
    public function store(ItemRequest $request)
    {
        $data = $request->validated();
        $data['picture'] = $request->file('picture');
        $this->itemService->store($data);

        return redirect()
            ->route(Auth::user()->role . '.item.index')
            ->with('success', 'You have successfully added an item!');
    }
    
    public function show(Item $item)
    {
        $title = 'Item';
        $resource = 'item';
        $details = ItemDetail::getItemDetails($item->id);
        
        return view('cms.details', compact(
            'item', 
            'title',
            'resource',
            'details',
        ));
    }
    
    public function edit(Item $item)
    {
        $title = 'Item';
        $resource = 'item';
        $subData = Type::getAllTypes();

        return view('cms.edit', compact(
            'item', 
            'title',
            'resource',
            'subData',
        ));
    }
    
    public function update(ItemRequest $request, Item $item)
    {
        $this->itemService->update($request->validated(), $item);

        return redirect()
            ->route(Auth::user()->role . '.item.edit', $item)
            ->with('success', 'You have successfully updated an item!');
    }
    
    public function destroy(Item $item)
    {
        $this->itemService->destroy($item);

        return redirect()
            ->route(Auth::user()->role . '.item.index')
            ->with('success', 'You have successfully deleted an item!');
    }
    
    public function showQr(Item $item)
    {
        return view('qr.index', compact(
            'item',
        ));
    }
    
    // Item detail

    public function detailStore(ItemDetailRequest $request, Item $item)
    {
        $data = $request->validated();
        $data['picture'] = $request->file('picture');
        $this->itemDetailService->store($data, $item);

        return redirect()
            ->route(Auth::user()->role . '.item.show', $item)
            ->with('success', 'You have successfully added a detail!');
    }

    public function detailEdit(Item $item, ItemDetail $itemDetail)
    {
        $subDescriptions = SubDescription::getSubDescription($itemDetail->id);

        return view('itemDetail.edit', compact(
            'itemDetail',
            'item',
            'subDescriptions',
        ));
    }

    public function detailUpdate(ItemDetailRequest $request, Item $item, ItemDetail $itemDetail)
    {
        $this->itemDetailService->update($request->validated(), $itemDetail);

        return redirect()
            ->route(Auth::user()->role . '.itemDetail.edit', ['item' => $item->id, 'itemDetail' => $itemDetail->id])
            ->with('success', 'You have successfully added a detail!');
    }

    public function detailDestroy( Item $item, ItemDetail $itemDetail)
    {
        $this->itemDetailService->destroy($itemDetail);

        return redirect()
            ->route(Auth::user()->role . '.item.show', $item)
            ->with('success', 'You have successfully deleted a detail!');
    }
    
    // Sub description

    public function subDescriptionStore(SubDescriptionRequest $request, ItemDetail $itemDetail, Item $item)
    {
        $this->subDescriptionService->store($request->validated(), $itemDetail, $item);

        return redirect()
            ->route(Auth::user()->role . '.item.show', $item->id)
            ->with('success', 'You have successfully added an item detail!');
    }
    
    public function subDescriptionUpdate(SubDescriptionRequest $request, SubDescription $subDescription, ItemDetail $itemDetail, Item $item)
    {
        $this->subDescriptionService->update($request->validated(), $subDescription);

        return redirect()
            ->route(Auth::user()->role . '.itemDetail.edit', ['item' => $item->id, 'itemDetail' => $itemDetail->id])
            ->with('success', 'You have successfully updated an item detail!');
    }
    
    public function subDescriptionDestroy(subDescription $subDescription, ItemDetail $itemDetail, Item $item)
    {
        $this->subDescriptionService->destroy($subDescription);

        return redirect()
            ->route(Auth::user()->role . '.itemDetail.edit', ['item' => $item->id, 'itemDetail' => $itemDetail->id])
            ->with('success', 'You have successfully deleted an item detail!');
    }
}
