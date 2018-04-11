<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Models\ContactUS;

class ContactUSController extends Controller
{
  public function index()
  {
      $mails = ContactUS::orderby('id', 'desc')->paginate(10);

      return view('admin.contactus.index', compact('mails'));
  }

  public function destroy($id)
    {
        ContactUS::find($id)->delete();
        return Redirect::to('/admin/contact-us');
    }
}
