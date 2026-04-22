<div class="meta-box">
    <div class="meta-title">Publish</div>
    <div class="meta-body">
        <label class="publish-field">
            Status
            <select name="status" class="@error('status') is-invalid @enderror">
                <option value="published" @selected(old('status', $portfolio['status']) === 'published')>Published</option>
                <option value="draft" @selected(old('status', $portfolio['status']) === 'draft')>Draft</option>
            </select>
        </label>
        @error('status')
            <span class="field-error">{{ $message }}</span>
        @enderror

        <p>Visibility: <strong>Public</strong></p>
        <p>Display order: <strong>{{ old('sort_order', $portfolio['sort_order']) }}</strong></p>
    </div>
    <div class="meta-footer">
        <button type="submit" class="primary-btn">{{ $submitLabel }}</button>
    </div>
</div>
