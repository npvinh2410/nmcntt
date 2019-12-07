<?php

namespace Hydrogen\Seo\Http\Controllers;


use App\Http\Controllers\Controller;
use Hydrogen\Seo\Repositories\Eloquent\SeoUpdateRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class SeoUpdateController extends Controller
{
    protected $seoUpdateRepository;

    public function __construct(SeoUpdateRepository $seoUpdateRepository)
    {
        $this->seoUpdateRepository = $seoUpdateRepository;
    }

    public function index()
    {
        hydrogen_authorize('seos-index');

        $seoUpdate = $this->seoUpdateRepository->all();

        return view('seo::seoUpdate.index', ['seoUpdate' => $seoUpdate]);
    }

    public function create()
    {
        hydrogen_authorize('seos-create');

        return view('seo::seoUpdate.create');
    }

    public function store(Request $request)
    {
        hydrogen_authorize('seos-create');

        $param = Input::all();

        $this->seoUpdateRepository->create($param);

        Session::flash('flash', ['success' => 'SeoUpdate created successfully']);
        return redirect()->route('seoUpdate.index');
    }

    public function show($id)
    {
        hydrogen_authorize('seos-show');

        $seo = $this->seoUpdateRepository->find($id);

        return view('seo::seoUpdate.show', ['seo' => $seo]);
    }

    public function edit($id)
    {
        hydrogen_authorize('seos-edit');

        $seo = $this->seoUpdateRepository->find($id);

        return view('seo::seoUpdate.edit', ['seo' => $seo]);
    }

    public function update($id, Request $request)
    {
        hydrogen_authorize('seos-edit');

        $param = Input::all();

        $this->seoUpdateRepository->update($param, $id);

        Session::flash('flash', ['success' => 'SeoUpdate updated successfully']);
        return redirect()->route('seoUpdate.index');
    }

    public function destroy($id, Request $request)
    {
        hydrogen_authorize('seos-destroy');

        $this->seoUpdateRepository->delete($id);

        Session::flash('flash', ['success' => 'SeoUpdate deleted successfully']);
        return redirect()->route('seoUpdate.index');
    }
}