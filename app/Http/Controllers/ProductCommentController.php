<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductCommentRequest;
use App\Models\ProductComment;
use Illuminate\Support\Facades\Auth;

class ProductCommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductCommentRequest $request)
    {
        $form = $request->validated();
        $form["user_id"] = Auth::id();
        $form["product_id"] = $request->product_id;
        ProductComment::create($form);
        return back()->with('success', 'Comment added successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductComment $productComment)
    {
        //
    }
}
