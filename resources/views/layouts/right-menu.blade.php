@foreach(groups() as $key => $group) 

    @if($group) 
    <li class="nav-item start">
        <a href="javascript:;" class="nav-link nav-toggle parent">
            <i class="{{ $group->icon }}"></i>
            <span class="title">{{ ucfirst($group->name) }} </span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            @foreach(groupMenu($group->id) as $menu)  
                @if($menu->nav_type == "top-right" && $menu->type == "index") 
                    @if($menu->group_menu_id && $menu->group_menu_id == $group->id)
                    <li class="nav-item">
                        <a href="javascript:;" data-url="{{ route($menu->route) }}" class="nav-link sub">
                            <span class="title">
                                {{($menu->controller && $menu->controller->text)?ucfirst($menu->controller->text):ucfirst($menu->name)}}
                            </span> 
                        </a> 
                    </li> 
                    @endif
                @endif 
            @endforeach 
        </ul>
    </li>
    @endif 
@endforeach