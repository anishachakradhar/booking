<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\BookDate;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookDateRequest;
use App\Http\Requests\UpdateBookDateRequest;
use App\Http\Resources\Admin\BookDateResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookDateApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('book_date_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BookDateResource(BookDate::with(['students_email', 'date'])->get());
    }

    public function store(StoreBookDateRequest $request)
    {
        $bookDate = BookDate::create($request->all());

        return (new BookDateResource($bookDate))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(BookDate $bookDate)
    {
        abort_if(Gate::denies('book_date_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BookDateResource($bookDate->load(['students_email', 'date']));
    }

    public function update(UpdateBookDateRequest $request, BookDate $bookDate)
    {
        $bookDate->update($request->all());

        return (new BookDateResource($bookDate))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(BookDate $bookDate)
    {
        abort_if(Gate::denies('book_date_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bookDate->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
