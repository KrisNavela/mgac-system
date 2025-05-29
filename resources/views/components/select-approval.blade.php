@props(['field', 'label', 'options', 'selected'])

<div class="mt-4">
    <x-input-label :for="$field" :value="__($label)" />
    <select name="{{ $field }}" class="w-full border-gray-300 rounded mt-1">
        @foreach ($options as $option)
            <option value="{{ $option }}" {{ $option === $selected ? 'selected' : '' }}>
                {{ ucfirst($option) }}
            </option>
        @endforeach
    </select>
    <x-input-error :messages="$errors->get($field)" class="mt-2" />
</div>
