<select type="text" class="form-control longtails @error('longtails') is-invalid @enderror" name="longtails[]"
    multiple="multiple" id="longtails">
    @foreach ($longtails as $longtail)
        <option>
            {{ $longtail->name }}
        </option>
    @endforeach
</select>
@error('longtails')
    <div class="invalid-feedback">
        Longtail Keyword belum diisi
    </div>
@enderror


<script>
    $(document).ready(function() {
        $(".longtails").select2({
            placeholder: ' Longtail minimal 1 ',
            tags: true,
            allowClear: true,
            minimumInputLength: 3,
            theme: "classic",
            tokenSeparators: [","]
        });
    });
</script>
