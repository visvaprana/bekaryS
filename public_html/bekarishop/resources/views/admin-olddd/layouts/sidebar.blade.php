<?php

$admin_id = Session::get('adminId');

$admin = null;

if ($admin_id) {
    $admin = App\Models\Admin::find($admin_id);
}

?>


<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->


        <li class="nav-item{{ request()->is('admin/dashboard') ? 'menu-open' : '' }}">
            <a href="{{ route('dashboard') }}" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Dashboard
                </p>
            </a>
        </li>

        <li class="nav-item {{ request()->is('admin/config_cache') ? 'menu-open' : '' }}">
            <a href="{{ route('config_cache') }}" class="nav-link" onclick="localStorage.clear();">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Clear Cache
                </p>
            </a>
        </li>



        <li
            class="nav-item
          {{ request()->is('admin/order') ? 'menu-open' : '' }}
          {{ request()->is('admin/pending-order') ? 'menu-open' : '' }}
          {{ request()->is('admin/processing-order') ? 'menu-open' : '' }}
          {{ request()->is('admin/on-the-way-order') ? 'menu-open' : '' }}
          {{ request()->is('admin/delivered-order') ? 'menu-open' : '' }}
          {{ request()->is('admin/canceled-order') ? 'menu-open' : '' }}
      ">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                    Order
                    <i class="fas fa-angle-left right"></i>
                </p>
            </a>

            <ul class="nav nav-treeview">


                <li class="nav-item {{ request()->is('admin/order') ? 'active' : '' }}">
                    <a href="{{ URL::to('admin/order') }}"
                        class="nav-link {{ request()->is('admin/order') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>All Orders</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->is('admin/filter-by-category') ? 'active' : '' }}">
                    <a href="{{ URL::to('admin/filter-by-category') }}"
                        class="nav-link {{ request()->is('admin/filter-by-category') ? 'active' : '' }}">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Filter by category</p>
                    </a>
                </li>



                {{-- <li class="nav-item {{ request()->is('admin/pending-order') ? 'active' : '' }}">
            <a href="{{URL::to('admin/pending-order')}}" class="nav-link {{ request()->is('admin/pending-order') ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Pending</p>
            </a>
          </li>
           --}}
                {{-- <li class="nav-item {{ request()->is('admin/processing-order') ? 'active' : '' }}">
            <a href="{{URL::to('admin/processing-order')}}" class="nav-link {{ request()->is('admin/processing-order') ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Processing</p>
            </a>
          </li>
          
          <li class="nav-item {{ request()->is('admin/on-the-way-order') ? 'active' : '' }}">
            <a href="{{URL::to('admin/on-the-way-order')}}" class="nav-link {{ request()->is('admin/on-the-way-order') ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>On The Way</p>
            </a>
          </li>
          
          <li class="nav-item {{ request()->is('admin/delivered-order') ? 'active' : '' }}">
            <a href="{{URL::to('admin/delivered-order')}}" class="nav-link {{ request()->is('admin/delivered-order') ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Delivered</p>
            </a>
          </li>
          
          <li class="nav-item {{ request()->is('admin/canceled-order') ? 'active' : '' }}">
            <a href="{{URL::to('admin/canceled-order')}}" class="nav-link {{ request()->is('admin/canceled-order') ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Canceled</p>
            </a>
          </li> --}}



            </ul>

        </li>

        {{-- <li class="nav-item">
        <a href="{{URL::to('admin/contact-request')}}" class="nav-link {{ (request()->is('admin/contact-request')) ? 'active' : '' }}">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Contact Request
          </p>
        </a>
      </li>  --}}



        <!--<li class="nav-item">-->
        <!--  <a href="{{ URL::to('admin/booking') }}" class="nav-link ">-->
        <!--    <i class="nav-icon fas fa-th"></i>-->
        <!--    <p>-->
        <!--      Booking-->
        <!--    </p>-->
        <!--  </a>-->
        <!--</li>-->

        <li class="nav-item">
            <a href="{{ route('pos.index') }}" class="nav-link {{ request()->is('admin/pos') ? 'active' : '' }}">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    POS
                </p>
            </a>
        </li>


        @if ($admin->role_id == 1)
            <li class="nav-item">
                <a href="{{ route('category.index') }}"
                    class="nav-link {{ request()->is('admin/category') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Menu
                    </p>
                </a>
            </li>

            <li
                class="nav-item
      {{ request()->is('admin/product/create') ? 'menu-open' : '' }}
      {{ request()->is('admin/product') ? 'menu-open' : '' }}
        ">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-edit"></i>
                    <p>
                        Item
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>

                <ul class="nav nav-treeview">
                    <li class="nav-item {{ request()->is('admin/product/create') ? 'active' : '' }}">
                        <a href="{{ URL::to('admin/product/create') }}"
                            class="nav-link {{ request()->is('admin/product/create') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add</p>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('admin/product') ? 'active' : '' }}">
                        <a href="{{ URL::to('admin/product') }}"
                            class="nav-link {{ request()->is('admin/product') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Manage</p>
                        </a>
                    </li>
                </ul>

            </li>

            <li class="nav-item">
                <a href="{{ route('size.index') }}"
                    class="nav-link {{ request()->is('admin/size') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Size
                    </p>
                </a>
            </li>



            <li
                class="nav-item
        {{ request()->is('admin/country') ? 'menu-open' : '' }}
        {{ request()->is('admin/city') ? 'menu-open' : '' }}
        {{ request()->is('admin/area') ? 'menu-open' : '' }}
    ">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-edit"></i>
                    <p>
                        Area
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>

                <ul class="nav nav-treeview">

                    <li class="nav-item">
                        <a href="{{ route('country.index') }}"
                            class="nav-link {{ request()->is('admin/country') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Country
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('city.index') }}"
                            class="nav-link {{ request()->is('admin/city') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                City
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('area.index') }}"
                            class="nav-link {{ request()->is('admin/area') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Area
                            </p>
                        </a>
                    </li>


                </ul>

            </li>



            <li class="nav-item">
                <a href="{{ URL::to('admin/user') }}" class="nav-link ">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        User
                    </p>
                </a>
            </li>


            <li
                class="nav-item
    {{ request()->is('admin/payment_method/create') ? 'menu-open' : '' }}
    {{ request()->is('admin/payment_method') ? 'menu-open' : '' }}
