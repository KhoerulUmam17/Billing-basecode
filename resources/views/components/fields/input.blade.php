<div class="w-full mb-6">
    <label class="block uppercase text-slate-600 dark:text-white text-xs font-bold mb-2">
        {{$data['text']}}
        @if (in_array('required', $data['rules']))
            <span class="text-danger"> *</span>
        @endif
    </label>
    <input @if (in_array('disabled-create', $data['hide'])) disabled @endif 
        type="{{$type}}" id="form.{{$data['name']}}-{{$modal}}" wire:model.blur='form.{{$data['name']}}'
        class="@error('form.'.$data['name']) is-invalid @enderror border-sky-100 form-control"
        placeholder="{{$data['text']}}" required>
    @error('form.'.$data['name'])
        <span class="text-danger">{{ str_replace('_', ' ', ucfirst($data['name'])) }} {{ $message }}</span>
    @enderror
    
</div>
