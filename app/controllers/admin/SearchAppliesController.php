<?php

class SearchAppliesController extends \BaseController {

	/**
	 * Display a listing of searchapplies
	 *
	 * @return Response
	 */
	public function index()
	{
		$searchapplies = Searchapply::all();

		return View::make('searchapplies.index', compact('searchapplies'));
	}

	/**
	 * Show the form for creating a new searchapply
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('searchapplies.create');
	}

	/**
	 * Store a newly created searchapply in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), Searchapply::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		Searchapply::create($data);

		return Redirect::route('searchapplies.index');
	}

	/**
	 * Display the specified searchapply.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$searchapply = Searchapply::findOrFail($id);

		return View::make('searchapplies.show', compact('searchapply'));
	}

	/**
	 * Show the form for editing the specified searchapply.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$searchapply = Searchapply::find($id);

		return View::make('searchapplies.edit', compact('searchapply'));
	}

	/**
	 * Update the specified searchapply in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$searchapply = Searchapply::findOrFail($id);

		$validator = Validator::make($data = Input::all(), Searchapply::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$searchapply->update($data);

		return Redirect::route('searchapplies.index');
	}

	/**
	 * Remove the specified searchapply from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		Searchapply::destroy($id);

		return Redirect::route('searchapplies.index');
	}

}
