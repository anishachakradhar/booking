<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyConductorRequest;
use App\Http\Requests\StoreConductorRequest;
use App\Http\Requests\UpdateConductorRequest;
use App\Conductor;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class ConductorController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('conductor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $conductors = Conductor::all();

        return view('admin.conductors.index', compact('conductors'));
    }

    public function create()
    {
        abort_if(Gate::denies('conductor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.conductors.create');
    }

    public function store(StoreConductorRequest $request)
    {
        $conductor = Conductor::create([
            'conductor' => $request->conductor,
            'conductor_id' => Str::random(5),
        ]);

        return redirect()->route('admin.conductors.index');
    }

    public function edit(Conductor $conductor)
    {
        abort_if(Gate::denies('conductor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.conductors.edit', compact('conductor'));
    }

    public function update(UpdateConductorRequest $request, Conductor $conductor)
    {
        $conductor->update($request->all());

        return redirect()->route('admin.conductors.index');
    }

    public function show(Conductor $conductor)
    {
        abort_if(Gate::denies('conductor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $conductor->load('conductorStudents');

        return view('admin.conductors.show', compact('conductor'));
    }

    public function destroy(Conductor $conductor)
    {
        abort_if(Gate::denies('conductor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $conductor->delete();

        return back();
    }

    public function massDestroy(MassDestroyConductorRequest $request)
    {
        Conductor::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
