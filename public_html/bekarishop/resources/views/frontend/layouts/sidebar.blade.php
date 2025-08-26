
<?php
    $main_categories = App\Models\Category::where('parent_id', '==' , 0)->where('status', 1)->get();
    $sub_categories = App\Models\Category::where('parent_id', '!=' , 0)->where('status', 1)->get();
    $categories = App\Models\Category::where('status', 1)->get();
    $colors = App\Models\Color::where('status', 1)->get();
    $sizes = App\Models\Size::where('status', 1)->get();
    $brands = App\Models\Brand::where('status', 1)->get();
?>

<div class="col-12 col-md-3">
    <div class="ps-widget ps-widget--product">
        <div class="ps-widget__block">
            <h4 class="ps-widget__title">Categories</h4><a class="ps-block-control" href="#"><i class="fa fa-angle-down"></i></a>
            <div class="ps-widget__content ps-widget__category">
                <ul class="menu--mobile">

                    @foreach($main_categories as $main_category)
                    <?php 
                        $sub_categories = App\Models\Category::where('parent_id', $main_category->id)->where('status', 1)->get();
                    ?>
                    <li><a href="{{route('/', [$main_category->slug])}}">{{$main_category->name}}</a><span class="sub-toggle"><i class="fa fa-chevron-down"></i></span>
                        <ul class="sub-menu">

                            @foreach($sub_categories as $sub_category)
                            <li><a href="{{route('/', [$sub_category->slug])}}">{{$sub_category->name}}</a></li>
                            @endforeach

                        </ul>
                    </li>
                    @endforeach

                </ul>
            </div>
        </div>
        <div class="ps-widget__block">
            <h4 class="ps-widget__title">By price</h4><a class="ps-block-control" href="#"><i class="fa fa-angle-down"></i></a>
            <div class="ps-widget__content">
                <!-- <div class="ps-widget__price">
                    <div id="slide-price"></div>
                </div> -->
                <form action="{{ route('filter-by-price') }}" method="post">
                    @csrf
                
                    <div class="ps-widget__input">
                        <input class="ps-price" id="slide-price-min" placeholder="Min" name="min_price">
                        <span class="bridge">-</span>
                        <input class="ps-price" id="slide-price-max" placeholder="Max" name="max_price">
                    </div>

                    <button type="submit" class="ps-widget__filter">Filter</button>

                </form>
            </div>
        </div>

<!--         <div class="ps-widget__block">
            <h4 class="ps-widget__title">Brands</h4><a class="ps-block-control" href="#"><i class="fa fa-angle-down"></i></a>
            <div class="ps-widget__content">


                @foreach($brands as $brand)
                <div class="ps-widget__item">
                    <div class="custom-control">
                        <a href=""><label class="custom-control-label" for="{{$brand->name}}" style="cursor: pointer;">{{$brand->name}}</label></a>
                    </div>
                </div>
                @endforeach

            </div>
        </div> -->

        <!-- <div class="ps-widget__promo"><img src="{{ asset('assets/frontend/') }}/img/banner-sidebar1.jpg" alt></div> -->
    </div>
</div>