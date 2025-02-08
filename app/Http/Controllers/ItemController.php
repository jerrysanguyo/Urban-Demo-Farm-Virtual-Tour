<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Http\Requests\ItemRequest;
use App\Services\ItemService;
use App\DataTables\CmsDataTable;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    protected $itemService;

    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }

    public function index(CmsDataTable $dataTable)
    {
        $title = 'Item';
        $resource = 'item';
        $data = Item::getAllItems();

        return $dataTable->render('cms.index', compact(
            'dataTable',
            'title',
            'resource',
            'data',
        ));
    }
    
    public function store(ItemRequest $request)
    {
        $this->itemService->store($request->validated());

        return redirect()
            ->route(Auth::user()->role . '.item.index')
            ->with('success', 'You have successfully added an item!');
    }
    
    public function show(Item $item)
    {
        //
    }
    
    public function edit(Item $item)
    {
        $title = 'Item';
        $resource = 'item';

        return view('cms.edit', compact(
            'item', 
            'title',
            'resource',
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
}
