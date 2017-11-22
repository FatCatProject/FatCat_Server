<!-- left side start-->
<div class="left-side sticky-left-side">

    <!--logo and iconic logo start-->
    <div class="logo">
        <h1><a href="/homePage">Fat&nbsp;&nbsp;<span class="lnr lnr-paw"> Cat</span></a></h1>
    </div>
    <div class="logo-icon text-center">
        <a href="/homePage"><i class="lnr lnr-home"></i></a>
    </div>

    <!--logo and iconic logo end-->
    <div class="left-side-inner">

        <!--sidebar nav start-->
        <ul class="nav nav-pills nav-stacked custom-nav">

            <li id="first_menu_li"
                class="menu-list {!! (Request::is('userPage') or Request::is('cardsPage') or Request::is('foodProductsPage')) ? 'act' : ''!!}"
            ><a href="#"><i class="lnr lnr-cog"></i>
                    <span>Settings</span></a>
                <ul class="sub-menu-list">
                    <li><a href="/userPage">User</a></li>
                    <li><a href="/cardsPage">Cards</a></li>
                    <li><a href="/foodProductsPage">Food products</a></li>
                </ul>
            </li>
            <li id="second_menu_li"
                class="{!! (Request::is('boxManagePage')) ? 'act' : ''!!}"
            ><a href="/boxManagePage"><i class="lnr lnr-inbox"></i><span>Food boxes</span></a></li>
            {{--<li class="active"><a href="/boxManagePage"><i class="lnr"></i><img src="/images/box_white.png" width="19px"><span>Food boxes</span></a></li>--}}
            {{--<li class="box or active"><a href="/boxManagePage"><i class="lnr"></i><img src="/images/box_green.png" width="19px"><span>Food boxes</span></a></li>--}}
            <li id="third_menu_li"
                class="menu-list {!! (Request::is('addCat') or Request::is('catPage/*')) ? 'act' : '' !!}"
            ><a href="#"><i class="lnr lnr-paw"></i>
                    <span>Cats Manager</span></a>
                <ul class="sub-menu-list">
                    <li><a href="/addCat">Manage cats</a></li>
                    @if(!empty($mycats))
                    @foreach($mycats as $cat)
                    <li><a href="/catPage/{!! $cat->id !!}">{!! $cat->cat_name !!}</a></li>
                    @endforeach
                    @endif
                </ul>
            </li>
            <li id="fourth_menu_li"
                class="menu-list {!! (Request::is('catVetPage/*')) ? 'act' : '' !!}"
            ><a href="#"><i class="lnr lnr-heart-pulse"></i>
                    <span>Vet logs</span></a>
                <ul class="sub-menu-list">
                    @if(!empty($mycats))
                    @foreach($mycats as $cat)
                        <li><a href="/catVetPage/{!! $cat->id !!}">{!! $cat->cat_name !!}</a></li>
                    @endforeach
                    @endif
                </ul>
            </li>
            <li id="fifth_menu_li"
                class="menu-list {!! (Request::is('shoppingPage') or Request::is('shopsPage')) ? 'act' : '' !!}"
            ><a href="#"><i class="lnr lnr-cart"></i>
                    <span>Shopping</span></a>
                <ul class="sub-menu-list">
                    <li><a href="/shoppingPage">Shopping list</a></li>
                    <li><a href="/shopsPage">Favorite shops & products</a></li>
                </ul>
            </li>
            {{--<li><a href="./shoppingPage"><i class="lnr lnr-cart"></i><span>Shopping list</span></a></li>--}}
        </ul>
            <!--sidebar nav end-->
    </div>
</div>
<!-- left side end-->
