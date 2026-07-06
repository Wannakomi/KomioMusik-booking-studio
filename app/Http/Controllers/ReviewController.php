<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with('user')->latest()->get();
        return view('backend.review.index', compact('reviews'));
    }

    public function destroy($id)
    {
        Review::destroy($id);
        return redirect()->back()->with('success', 'Review berhasil dihapus.');
    }

    // public function destroy($id)
    // {
    //     $review = Review::findOrFail($id);

    //     // Cek kalau user yang login bukan pemilik review
    //     if (auth()->id() !== $review->user_id) {
    //         abort(403, 'Kamu tidak boleh hapus review ini.');
    //     }

    //     $review->delete();
    //     return redirect()->back()->with('success', 'Review berhasil dihapus.');
    // }
    
    public function toggle($id)
    {
        $review = Review::findOrFail($id);
        $review->is_hidden = !$review->is_hidden;
        $review->save();

        return redirect()->back()->with('success', 'Status review diperbarui.');
    }

}
