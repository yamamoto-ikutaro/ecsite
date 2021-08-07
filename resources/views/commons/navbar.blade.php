<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="/">Company logo</a>
  
    <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
      <ul class="navbar-nav mr-auto mt-2 mt-md-0"></ul>
      <ul class="navbar-nav">
        @if(Auth::check())
          @if(Auth::user()->role == 'admin')
          <div>
            <li class="nav-item pt-2 inline-block">
              <i class="fa fa-info-circle" aria-hidden="true"></i>
            </li>
            <li class="nav-item pr-2 inline-block">
              {!! link_to_route('add_product_screen', '商品の追加', [], ['class'=>'nav-link pl-0']) !!}
            </li>
          </div>
          <div>
            <li class="nav-item pt-2 inline-block">
              <i class="fas fa-dollar-sign"></i>
            </li>
            <li class="nav-item pr-2 inline-block">
              {!! link_to_route('admin_orderInfo', '注文情報', [], ['class' => 'nav-link pl-0']) !!}
            </li>
          </div>
          @endif
          <div>
            <li class="nav-item pt-2 inline-block">
              <i class="fa fa-user" aria-hidden="true"></i>
            </li>
            <li class="nav-item pr-2 inline-block" id="register">
              {!! link_to_route('user.show', '登録情報', ['id'=>Auth::id()], ['class'=>'nav-link nav-link pl-0']) !!}
            </li>
          </div>
          <div>
            <li class="nav-item pt-2 inline-block">
              <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            </li>
            <li class="nav-item inline-block">
              {!! link_to_route('cart.index', 'カート', [], ['class'=>'nav-link pr-0 pl-0']) !!}
            </li>
          @if(Auth::user()->cart()->count() > 0)
            <li class="inline-block">
              <span class="badge badge-info">{{ Auth::user()->cart()->count() }}</span>
            </li>
          @endif
          </div>
          <div>
            <li class="nav-item pt-2 inline-block last-child">
              <i class="fa fa-globe" aria-hidden="true"></i>
            </li>
            <li class="nav-item inline-block">
              {!! link_to_route('logout.get', 'ログアウト', [], ['class'=>'nav-link pl-0']) !!}
            </li>
          </div>
          @else
          <div>
            <li class="nav-item pt-2 inline-block">
              <i class="fa fa-user" aria-hidden="true"></i>
            </li>
            <li class="nav-item inline-block">
              {!! link_to_route('signup.get', '会員登録', [], ['class'=>'nav-link pl-0 pr-3']) !!}
            </li>
          </div>
          <div>
            <li class="nav-item pt-2 inline-block">
              <i class="fa fa-globe" aria-hidden="true"></i>
            </li>
            <li class="nav-item inline-block">
              {!! link_to_route('login', 'ログイン', [], ['class'=>'nav-link pl-0']) !!}
            </li>
          </div>
        @endif
      </ul>
    </div>
  </nav>
</header>