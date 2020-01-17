<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\AvailableDate;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAvailableDateRequest;
use App\Http\Requests\UpdateAvailableDateRequest;
use App\Http\Resources\Admin\AvailableDateResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AvailableDateApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('available_date_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AvailableDateResource(AvailableDate::all());
    }

    public function store(StoreAvailableDateRequest $request)
    {
        $availableDate = AvailableDate::create($request->all());

        return (new AvailableDateResource($availableDate))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(AvailableDate $availableDate)
    {
        abort_if(Gate::denies('available_date_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AvailableDateResource($availableDate);
    }

    public function update(UpdateAvailableDateRequest $request, AvailableDate $availableDate)
    {
        $availableDate->update($request->all());

        return (new AvailableDateResource($availableDate))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(AvailableDate $availableDate)
    {
        abort_if(Gate::denies('available_date_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $availableDate->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
