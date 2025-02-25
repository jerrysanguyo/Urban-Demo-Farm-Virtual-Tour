<?php

namespace App\Http\Controllers;

use App\Models\Type;
use App\DataTables\CmsDataTable;
use App\Services\TypeService;
use App\Http\Requests\TypeRequest;
use Illuminate\Support\Facades\Auth;

class TypeController extends Controller
{
    protected $typeService;

    public function __construct(TypeService $typeService)
    {
        $this->typeService = $typeService;
    }

    public function index(CmsDataTable $dataTable)
    {
        $title = 'Type';
        $resource = 'type';
        $data = Type::getAllTypes();

        return $dataTable->render('cms.index', compact(
            'dataTable',
            'title',
            'resource',
            'data'
        ));
    }
    
    public function store(TypeRequest $request)
    {
        $data = $request->validated();
        $this->typeService->store($data);

        return redirect()
            ->route(Auth::user()->role . '.type.index')
            ->with('success', 'You have added a type successfully!');
    }
    
    public function edit(Type $type)
    {
        $title = 'Type';
        $resource = 'type';
        return view('cms.edit', compact(
            'type', 
            'title',
            'resource',
        ));
    }
    
    public function update(TypeRequest $request, Type $type)
    {
        $this->typeService->update($request->validated(), $type);

        return redirect()
            ->route(Auth::user()->role . '.type.edit',$type)
            ->with('success', 'You have updated this type successfully!');
    }
    
    public function destroy(Type $type)
    {
        $this->typeService->destroy($type);

        return redirect()
            ->route(Auth::user()->role . '.type.index')  
            ->with('success', 'You have deleted a type successfully!');
    }
}
