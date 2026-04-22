<div class="meta-box">
    <div class="meta-title">Publish</div>
    <div class="meta-body">
        <label class="publish-field">
            Status
            <select name="status" class="@error('status') is-invalid @enderror">
                <option value="published" @selected(old('status', $blog['status']) === 'published')>Published</option>
                <option value="draft" @selected(old('status', $blog['status']) === 'draft')>Draft</option>
            </select>
        </label>
        @error('status')
            <span class="field-error">{{ $message }}</span>
        @enderror

        <p>Visibility: <strong>Public</strong></p>
        <p>Published on: <strong>{{ $blog['published_label'] }}</strong></p>
    </div>
    <div class="meta-footer">
        <button type="submit" class="primary-btn">{{ $submitLabel }}</button>
    </div>
</div>
