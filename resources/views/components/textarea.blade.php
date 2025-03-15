@props(['disabled' => false, 'hidden' => false])

<div>
    <textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm', 'style' => $hidden ? 'display: none;' : '']) !!}>
        {{ $slot }}
    </textarea>
    @if (!$hidden)
        <button type="button" onclick="previewBio()" class="font-medium text-sm text-green-600 mt-2 px-3 py-2 rounded-md">{{ __('Preview Bio') }}</button>
        <div id="bio-preview" class="mt-2 p-2 border border-gray-300 rounded-md" style="display:none;"></div>
    @endif
</div>

<script>
    function previewBio() {
        const bioText = document.querySelector('textarea#body').value;
        const bioPreview = document.getElementById('bio-preview');
        bioPreview.style.display = 'block';
        bioPreview.textContent = bioText;
    }
</script>
