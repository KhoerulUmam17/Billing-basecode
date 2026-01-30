<div class="w-full mb-6">

    <label class="block uppercase text-slate-600 dark:text-white text-xs font-bold mb-2">{{$data['text']}}</label>
    <textarea id="form.{{$data['name']}}-{{$modal}}" wire:model.blur='form.{{$data['name']}}' rows="4"
        class="@error('form.'.$data['name']) is-invalid @enderror form-control"
        placeholder="{{$data['text']}}">
    </textarea>
    @error('form.'.$data['name'])
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
