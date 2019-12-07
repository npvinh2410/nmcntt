<?php

namespace Hydrogen\Widget\Models;


use Illuminate\Database\Eloquent\Model;

class WidgetTranslate extends Model
{
    protected $table = 'widget_translate';

    protected $fillable = [
        'widget_id', 'content', 'lang_code',
    ];

    public function widget()
    {
        return $this->belongsTo(Widget::class, 'widget_id', 'id');
    }

    public function show()
    {
        $html = '<div class="dd"><ol class="dd-list">';

        if($this->content != null)
        {
            $data_parsed = json_decode($this->content, true);



            foreach($data_parsed as $items)
            {

                $html .= '<li class="dd-item"><div class="dd-handle">'. $items['title'] .'</div></li>';

                $html .= '</ol></li>';
            }
        }

        $html .= '</ol></div>';
        echo $html;

    }

    public function render()
    {
        $html = '<ol class="dd-list root-list">';

        if($this->content != null) {
            $data_parsed = json_decode($this->content, true);


            $i = 1;
            foreach ($data_parsed as $items) {
                $html .= "<li id='widget-".$i."' class='dd-item' data-title='".$items["title"]."' data-content='".$items["content"]."'> <div class='dd-handle'>".$items["title"]."</div><div class='dd-remove'><a class='pull-right' onclick='removeItem(this)'><i class='la la-trash'></i></a></div><div class='dd-delete'><a class='pull-right' onclick='editItem(this)'><i class='la la-edit'></i></a></div></li>";
                $i++;
            }
        }

        $html .= '</ol>';
        echo $html;
    }

}