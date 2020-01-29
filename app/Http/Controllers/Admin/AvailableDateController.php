<?php

namespace App\Http\Controllers\Admin;

use App\AvailableDate;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAvailableDateRequest;
use App\Http\Requests\StoreAvailableDateRequest;
use App\Http\Requests\UpdateAvailableDateRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class AvailableDateController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('available_date_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $availableDates = AvailableDate::all();

        return view('admin.availableDates.index', compact('availableDates'));
    }

    public function create()
    {
        abort_if(Gate::denies('available_date_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.availableDates.create');
    }

    public function store(StoreAvailableDateRequest $request)
    {
        $availableDate = AvailableDate::create([
            'available_date' => $request->available_date,
            'available_date_id' => Str::random(5),
        ]);

        return redirect()->route('admin.available-dates.index');
    }

    public function edit(AvailableDate $availableDate)
    {
        abort_if(Gate::denies('available_date_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.availableDates.edit', compact('availableDate'));
    }

    public function update(UpdateAvailableDateRequest $request, AvailableDate $availableDate)
    {
        $availableDate->update($request->all());

        return redirect()->route('admin.available-dates.index');
    }

    public function show(AvailableDate $availableDate)
    {
        abort_if(Gate::denies('available_date_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $availableDate->load('dateBookDates');

        return view('admin.availableDates.show', compact('availableDate'));
    }

    public function destroy(AvailableDate $availableDate)
    {
        abort_if(Gate::denies('available_date_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $availableDate->delete();

        return back();
    }

    public function massDestroy(MassDestroyAvailableDateRequest $request)
    {
        AvailableDate::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function status($id)
    {
        $availableDate = AvailableDate::where('id',$id)->first();
        if($availableDate->available_date_status == 'active')
        {   
            $availableDate->update([
                'available_date_status' => 'disabled',
            ]);
        }
        else
        {
            $availableDate->update([
                'available_date_status' => 'active',
            ]);
        }
        
        return redirect()->route('admin.available-dates.index');
    }
}
