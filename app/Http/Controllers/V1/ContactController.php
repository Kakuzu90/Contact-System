<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		return view('contact.index');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view("contact.create");
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$request->validate([
			'name' => 'required',
			'email' => 'required',
			'phone' => 'required',
			'company' => 'required',
		]);

		Contact::create([
			'name' => $request->name,
			'email' => $request->email,
			'phone' => $request->phone,
			'company' => $request->company
		]);

		return redirect()->route('contacts.index')->with('success', 'New contact has been added.');
	}

	public function edit(Contact $contact)
	{
		if ($contact->user_id !== Auth::id()) abort(404);
		return view("contact.edit", compact('contact'));
	}

	public function update(Request $request, Contact $contact)
	{
		$request->validate([
			'name' => 'required',
			'email' => 'required',
			'phone' => 'required',
			'company' => 'required',
		]);

		$contact->update([
			'name' => $request->name,
			'email' => $request->email,
			'phone' => $request->phone,
			'company' => $request->company
		]);

		return redirect()->route('contacts.index')->with('success', 'The contact has been updated.');
	}

	public function destroy(Contact $contact)
	{
		$contact->delete();

		return response()->noContent();
	}

	public function search(Request $request)
	{
		$search = $request->input('search');

		$query = Contact::myContact()->where(function ($q) use ($search) {
			$q->where('name', 'like', "%$search%")->orWhere('company', 'like', "%$search%")
				->orWhere('email', 'like', "%$search%")->orWhere('phone', 'like', "%$search%");
		});

		return $query->latest()->paginate(1);
	}
}
