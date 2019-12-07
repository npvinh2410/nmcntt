<?php


namespace Hydrogen\Widget\Http\Controllers;


use App\Http\Controllers\Controller;
use Hydrogen\Widget\Repositories\Eloquent\WidgetTranslateRepository;
use Hydrogen\Widget\Repositories\Eloquent\WidgetRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class WidgetController extends Controller
{
    protected $widgetRepository;
    protected $widgetTranslateRepository;

    public function __construct(WidgetRepository $widgetRepository, WidgetTranslateRepository $widgetTranslateRepository)
    {
        $this->widgetRepository = $widgetRepository;
        $this->widgetTranslateRepository = $widgetTranslateRepository;
    }

    public function index()
    {
        hydrogen_authorize('widgets-index');


        $widgets = $this->widgetRepository->paginate();

        return view('widget::index', ['widgets' => $widgets]);
    }

    public function create()
    {
        hydrogen_authorize('widgets-create');

        return view('widget::create');
    }

    public function store(Request $request)
    {
        hydrogen_authorize('widgets-create');

        $param_widget = [
            'positions' => $request->positions,
        ];

        $widget = $this->widgetRepository->create($param_widget);

        $param_widget_trans = [
            'widget_id' => $widget->id,
            'content' => $request->w_content,
            'lang_code' => get_default_lang_code(),
        ];

        $this->widgetTranslateRepository->create($param_widget_trans);



        Session::flash('flash', ['success' => 'Widget created successfully']);

        return redirect()->route('widgets.index');
    }

    public function trans($id, $lang_code)
    {
        if(get_setting('multi_lang') != 'on')
        {
            abort(404);
        }

        hydrogen_authorize('widgets-create');

        $widget = $this->widgetRepository->find($id);

        return view('widget::trans', [
            'widget' => $widget,
            'lang_code' => $lang_code,
        ]);
    }

    public function storeTrans(Request $request, $id)
    {
        if(get_setting('multi_lang') != 'on')
        {
            abort(404);
        }

        hydrogen_authorize('widgets-create');

        $widget = $this->widgetRepository->find($id);

        $widget_translation_params = [
            'widget_id' => $widget->id,
            'lang_code' => $request->lang_code,
            'content' => $request->w_content,
        ];

        $this->widgetTranslateRepository->create($widget_translation_params);


        Session::flash('flash', ['success' => 'Widget translated successfully']);
        return redirect()->route('widgets.index');

    }

    public function show($id, $lang_code)
    {
        if($lang_code != get_default_lang_code() && get_setting('multi_lang') != 'on')
        {
            abort(404);
        }

        hydrogen_authorize(['widgets-show']);

        $widget = $this->widgetRepository->find($id);

        return view('widget::show', ['widget' => $widget, 'lang_code' => $lang_code]);
    }

    public function edit($id, $lang_code)
    {
        if($lang_code != get_default_lang_code() && get_setting('multi_lang') != 'on')
        {
            abort(404);
        }

        hydrogen_authorize('widgets-edit');


        $widget = $this->widgetRepository->find($id);

        return view('widget::edit', [
            'widget' => $widget,
            'lang_code' => $lang_code,
        ]);
    }

    public function update(Request $request, $id, $lang_code)
    {
        if($lang_code != get_default_lang_code() && get_setting('multi_lang') != 'on')
        {
            abort(404);
        }

        hydrogen_authorize('widgets-edit');

        $widget = $this->widgetRepository->find($id);
        $widgetContent = $widget->translate($lang_code);

        if($lang_code == get_default_lang_code())
        {
            $param_widget = [
                'positions' => $request->positions,
            ];

            $this->widgetRepository->update($param_widget, $id);
        }

        $param_trans = [
            'content' => $request->w_content,
        ];

        $this->widgetTranslateRepository->update($param_trans, $widgetContent->id);

        Session::flash('flash', ['success' => 'Widget updated successfully']);

        return redirect()->route('widgets.index');
    }

    public function destroy(Request $request, $id)
    {
        hydrogen_authorize('widgets-destroy');

        $widget = $this->widgetRepository->find($id);

        if($request->lang_code)
        {
            $widget_translate = $widget->translate($request->lang_code);

            $this->widgetTranslateRepository->delete($widget_translate->id);
        }
        else
        {
            $this->widgetTranslateRepository->deleteWhere(['widget_id' => $widget->id]);

            $this->widgetRepository->delete($widget->id);
        }

        Session::flash('flash', ['success' => 'Widget deleted successfully']);

        return redirect()->route('widgets.index');
    }

}