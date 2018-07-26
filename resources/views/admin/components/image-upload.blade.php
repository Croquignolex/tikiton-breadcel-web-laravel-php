<label for="image">Image</label>
@if ($errors->has('image'))
    <small class="text-danger">
        {{ $errors->first('image') }}
    </small>
@endif
<input type="file" name="image" id="image" class="file-upload-default"
       @input="setImagePath" data-validate="false">
<div class="input-group col-xs-12">
    <input type="text" class="form-control file-upload-info" disabled placeholder="Importer image">
    <span class="input-group-append">
        <button class="file-upload-browse btn btn-info" type="button"
                onclick="document.getElementById('image').click();">
            Upload
        </button>
    </span>
</div>
<br>
<small class="text-theme">
    Le fichier doit avoir pour extension (jpg, JPG, jpeg, JPEG, png, PNG, gif, GIF, svg, SVG) <br>
    Le fichier doit être de dimension {{ $width }} * {{ $height }} <br>
    Le fichier doit être de taille 2Mo au plus
</small>