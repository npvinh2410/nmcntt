<?php

namespace Hydrogen\Product\Http\Controllers;


use App\Http\Controllers\Controller;
use Hydrogen\Product\Repositories\Eloquent\Attribute\AttributeRepository;
use Hydrogen\Product\Repositories\Eloquent\Attribute\AttributeTransRepository;
use Hydrogen\Product\Repositories\Eloquent\Attribute\AttributeValueRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AttributeController extends Controller
{
    protected $attributeRepository;
    protected $attributeTransRepository;
    protected $attributeValueRepository;

    public function __construct(AttributeRepository $attributeRepository,
                                AttributeTransRepository $attributeTransRepository,
                                AttributeValueRepository $attributeValueRepository)
    {
        $this->attributeRepository = $attributeRepository;
        $this->attributeTransRepository = $attributeTransRepository;
        $this->attributeValueRepository = $attributeValueRepository;
    }

    public function index()
    {
        hydrogen_authorize('attributes-index');

        $attributes = $this->attributeRepository->scopeQuery(function($query){
            return $query->orderBy('created_at','desc');
        })->paginate(20);

        return view('product::attribute.index', ['attributes' => $attributes]);
    }

    public function create()
    {
        hydrogen_authorize('attributes-create');

        return view('product::attribute.create');
    }

    public function store(Request $request)
    {
        hydrogen_authorize('attributes-create');

        $attribute_param = [
            'type' => $request->type,
        ];

        $attribute = $this->attributeRepository->create($attribute_param);

        $attributeTrans_param = [
            'name' => $request->name,
            'lang_code' => get_default_lang_code(),
            'attributes_id' => $attribute->id,
        ];

        $this->attributeTransRepository->create($attributeTrans_param);

        if(is_array($request->attribute_value))
        {
            foreach ($request->attribute_value as $value) {
                $value_param = [
                    'value' => $value,
                    'attributes_id' => $attribute->id,
                ];

                $this->attributeValueRepository->create($value_param);
            }
        }

        Session::flash('flash', ['success' => 'Attribute created successfully']);
        return redirect()->route('attributes.index');

    }

    public function show($id, $lang_code)
    {
        hydrogen_authorize('attributes-show');

        $attribute = $this->attributeRepository->find($id);

        return view('product::attribute.show', ['attribute' => $attribute, 'lang_code' => $lang_code]);
    }

    public function trans($id, $lang_code)
    {
        if(get_setting('multi_lang') != 'on')
        {
            abort(404);
        }

        hydrogen_authorize('attributes-create');

        $attribute = $this->attributeRepository->find($id);

        return view('product::attribute.trans', [
            'attribute' => $attribute,
            'lang_code' => $lang_code,
        ]);
    }

    public function storeTrans(Request $request, $id)
    {
        if(get_setting('multi_lang') != 'on')
        {
            abort(404);
        }

        hydrogen_authorize('attributes-create');

        $attributeTrans_param = [
            'name' => $request->name,
            'lang_code' => $request->lang_code,
            'attributes_id' => $id,
        ];

        $this->attributeTransRepository->create($attributeTrans_param);

        if(is_array($request->attribute_value))
        {
            foreach ($request->attribute_value as $value) {
                $value_param = [
                    'attributes_id' => $id,
                    'value' => $value
                ];

                $this->attributeValueRepository->create($value_param);
            }
        }

        Session::flash('flash', ['success' => 'Attribute created successfully']);
        return redirect()->route('attributes.index');
    }

    public function edit($id, $lang_code)
    {
        if($lang_code != get_default_lang_code() && get_setting('multi_lang') != 'on')
        {
            abort(404);
        }

        hydrogen_authorize('attributes-edit');

        $attribute = $this->attributeRepository->find($id);

        return view('product::attribute.edit', [
            'attribute' => $attribute,
            'lang_code' => $lang_code,
        ]);
    }

    public function update(Request $request, $id, $lang_code)
    {

        if($lang_code != get_default_lang_code() && get_setting('multi_lang') != 'on')
        {
            abort(404);
        }

        hydrogen_authorize('attributes-edit');

        $attribute = $this->attributeRepository->find($id);

        if($request->type)
        {
            $attribute_param['type'] = $request->type;

            $this->attributeRepository->update($attribute_param, $id);
        }

        $attributeTrans_param = [
            'name' => $request->name,
        ];

        $this->attributeTransRepository->update($attributeTrans_param, $attribute->translate($lang_code)->id);

        if($request->attribute_value && is_array($request->attribute_value))
        {
            $this->attributeValueRepository->deleteWhere(['attributes_id' => $attribute->id]);

            foreach ($request->attribute_value as $value)
            {
                $value_param = [
                    'value' => $value,
                    'attributes_id' => $attribute->id,
                ];

                $this->attributeValueRepository->create($value_param);
            }
        }


        Session::flash('flash', ['success' => 'Attribute updated successfully']);
        return redirect()->route('attributes.index');
    }

    public function destroy(Request $request, $id) {
        hydrogen_authorize('attributes-destroy');

        $attribute = $this->attributeRepository->find($id);

        if($request->lang_code)
        {
            $this->attributeTransRepository->delete($attribute->translate($request->lang_code)->id);
        }
        else
        {
            $this->attributeValueRepository->deleteWhere(['attributes_id' => $attribute->id]);
            $this->attributeTransRepository->deleteWhere(['attributes_id' => $attribute->id]);

            $this->attributeRepository->delete($id);
        }
        Session::flash('flash', ['success' => 'Attribute deleted successfully']);
        return redirect()->route('attributes.index');
    }
}