">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-edit"></i>
                    <p>
                        Payment Method
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>

                <ul class="nav nav-treeview">
                    <li class="nav-item {{ request()->is('admin/payment_method/create') ? 'active' : '' }}">
                        <a href="{{ URL::to('admin/payment_method/create') }}"
                            class="nav-link {{ request()->is('admin/payment_method/create') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Add</p>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->is('admin/payment_method') ? 'active' : '' }}">
                        <a href="{{ URL::to('admin/payment_method') }}"
                            class="nav-link {{ request()->is('admin/payment_method') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Manage</p>
                        </a>
                    </li>
                </ul>

            </li>

            <li class="nav-item">
                <a href="{{ route('role.index') }}"
                    class="nav-link {{ request()->is('admin/role') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Role Manage
                    </p>
                </a>
            </li>

            <li
                class="nav-item
    {{ request()->is('admin/site-setting') ? 'menu-open' : '' }}
    {{ request()->is('admin/change-password') ? 'menu-open' : '' }}
    {{ request()->is('admin/pagecategory/create') ? 'menu-open' : '' }}
    {{ request()->is('admin/pagecategory') ? 'menu-open' : '' }}              
    {{ request()->is('admin/page/create') ? 'menu-open' : '' }}
    {{ request()->is('admin/page') ? 'menu-open' : '' }}        

