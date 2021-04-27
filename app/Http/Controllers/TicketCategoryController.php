<?php

namespace App\Http\Controllers;

use Response;
use Validator;
use App\TicketCategory;
use Illuminate\Http\Request;
use App\DataTables\TicketCategoriesDataTable;

class TicketCategoryController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(TicketCategory::class, 'category');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $categories = TicketCategory::with('tickets')->paginate(10);
    //     return view('tickets.categories.index', compact('categories'));
    // }

    public function index(TicketCategoriesDataTable $dataTable)
    {
        return $dataTable->render('tickets.categories.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:ticket_categories|min:2',
        ]);

        if ($validator->passes()) {
            $category = TicketCategory::create([
                'name' => $request['name'],
            ]);

            return Response::json(['success' => '1']);
        }

        return Response::json(['errors' => $validator->errors()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TicketCategory  $ticketCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TicketCategory $category)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:2|unique:ticket_categories,name,'.$category->id,
        ]);

        if ($validator->passes()) {
            $category->update([
                'name' => $request['name'],
            ]);

            return Response::json(['success' => '1']);
        }

        return Response::json(['errors' => $validator->errors()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TicketCategory  $ticketCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(TicketCategory $category)
    {
        $category->delete();
        return redirect(route('categories.index'))->with(['status' => 'Successfully deleted!']);
    }
}
