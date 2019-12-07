<?php
namespace Hydrogen\Slider\Http\Controllers;

use App\Http\Controllers\Controller;
use Hydrogen\Slider\Repositories\Eloquent\SlideRepository;
use Hydrogen\Slider\Repositories\Eloquent\SliderRepository;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Request;

class SlideController extends Controller {

    protected $sliderRepository;
    protected $slideRepository;

    public function __construct(
        SliderRepository $sliderRepository,
        SlideRepository $slideRepository
    ){
        $this->sliderRepository = $sliderRepository;
        $this->slideRepository = $slideRepository;
    }


    public function create($id) {
        hydrogen_authorize('slides-create');

        $slider = $this->sliderRepository->find($id);
        return view('slider::slide.create', [
            'slider' => $slider,
        ]);
    }

    public function store(Request $request) {
        hydrogen_authorize('slides-create');

        $slide_params = [
            'slider_id' => $request->slider_id,
            'name' => $request->slide_name,
            'image' => $request->slide_image,
            'href' => $request->slide_href,
            'target' => $request->slide_target,
            'follow' => $request->slide_follow
        ];

        $slide = $this->slideRepository->create($slide_params);
        $slide->priority = $slide->id;
        $slide->save();

        Session::flash('flash', ['success' => 'Thêm thành công']);
        return redirect()->route('sliders.slides', $request->slider_id);
    }

    public function show($id) {
        hydrogen_authorize('slides-show');

        $slide = $this->slideRepository->find($id);
        return view('slider::slide.show', ['slide' => $slide]);
    }

    public function edit($id) {
        hydrogen_authorize('slides-edit');

        $slide = $this->slideRepository->find($id);
        return view('slider::slide.edit', ['slide' => $slide]);
    }

    public function update(Request $request, $id) {
        hydrogen_authorize('slides-edit');

        $slide_params = [
            'name' => $request->slide_name,
            'image' => $request->slide_image,
            'href' => $request->slide_href,
            'target' => $request->slide_target,
            'follow' => $request->slide_follow
        ];

        $slide = $this->slideRepository->update($slide_params, $id);

        Session::flash('flash', ['success' => 'Cập nhập thành công']);
        return redirect()->route('sliders.slides', $slide->slider->id);
    }

    public function destroy($id) {
        hydrogen_authorize('slides-destroy');

        $tmp = $this->slideRepository->find($id);
        $slider_id = $tmp->slider->id;

        $this->slideRepository->delete($id);
        Session::flash('flash', ['success' => 'Xóa thành công']);
        return redirect()->route('sliders.slides', $slider_id);
    }
}