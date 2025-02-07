<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;
use App\DataTables\CmsDataTable;
use App\Services\TypeService;
use App\Http\Requests\TypeRequest;

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
        $listOfType = Type::getAllTypes();

        return $dataTable->render('cms.index', compact(
            'dataTable',
            'title',
            'resource',
            'listOfType'
        ));
    }
    
    public function store(TypeRequest $request)
    {
        $this->typeService->store($request->validated());

        return redirect()->route('cms.index')
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

        return redirect()->route('type.edit',$type)
            ->with('sucess', 'You have updated this type successfully!');
    }
    
    public function destroy(Type $type)
    {
        $this->typeService->destroy($type);

        return redirect()->route('type.index')  
            ->with('success', 'You have deleted a type successfully!');
    }
}
