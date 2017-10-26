<!-- left side start-->
<div class="left-side sticky-left-side">

    <!--logo and iconic logo start-->
    <div class="logo">
        <h1><a href="index.html">Fat <span>Cat</span></a></h1>
    </div>
    <div class="logo-icon text-center">
        <a href="/homePage"><i class="lnr lnr-home"></i></a>
    </div>

    <!--logo and iconic logo end-->
    <div class="left-side-inner">

        <!--sidebar nav start-->
        <ul class="nav nav-pills nav-stacked custom-nav">
            <li class="active"><a href="#"><i class="lnr lnr-user"></i><span>User Information</span></a></li>
            <li class="menu-list">
                <a href="#"><i class="lnr lnr-cog"></i>
                    <span>Manage Boxes</span></a>
                <ul class="sub-menu-list">
                    <li><a href="some.html">CatA` Box</a></li>
                    <li><a href="some.html">CatB` Box</a></li>
                    <li><a href="some.html">CatC` Box</a></li>
                </ul>
            </li>
            <li class="menu-list"><a href="#"><i class="lnr lnr-paw"></i>
                    <span>Cats Manager</span></a>
                <ul class="sub-menu-list">
                    <li><a href="/addCat">Manage cats</a></li>
                    @foreach($mycats as $cat)
                    <li><a href="/catPage/{!! $cat->id !!}">{!! $cat->cat_name !!}</a></li>
                    @endforeach
                </ul>
            </li>
            <li class="menu-list"><a href="#"><i class="lnr lnr-heart-pulse"></i>
                    <span>Vet logs</span></a>
                <ul class="sub-menu-list">
                    @foreach($mycats as $cat)
                        <li><a href="/catVetPage/{!! $cat->id !!}">{!! $cat->cat_name !!}</a></li>
                    @endforeach
                    <li><a href="/catVetPage">Cat A</a></li>
                    <li><a href="/catVetPage">Cat B</a></li>
                    <li><a href="/catVetPage">Cat C</a></li>
                </ul>
            </li>
            <li class="menu-list"><a href="#"><i class="lnr lnr-cart"></i>
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