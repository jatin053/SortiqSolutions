<div class="meta-box">
    <div class="meta-title">Publish</div>
    <div class="meta-body">
        <button type="button" class="btn preview-btn">Preview Changes</button>

        <label class="publish-field">
            Status
            <select name="status" class="@error('status') is-invalid @enderror">
                <option value="published" @selected(old('status', $clientLogo['status']) === 'published')>Published</option>
                <option value="draft" @selected(old('status', $clientLogo['status']) === 'draft')>Draft</option>
            </select>
        </label>
        @error('status')
            <span class="field-error">{{ $message }}</span>
        @enderror

        <p>Visibility: <strong>Public</strong></p>
        <p>Display order: <strong>{{ old('sort_order', $clientLogo['sort_order']) }}</strong></p>
    </div>
    <div class="meta-footer">
        <a href="#" class="trash-link">Move to Trash</a>
        <button type="submit" class="primary-btn">{{ $submitLabel }}</button>
    </div>
</div>

