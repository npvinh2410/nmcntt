<?php

namespace Hydrogen\Product\Http\Controllers;


use App\Http\Controllers\Controller;
use Hydrogen\Product\Repositories\Eloquent\Attribute\AttributeRepository;
use Hydrogen\Product\Repositories\Eloquent\Catalog\TagRepository;
use Hydrogen\Product\Repositories\Eloquent\Product\ProductImageRepository;
use Hydrogen\Product\Repositories\Eloquent\Product\ProductRepository;
use Hydrogen\Product\Repositories\Eloquent\Product\ProductTransRepository;
use Hydrogen\Product\Repositories\Eloquent\Tax\TaxRepository;
use Hydrogen\Seo\Repositories\Eloquent\SeoRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    protected $productRepository;
    protected $productTransRepository;
    protected $productImageRepository;
    protected $attributeRepository;
    protected $seoRepository;
    protected $taxRepository;
    protected $tagRepository;

    public function __construct(ProductRepository $productRepository,
                                ProductTransRepository $productTransRepository,
                                ProductImageRepository $productImageRepository,
                                AttributeRepository $attributeRepository,
                                SeoRepository $seoRepository,
                                TaxRepository $taxRepository,
                                TagRepository $tagRepository)
    {
        $this->productRepository = $productRepository;
        $this->productTransRepository = $productTransRepository;
        $this->productImageRepository = $productImageRepository;
        $this->attributeRepository = $attributeRepository;
        $this->seoRepository = $seoRepository;
        $this->taxRepository = $taxRepository;
        $this->tagRepository = $tagRepository;
    }

    public function index()
    {
        hydrogen_authorize('products-index');

        $products = $this->productRepository->scopeQuery(function($query){
            return $query->orderBy('created_at','desc');
        })->paginate(20);

        return view('product::product.index', ['products' => $products]);
    }

    public function create()
    {
        hydrogen_authorize('products-create');

        $attributes = $this->attributeRepository->all();
        $taxes = $this->taxRepository->all();
        $tags = $this->tagRepository->all();

        return view('product::product.create', [
            'attributes' => $attributes,
            'taxes' => $taxes,
            'tags' => $tags
        ]);
    }

    public function store(Request $request)
    {
        hydrogen_authorize('products-create');


        $categories = $request->categories;

        if(!$categories)
        {
            Session::flash('flash', ['warning' => 'Please Choose a Catalog']);
            return redirect()->back()->withInput();
        }

        $product_param = [
            'sku' => $request->sku,
            'stock' => $request->stock,
            'template' => $request->template,
            'thumbnail' => $request->thumbnail,
            'tax_id' => $request->tax,
        ];

        if($request->main_cat)
        {
            $product_param['main_cat'] = $request->main_cat;
        }
        else
        {
            $product_param['main_cat'] = $categories[0];
        }

        $product = $this->productRepository->create($product_param);

        $this->productRepository->update(['related' => $product->id], $product->id);

        $productTrans_param = [
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'price' => $request->price,
            'price_on_sale' => $request->price_on_sale,
            'discount' => $request->discount,
            'lang_code' => get_default_lang_code(),
            'product_id' => $product->id
        ];

        if($request->status)
        {
            $productTrans_param['status'] = true;
        }

        $productTrans = $this->productTransRepository->create($productTrans_param);



        if($request->product_images && is_array($request->product_images))
        {
            foreach($request->product_images as $img) {

                $productImg_params = [
                    'img' => $img,
                    'product_id' => $product->id,
                    'priority' => 1
                ];

                $this->productImageRepository->create($productImg_params);

            }
        }



        if(get_setting('shop') == 'on' && $request->attr && is_array($request->attr))
        {
            foreach ($request->attr as $attr)
            {
                $productTrans->attachAttribute($attr['attr_name'], json_encode($attr['attr_value']));
            }
        }

        if($categories && is_array($categories))
        {
            foreach ($categories as $category)
            {
                $product->attachCatalog($category);
            }
        }



        if($request->tags && is_array($request->tags))
        {
            foreach ($request->tags as $tag)
            {
                $product->attachTag($tag);
            }
        }

        $seo_param = [
            'title' => $request->seo_title,
            'description' => $request->seo_description,
            'keywords' => $request->seo_keywords,
            'canonical' => $request->seo_canonical,
            'lang_code' => get_default_lang_code(),
            'owner_type' => 'product',
            'owner_id' => $product->id,
        ];

        $this->seoRepository->create($seo_param);

        Session::flash('flash', ['success' => 'Product created successfully']);
        return redirect()->route('products.index');
    }

    public function show($id, $lang_code)
    {
        hydrogen_authorize('products-show');

        $product = $this->productRepository->find($id);

        return view('product::product.show', ['product' => $product, 'lang_code' => $lang_code]);
    }

    public function trans($id, $lang_code)
    {
        if(get_setting('multi_lang') != 'on')
        {
            abort(404);
        }

        hydrogen_authorize('products-create');

        $product = $this->productRepository->find($id);
        $attributes = $this->attributeRepository->all();

        return view('product::product.trans', [
            'product' => $product,
            'attributes' => $attributes,
            'lang_code' => $lang_code,
        ]);

    }

    public function storeTrans(Request $request, $id)
    {
        if(get_setting('multi_lang') != 'on')
        {
            abort(404);
        }

        hydrogen_authorize('products-create');

        $productTrans_param = [
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'price' => $request->price,
            'price_on_sale' => $request->price_on_sale,
            'discount' => $request->discount,
            'lang_code' => $request->lang_code,
            'product_id' => $id
        ];

        if($request->status)
        {
            $productTrans_param['status'] = true;
        }

        $productTrans = $this->productTransRepository->create($productTrans_param);

        if(get_setting('shop') == 'on' && $request->attr && is_array($request->attr))
        {
            foreach ($request->attr as $attr)
            {
                $productTrans->attachAttribute($attr['attr_name'], json_encode($attr['attr_value']));
            }
        }

        $seo_param = [
            'title' => $request->seo_title,
            'description' => $request->seo_description,
            'keywords' => $request->seo_keywords,
            'canonical' => $request->seo_canonical,
            'lang_code' => $request->lang_code,
            'owner_type' => 'product',
            'owner_id' => $id,
        ];

        $this->seoRepository->create($seo_param);

        Session::flash('flash', ['success' => 'Product created successfully']);
        return redirect()->route('products.index');
    }


    public function edit($id, $lang_code)
    {
        if($lang_code != get_default_lang_code() && get_setting('multi_lang') != 'on')
        {
            abort(404);
        }

        hydrogen_authorize('products-edit');

        $product = $this->productRepository->find($id);
        $taxes = $this->taxRepository->all();
        $tags = $this->tagRepository->all();
        $attributes = $this->attributeRepository->all();

        return view('product::product.edit', [
            'product' => $product,
            'taxes' => $taxes,
            'tags' => $tags,
            'attributes' => $attributes,
            'lang_code' => $lang_code,
        ]);
    }

    public function update(Request $request, $id, $lang_code)
    {
        if($lang_code != get_default_lang_code() && get_setting('multi_lang') != 'on')
        {
            abort(404);
        }

        hydrogen_authorize('posts-edit');

        $product = $this->productRepository->find($id);

        if($lang_code == get_default_lang_code())
        {
            $categories = $request->categories;

            if(!$categories)
            {
                Session::flash('flash', ['danger' => 'Please Choose Catalog For This Post']);
                return redirect()->back()->withInput();
            }

            $product_param = [
                'sku' => $request->sku,
                'stock' => $request->stock,
                'template' => $request->template,
                'thumbnail' => $request->thumbnail,
                'tax_id' => $request->tax,
            ];

            if($request->main_cat)
            {
                $product_param['main_cat'] = $request->main_cat;
            }
            else
            {
                $product_param['main_cat'] = $categories[0];
            }

            $this->productRepository->update($product_param, $id);

            if(is_array($categories))
            {
                $product->detachCatalogs();

                foreach($categories as $cat)
                {
                    $product->attachCatalog($cat);
                }
            }

            if(is_array($request->tags))
            {
                $product->detachTag();

                foreach($request->tags as $tag)
                {
                    $product->attachTag($tag);
                }
            }

            if($request->product_images && is_array($request->product_images))
            {
                $this->productImageRepository->deleteWhere(['product_id' => $id]);

                foreach($request->product_images as $img) {

                    $productImg_params = [
                        'img' => $img,
                        'product_id' => $product->id,
                        'priority' => 1
                    ];

                    $this->productImageRepository->create($productImg_params);

                }
            }

        }

        $productTrans_param = [
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'price' => $request->price,
            'price_on_sale' => $request->price_on_sale,
            'discount' => $request->discount,
        ];

        if($request->status)
        {
            $productTrans_param['status'] = true;
        }

        $productTrans = $this->productTransRepository->update($productTrans_param, $product->translate($lang_code)->id);

        if(get_setting('shop') == 'on' && $request->attr && is_array($request->attr))
        {
            $productTrans->detachAttribute();

            foreach ($request->attr as $attr)
            {
                $productTrans->attachAttribute($attr['attr_name'], json_encode($attr['attr_value']));
            }
        }

        $seo_params = [
            'title' => $request->seo_title,
            'description' => $request->seo_description,
            'keywords' => $request->seo_keywords,
            'canonical' => $request->seo_canonical,
        ];

        $this->seoRepository->update($seo_params, $product->seos($lang_code)->id);

        Session::flash('flash', ['success' => 'Product updated successfully']);
        return redirect()->route('products.index');
    }

    public function destroy(Request $request, $id)
    {
        hydrogen_authorize('products-destroy');

        $product = $this->productRepository->find($id);

        if($request->lang_code)
        {
            $this->productTransRepository->delete($product->translate($request->lang_code)->id);
            $this->seoRepository->delete($product->seos($request->lang_code)->id);
        }
        else
        {
            $product->detachCatalogs();
            $product->detachTag();

            $trans = $this->productTransRepository->findByField('product_id', $product->id);

            foreach ($trans as $tran)
            {
                $tran->detachAttribute();
                $this->productTransRepository->delete($tran->id);
            }
            $this->productImageRepository->deleteWhere(['product_id' => $product->id]);
            $this->seoRepository->deleteWhere(['owner_type' => 'product', 'owner_id' => $product->id]);
            $this->productRepository->delete($id);

        }
        Session::flash('flash', ['success' => 'Product deleted successfully']);
        return redirect()->route('products.index');
    }
}