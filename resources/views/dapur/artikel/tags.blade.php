<select type="text" class="form-control tags @error('tags') is-invalid @enderror" name="tags[]" multiple="multiple"
    id="tags">
    @foreach ($tags as $tag)
        <option>
            {{ $tag->name }}
        </option>
    @endforeach
</select>
@error('tags')
    <div class="invalid-feedback">
        Tag belum diisi
    </div>
@enderror


<script>
    $(document).ready(function() {
        $(".tags").select2({
            placeholder: ' Tag minimal 3 ',
            tags: true,
            allowClear: true,
            minimumInputLength: 3,
            theme: "classic",
            tokenSeparators: [","]
        });
    });
</script>
