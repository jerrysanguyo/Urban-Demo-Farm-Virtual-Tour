<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemDetail;
use App\Models\Type;
use App\Http\Requests\ItemRequest;
use App\Http\Requests\ItemDetailRequest;
use App\Services\ItemDetailService;
use App\Services\ItemService;
use App\DataTables\CmsDataTable;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    protected $itemService;
    protected $itemDetailService;

    public function __construct(ItemService $itemService, ItemDetailService $itemDetailService)
    {
        $this->itemService = $itemService;
        $this->itemDetailService = $itemDetailService;
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
            'details'
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
            'subData'
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
    
    // Item detail

    public function detailStore(ItemDetailRequest $request, Item $item)
    {
        $this->itemDetailService->store($request->validated(), $item);

        return redirect()
            ->route(Auth::user()->role . '.item.show', $item)
            ->with('success', 'You have successfully added a detail!');
    }

    public function detailEdit(Item $item, ItemDetail $itemDetail)
    {
        return view('itemDetail.edit', compact(
            'itemDetail',
            'item',
        ));
    }

    public function detailUpdate(ItemDetailRequest $request, Item $item, ItemDetail $itemDetail)
    {
        $this->itemDetailService->update($request->validated(), $itemDetail);

        return redirect()
            ->route(Auth::user()->role . '.item.show', $item)
            ->with('success', 'You have successfully added a detail!');
    }

    public function detailDestroy( Item $item, ItemDetail $itemDetail)
    {
        $this->itemDetailService->destroy($itemDetail);

        return redirect()
            ->route(Auth::user()->role . '.item.show', $item)
            ->with('success', 'You have successfully deleted a detail!');
    }
}
