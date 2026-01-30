@if ($count > 0)
    <span class="bg-green-100 text-green-800 text-xs 
        font-medium me-2 px-2.5 py-0.5 rounded">
        Yes, {{$count}} Groups
    </span>
        @foreach ($data as $item)
            <div class="text-xs">
                - {{$item->name}}
            </div>
        @endforeach
@else
    <span class="bg-red-100 text-red-800 text-xs 
        font-medium me-2 px-2.5 py-0.5 rounded">
        No
    </span>
    
@endif