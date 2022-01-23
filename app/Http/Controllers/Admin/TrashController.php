<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use App\ProductGallery;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrashController extends Controller
{
    public function user()
    {
        $items = User::onlyTrashed()->get();
        return view('admin.pages.trash.user',[
            'title' => 'Sampah',
            'items' => $items
        ]);
    }

    public function userRestore($id)
    {
        $user = User::withTrashed()->findOrFail($id)->restore();
        
        return redirect()->back()->with('success','User berhasil dipulihkan');
    }

    public function userDelete($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        Storage::disk('public')->delete($user->avatar);
        $user->forceDelete();
        
        return redirect()->back()->with('success','User berhasil dihapus secara permanen');
    }

    public function product()
    {
        $items = Product::onlyTrashed()->get();
        return view('admin.pages.trash.product',[
            'title' => 'Produk Sampah',
            'items' => $items
        ]);
    }

    public function productRestore($id)
    {
        $product = Product::withTrashed()->findOrFail($id)->restore();
        
        return redirect()->back()->with('success','Produk berhasil dipulihkan');
    }

    public function productDelete($id)
    {
        $gallery = ProductGallery::where('product_id', $id)->get();
        foreach($gallery as $gal){
            Storage::disk('public')->delete($gal->photo);
        }
        $product = Product::withTrashed()->findOrFail($id)->forceDelete();
        
        return redirect()->back()->with('success','Produk berhasil dihapus secara permanen');
    }

    public function transaction()
    {
        $items = Transaction::onlyTrashed()->get();
        return view('admin.pages.trash.transaction',[
            'title' => 'Transaksi Sampah',
            'items' => $items
        ]);
    }

    public function transactionRestore($id)
    {
        $transaction = Transaction::withTrashed()->findOrFail($id)->restore();
        
        return redirect()->back()->with('success','Transksi berhasil dipulihkan');
    }

    public function transactionDelete($id)
    {
        $transaction = Transaction::withTrashed()->findOrFail($id)->forceDelete();
        
        return redirect()->back()->with('success','Transksi berhasil dihapus secara permanen');
    }
}
