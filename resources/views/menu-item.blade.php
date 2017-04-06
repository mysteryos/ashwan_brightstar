<li class="@if($topMenuItem->hasSubMenu()) sub-menu @endif @if($topMenuItem->isActive()) active toggled @endif">
    <a href="{{$topMenuItem->href or "javascript:void(0);"}}" class="@if($topMenuItem->isActive()) active @endif"><i class="{{$topMenuItem->icon}}"></i> {{$topMenuItem->name}}</a>
    @if($topMenuItem->hasSubMenu())
        <ul>
            @foreach($topMenuItem->subMenu as $subMenuItem)
                @if($subMenuItem->hasPermission())
                    @include('menu-item',['topMenuItem' => $subMenuItem])
                @endif
            @endforeach
        </ul>
    @endif
</li>