">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-edit"></i>
                    <p>
                        Settings
                        <i class="fas fa-angle-left right"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">

                    <li
                        class="nav-item has-treeview
        {{ request()->is('admin/pagecategory/create') ? 'menu-open' : '' }}
        {{ request()->is('admin/pagecategory') ? 'menu-open' : '' }} 
        ">
                        <a href="" class="nav-link" style="margin-left: 21px;">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>
                                Page Category
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item {{ request()->is('admin/pagecategory/create') ? 'active' : '' }}">
                                <a href="{{ URL::to('admin/pagecategory/create') }}"
                                    class="nav-link {{ request()->is('admin/pagecategory/create') ? 'active' : '' }}"
                                    style="margin-left: 44px;">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Add Category</p>
                                </a>
                            </li>

                            <li class="nav-item {{ request()->is('admin/pagecategory') ? 'active' : '' }}">
                                <a href="{{ URL::to('admin/pagecategory') }}"
                                    class="nav-link {{ request()->is('admin/pagecategory') ? 'active' : '' }}"
                                    style="margin-left: 44px;">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Manage Category</p>
                                </a>
                            </li>
                        </ul>
                    </li>


                    {{-- <li class="nav-item has-treeview
        {{ request()->is('admin/page/create') ? 'menu-open' : '' }}
        {{ request()->is('admin/page') ? 'menu-open' : '' }} 
        ">
          <a href="" class="nav-link" style="margin-left: 21px;">
            <i class="nav-icon fas fa-cog"></i>
            <p>
              Page
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item {{ request()->is('admin/page/create') ? 'active' : '' }}">
              <a href="{{URL::to('admin/page/create')}}" class="nav-link {{ request()->is('admin/page/create') ? 'active' : '' }}"  style="margin-left: 44px;">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Page</p>
              </a>
            </li>                   

            <li class="nav-item {{ request()->is('admin/page') ? 'active' : '' }}">
              <a href="{{URL::to('admin/page')}}" class="nav-link {{ request()->is('admin/page') ? 'active' : '' }}"  style="margin-left: 44px;">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage Page</p>
              </a>
            </li>              
          </ul>
        </li>  --}}



                    <li class="nav-item mb-5">
                        <a href="{{ route('site-setting') }}"
                            class="nav-link {{ request()->is('admin/site-setting') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Website Setting</p>
                        </a>
                    </li>
                </ul>
            </li>




            <li class="nav-item">
                <a href="{{ route('change-password') }}"
                    class="nav-link {{ request()->is('admin/change-password') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-file"></i>
                    <p>Change Password</p>
                </a>
            </li>
        @endif













        {{-- 
      <li class="nav-item">
        <a href="{{route('banner.index')}}" class="nav-link {{ (request()->is('admin/banner')) ? 'active' : '' }}">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Banner
          </p>
        </a>
      </li> --}}

        <!--       <li class="nav-item">
        <a href="{{ route('brand.index') }}" class="nav-link {{ request()->is('admin/brand') ? 'active' : '' }}">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Brand
          </p>
        </a>
      </li> -->

        {{-- <li class="nav-item
          {{ request()->is('admin/service/create') ? 'menu-open' : '' }}
          {{ request()->is('admin/service') ? 'menu-open' : '' }}
      ">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-edit"></i>
          <p>
            Facilities
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>

        <ul class="nav nav-treeview">
          <li class="nav-item {{ request()->is('admin/service/create') ? 'active' : '' }}">
            <a href="{{URL::to('admin/service/create')}}" class="nav-link {{ request()->is('admin/service/create') ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Add</p>
            </a>
          </li>
          <li class="nav-item {{ request()->is('admin/service') ? 'active' : '' }}">
            <a href="{{URL::to('admin/service')}}" class="nav-link {{ request()->is('admin/service') ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Manage</p>
            </a>
          </li>
        </ul>

      </li>  --}}


        <!--       <li class="nav-item">
        <a href="{{ route('color.index') }}" class="nav-link {{ request()->is('admin/color') ? 'active' : '' }}">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Color
          </p>
        </a>
      </li> -->



        <!--       <li class="nav-item">
        <a href="{{ route('unit.index') }}" class="nav-link {{ request()->is('admin/unit') ? 'active' : '' }}">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Unit
          </p>
        </a>
      </li> -->

        {{-- <li class="nav-item">
        <a href="{{route('attribute.index')}}" class="nav-link {{ (request()->is('admin/attribute')) ? 'active' : '' }}">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Attribute
          </p>
        </a>
      </li> --}}

        {{-- <li class="nav-item">
        <a href="{{route('attribute_value.index')}}" class="nav-link {{ (request()->is('admin/attribute_value')) ? 'active' : '' }}">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Attribute Value
          </p>
        </a>
      </li> --}}


















        <!--        <li class="nav-item
          {{ request()->is('admin/resturant/create') ? 'menu-open' : '' }}
          {{ request()->is('admin/resturant') ? 'menu-open' : '' }}
          {{ request()->is('admin/item') ? 'menu-open' : '' }}
          {{ request()->is('admin/item_package') ? 'menu-open' : '' }}
      ">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-edit"></i>
          <p>
            Resturant
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>

        <ul class="nav nav-treeview">

          <li class="nav-item {{ request()->is('admin/resturant/create') ? 'active' : '' }}">
            <a href="{{ URL::to('admin/resturant/create') }}" class="nav-link {{ request()->is('admin/resturant/create') ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Add</p>
            </a>
          </li>

          <li class="nav-item {{ request()->is('admin/resturant') ? 'active' : '' }}">
            <a href="{{ URL::to('admin/resturant') }}" class="nav-link {{ request()->is('admin/resturant') ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Manage</p>
            </a>
          </li>

          <li class="nav-item {{ request()->is('admin/item') ? 'active' : '' }}">
            <a href="{{ URL::to('admin/item') }}" class="nav-link {{ request()->is('admin/item') ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Resturant Item</p>
            </a>
          </li>

          <li class="nav-item {{ request()->is('admin/item_package') ? 'active' : '' }}">
            <a href="{{ URL::to('admin/item_package') }}" class="nav-link {{ request()->is('admin/item_package') ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p> Item Package & Rate </p>
            </a>
          </li>

        </ul>

      </li>  -->

        {{-- <li class="nav-item">
        <a href="{{route('coupon.index')}}" class="nav-link {{ (request()->is('admin/coupon')) ? 'active' : '' }}">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Coupon
          </p>
        </a>
      </li> --}}




        {{-- <li class="nav-item">
        <a href="{{URL::to('admin/employee')}}" class="nav-link ">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Employee
          </p>
        </a>
      </li>


      <li class="nav-item">
        <a href="{{URL::to('admin/employee/create')}}" class="nav-link ">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Employee Add
          </p>
        </a>
      </li> --}}


        {{-- <li class="nav-item">
        <a href="{{route('gallery.index')}}" class="nav-link {{ (request()->is('admin/gallery')) ? 'active' : '' }}">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Gallery 
          </p>
        </a>
      </li> --}}



        <!--<li class="nav-item-->
      <!--    {{ request()->is('admin/marquee/create') ? 'menu-open' : '' }}-->
      <!--    {{ request()->is('admin/marquee') ? 'menu-open' : '' }}-->
      <!--">-->
        <!--  <a href="#" class="nav-link">-->
        <!--    <i class="nav-icon fas fa-edit"></i>-->
        <!--    <p>-->
        <!--      Marquee -->
        <!--      <i class="fas fa-angle-left right"></i>-->
        <!--    </p>-->
        <!--  </a>-->

        <!--  <ul class="nav nav-treeview">-->
        <!--    <li class="nav-item {{ request()->is('admin/marquee/create') ? 'active' : '' }}">-->
        <!--      <a href="{{ URL::to('admin/marquee/create') }}" class="nav-link {{ request()->is('admin/marquee/create') ? 'active' : '' }}">-->
        <!--        <i class="far fa-circle nav-icon"></i>-->
        <!--        <p>Add</p>-->
        <!--      </a>-->
        <!--    </li>-->
        <!--    <li class="nav-item {{ request()->is('admin/marquee') ? 'active' : '' }}">-->
        <!--      <a href="{{ URL::to('admin/marquee') }}" class="nav-link {{ request()->is('admin/marquee') ? 'active' : '' }}">-->
        <!--        <i class="far fa-circle nav-icon"></i>-->
        <!--        <p>Manage</p>-->
        <!--      </a>-->
        <!--    </li>-->
        <!--  </ul>-->

        <!--</li>-->





        {{-- <li class="nav-item
          {{ request()->is('admin/post/create') ? 'menu-open' : '' }}
          {{ request()->is('admin/post') ? 'menu-open' : '' }}
      ">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-edit"></i>
          <p>
            Post
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>

        <ul class="nav nav-treeview">
          <li class="nav-item {{ request()->is('admin/post/create') ? 'active' : '' }}">
            <a href="{{URL::to('admin/post/create')}}" class="nav-link {{ request()->is('admin/post/create') ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Add</p>
            </a>
          </li>
          <li class="nav-item {{ request()->is('admin/post') ? 'active' : '' }}">
            <a href="{{URL::to('admin/post')}}" class="nav-link {{ request()->is('admin/post') ? 'active' : '' }}">
              <i class="far fa-circle nav-icon"></i>
              <p>Manage</p>
            </a>
          </li>
        </ul>

      </li> --}}


        {{-- <li class="nav-item">
        <a href="{{route('partner.index')}}" class="nav-link {{ (request()->is('admin/partner')) ? 'active' : '' }}">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Partner
          </p>
        </a>
      </li> --}}




        {{-- <li class="nav-item">
        <a href="{{route('subscription.index')}}" class="nav-link {{ (request()->is('admin/subscription')) ? 'active' : '' }}">
          <i class="nav-icon fas fa-th"></i>
          <p>
            Subscription
          </p>
        </a>
      </li> --}}



    </ul>
</nav>
