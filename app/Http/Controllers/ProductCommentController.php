<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductCommentRequest;
use App\Models\ProductComment;
use App\Models\User;
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
    public function destroy(ProductComment $comment)
    {
        $user = User::find(Auth::id());
        if ($comment->user_id != $user->id && !$user->isAdmin()) {
            return back()->with('error', 'You are not authorized to delete this comment.');
        }
        $comment->delete();
        return back()->with('success', 'Comment deleted successfully.');
    }
}
