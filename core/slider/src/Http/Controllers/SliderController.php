<?php
namespace Hydrogen\Slider\Http\Controllers;

use App\Http\Controllers\Controller;
use Hydrogen\Slider\Repositories\Eloquent\SlideRepository;
use Hydrogen\Slider\Repositories\Eloquent\SliderRepository;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Request;

class SliderController extends Controller {

    protected $sliderRepository;
    protected $slideRepository;

    public function __construct(
        SliderRepository $sliderRepository,
        SlideRepository $slideRepository
    ){
        $this->sliderRepository = $sliderRepository;
        $this->slideRepository = $slideRepository;
    }

    public function index() {

        hydrogen_authorize('sliders-index');
        $sliders = $this->sliderRepository->all();
        return view('slider::slider.index', ['sliders' => $sliders]);
    }

    public function create() {
        hydrogen_authorize('sliders-create');
        return view('slider::slider.create');
    }

    public function store(Request $request) {
        hydrogen_authorize('sliders-create');

        $slider_params = [
            'name' => $request->name,
            'position' => $request->position
        ];
        $this->sliderRepository->create($slider_params);

        Session::flash('flash', ['success' => 'Thêm thành công']);

        return redirect()->route('sliders.index');
    }

    public function show($id) {
        hydrogen_authorize('sliders-show');

        $slider = $this->sliderRepository->find($id);
        return view('slider::slider.show', ['slider' => $slider]);
    }

    public function edit($id) {
        hydrogen_authorize('sliders-edit');

        $slider = $this->sliderRepository->find($id);
        return view('slider::slider.edit', ['slider' => $slider]);
    }

    public function update(Request $request, $id) {
        hydrogen_authorize('sliders-edit');

        $slider_params = [
            'name' => $request->name,
            'position' => $request->position
        ];

        $this->sliderRepository->update($slider_params, $id);

        Session::flash('flash', ['success' => 'Cập nhập thành công']);
        return redirect()->route('sliders.index');
    }

    public function destroy($id) {
        hydrogen_authorize('sliders-destroy');

        $slider = $this->sliderRepository->find($id);

        foreach ($slider->slides as $slide) {
            $this->slideRepository->delete($slide->id);
        }

        $this->sliderRepository->delete($id);
        Session::flash('flash', ['success' => 'Xóa thành công']);
        return redirect()->route('sliders.index');
    }

    /* Slides */
    public function slideList($id) {
        $slider = $this->sliderRepository->find($id);
        return view('slider::slide.index', ['slider' => $slider]);
    }

    public function reOrderSlide(Request $request) {
        $slide = $this->slideRepository->find($request->input('id'));
        $slide->priority = $request->input('new_priority');
        $slide->save();

        return 1;
    }
}