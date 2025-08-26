<?php
$categories = App\Models\Category::where('status', 1)->get();
$sub_categories = App\Models\Category::where('parent_id', '!=', 0)
    ->where('status', 1)
    ->get();
?>

<div class="search-overlay-menu">
    <span class="search-overlay-close"><span class="closebt"><i class="icon_close"></i></span></span>
    <form action="{{ route('search') }}" role="search" id="searchform" method="post">
        @csrf
        <input name="product_name" type="search" placeholder="Search..." />
        <button type="submit"><i class="icon_search"></i></button>
    </form>
</div>
