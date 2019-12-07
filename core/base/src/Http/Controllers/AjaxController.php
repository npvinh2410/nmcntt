<?php


namespace Hydrogen\Base\Http\Controllers;


use App\Http\Controllers\Controller;
use Hydrogen\Base\Models\Contact;
use Hydrogen\Product\Models\Product\NewSale;
use Hydrogen\Theme\Models\Rating;
use Illuminate\Http\Request;
use Hydrogen\Product\Models\Product\Features;
use Hydrogen\Product\Repositories\Eloquent\Attribute\AttributeRepository;
use Hydrogen\Product\Repositories\Eloquent\Product\ProductRepository;

class AjaxController extends Controller
{
    protected $attributeRepository;
    protected $productRepository;

    public function __construct(AttributeRepository $attributeRepository,
                                ProductRepository $productRepository)
    {
        $this->attributeRepository = $attributeRepository;
        $this->productRepository = $productRepository;
    }

    public function attributesValue(Request $request)
    {
        $attribute = $this->attributeRepository->find($request->attr_id);

        return $attribute->values;
    }

    public function features(Request $request)
    {
        $feature = Features::where('product_id', $request->id)->first();

        if($feature == null)
        {
            $n_feature = new Features();

            $n_feature->product_id = $request->id;
            $n_feature->save();

            return 'add_features';
        }
        else
        {
            $feature->delete();

            return 'remove_features';
        }
    }

    public function getProductInfo(Request $request)
    {
        $product_id = $request->id;
        $lang_code = $request->lang_code;

        $product = $this->productRepository->find($product_id);

        $info['thumbnail'] = $product->the_thumbnail();
        $info['name'] = $product->translate($lang_code)->the_title();
        $info['price'] = number_format($product->translate($lang_code)->the_price());
        if($product->translate($lang_code)->the_price_on_sale() != null)
        {
            $info['price_sale'] = number_format($product->translate($lang_code)->the_price_on_sale());
        }
        else
        {
            $info['price_sale'] = null;
        }
        $info['description'] = $product->translate($lang_code)->the_excerpt();
        $info['stock'] = $product->the_stock();
        $info['hyperlink'] = $product->translate($lang_code)->the_hyperlink();
        foreach ($product->images as $image)
        {
            $info['images'][] = $image->the_img();
        }

        if($product->new_sale != null && $product->new_sale->type == 1)
        {
            $info['sale'] = 1;
        }
        elseif ($product->new_sale != null && $product->new_sale->type == 2)
        {
            $info['sale'] = 2;
        }
        else
        {
            $info['sale'] = 0;
        }

        return json_encode($info);
    }

    public function options(Request $request)
    {
        $id = $request->id;
        $option = $request->option;

        $option_item = NewSale::where('product_id', $id)->first();

        switch ($option)
        {
            case 0:

                if($option_item != null)
                {
                    $option_item->delete();
                }

                break;
            case 1:

                if($option_item == null)
                {
                    $n_option = new NewSale();

                    $n_option->type = 1;
                    $n_option->product_id = $id;
                    $n_option->save();
                }
                else
                {
                    $option_item->type = 1;
                    $option_item->save();
                }

                break;
            case 2:

                if($option_item == null)
                {
                    $n_option = new NewSale();

                    $n_option->type = 2;
                    $n_option->product_id = $id;
                    $n_option->save();
                }
                else
                {
                    $option_item->type = 2;
                    $option_item->save();
                }

                break;
        }
    }

    public function ratings(Request $request)
    {
        $star = $request->star;

        $type = $request->type;
        $id = $request->id;

        $rating = Rating::Where('owner_type', $type)->where('owner_id',  $id)->first();

        if($rating != null)
        {

            $rating->rating = ( ( (float)($rating->rating) + (float)($star) )/2);
            $rating->number_rating = ($rating->number_rating + 1);

            $rating->save();

            $html = '<div class="pull-left">
                        <input type="text" class="kv-gly-heart rating-loading" value="'.$rating->rating.'" data-size="xs" title="" data-readonly>
                        <span itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">
                            <span itemprop="ratingValue">'.$rating->rating.'</span> sao, trên tổng số
                            <span itemprop="reviewCount">'.$rating->number_rating.'</span> lượt đánh giá.
                      </span>
                </div>
                <div class="clearfix"></div>';

            return $html;
        }
        else
        {
            $rating = new Rating();

            $rating->owner_type = $type;
            $rating->owner_id = $id;
            $rating->rating = floatval($star);
            $rating->number_rating = 1;

            $rating->save();

            $html = '<div class="pull-left">
                        <input type="text" class="kv-gly-heart rating-loading" value="'.$rating->rating.'" data-size="xs" title="" data-readonly>
                        <span itemprop="aggregateRating" itemscope="" itemtype="http://schema.org/AggregateRating">
                            <span itemprop="ratingValue">'.$rating->rating.'</span> sao, trên tổng số
                            <span itemprop="reviewCount">'.$rating->number_rating.'</span> lượt đánh giá.
                        </span>
                    </div>
                    <div class="clearfix"></div>';

            return $html;
        }
    }

    public function notification_status(Request $request)
    {
        $notification = current_user()->notifications->find($request->id);

        $notification->markAsRead();

    }

    public function contact(Request $request)
    {
        $id = $request->id;
        $flag = 0;

        $contact = Contact::find($id);

        if($contact->status == false)
        {
            $contact->status = true;
            $flag = 1;
        }
        else
        {
            $contact->status = false;
            $flag = 0;
        }

        $contact->save();

        return $flag;
    }
}