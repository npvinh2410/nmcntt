<div class="form-group m-form__group row">
    <label for="{{ $name }}" class="col-2 col-form-label">
        {{ reverse_slug($name) }}:
    </label>
    <div class="col-10">
        <div class="m--margin-bottom-15">
            <button class="btn btn-primary btn_gallery_media" data-result="{{ $name }}" data-multiple="true" data-action="media-insert-ckeditor">
                <i class="fa fa-picture-o"></i> Add media
            </button>
        </div>
        <textarea name="{{ $name }}" id="{{ $name }}" class="_ckeditor">
            @if(isset($rl_value))
                {!! $rl_value !!}
            @elseif(isset($old_value))
                {!! $old_value !!}
            @endif
        </textarea>
    </div>
</div>

