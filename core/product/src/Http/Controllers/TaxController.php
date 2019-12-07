<?php

namespace Hydrogen\Product\Http\Controllers;


use App\Http\Controllers\Controller;
use Hydrogen\Product\Repositories\Eloquent\Tax\TaxRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TaxController extends Controller
{
    protected $taxRepository;

    public function __construct(TaxRepository $taxRepository)
    {
        $this->taxRepository = $taxRepository;
    }

    public function index()
    {
        hydrogen_authorize('taxes-index');

        $taxes = $this->taxRepository->all();

        return view('product::tax.index', ['taxes' => $taxes]);
    }

    public function create()
    {
        hydrogen_authorize('taxes-create');

        return view('product::tax.create');
    }

    public function store(Request $request)
    {
        hydrogen_authorize('taxes-create');

        $tax_param = [
            'name' => $request->name,
            'value' => $request->value,
        ];

        $this->taxRepository->create($tax_param);

        Session::flash('flash', ['success' => 'Tax created successfully']);
        return redirect()->route('taxes.index');
    }

    public function edit($id)
    {
        hydrogen_authorize('taxes-edit');

        $tax = $this->taxRepository->find($id);

        return view('product::tax.edit', ['tax' => $tax]);
    }

    public function update(Request $request, $id)
    {
        hydrogen_authorize('taxes-edit');

        $tax_param = [
            'name' => $request->name,
            'value' => $request->value,
        ];

        $this->taxRepository->update($tax_param, $id);

        Session::flash('flash', ['success' => 'Tax updated successfully']);
        return redirect()->route('taxes.index');
    }

    public function show($id)
    {

    }

    public function destroy($id)
    {
        hydrogen_authorize('taxes-destroy');

        $this->taxRepository->delete($id);

        Session::flash('flash', ['success' => 'Tax deleted successfully']);
        return redirect()->route('taxes.index');
    }
}