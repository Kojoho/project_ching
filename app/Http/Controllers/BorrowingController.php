<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBorrowingRequest; // Import StoreBorrowingRequest for validation
use App\Http\Requests\UpdateBorrowingRequest; // Import UpdateBorrowingRequest for validation
use App\Models\Asset;
use App\Models\Borrowing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect; // Use Redirect facade for cleaner syntax

class BorrowingController extends Controller
{
    /**
     * Display a listing of the borrowings.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $borrowings = Borrowing::all();

        return view('borrowings.index', compact('borrowings'));
    }

    /**
     * Show the form for creating a new borrowing.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $assets = Asset::all();
        $users = User::all();

        return view('borrowings.create', compact('assets', 'users'));
    }

    /**
     * Store a newly created borrowing in storage.
     *
     * @param  StoreBorrowingRequest  $request  Validated request object
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBorrowingRequest $request) // Use validated request object
    {
        $assetId = $request->input('asset_id');
        $userId = $request->input('user_id');
        $borrowDate = $request->input('borrow_date');
        $dueDate = $request->input('due_date');

        $borrowing = Borrowing::create([
            'asset_id' => $assetId,
            'user_id' => $userId,
            'borrow_date' => $borrowDate,
            'due_date' => $dueDate,
        ]);

        return Redirect::route('borrowings.index')->with('success', 'Borrowing created successfully!'); // Use Redirect facade
    }

    /**
     * Display the specified borrowing.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $borrowing = Borrowing::find($id);

        if (!$borrowing) {
            return abort(404);
        }

        $asset = $borrowing->asset;
        $user = $borrowing->user;

        return view('borrowings.show', compact('borrowing', 'asset', 'user'));
    }

    /**
     * Show the form for editing the specified borrowing.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $borrowing = Borrowing::find($id);

        if (!$borrowing) {
            return abort(404);
        }

        $assets = Asset::all();
        $users = User::all();

        return view('borrowings.edit', compact('borrowing', 'assets', 'users'));
    }

    /**
     * Update the specified borrowing in storage.
     *
     * @param  UpdateBorrowingRequest  $request  Validated request object
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBorrowingRequest $request, $id) // Use validated request object
    {
        $borrowing = Borrowing::find($id);

        if (!$borrowing) {
            return abort(404);
        }

        $assetId = $request->input('asset_id');
        $userId = $request->input('user_id');
        $borrowDate = $request->input('borrow_date');
        $dueDate = $request->input('due_date');

        $borrowing->update([
            'asset_id' => $assetId,
            'user_id' => $userId,
            'borrow_date' => $borrowDate,
            'due_date' => $dueDate,
        ]);

        return Redirect::route('borrowings.show', $borrowing->id)->with('success', 'Borrowing updated successfully!'); // Redirect with borrowing ID and success message
    }
}