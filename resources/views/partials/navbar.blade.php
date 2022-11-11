<nav class="navbar navbar-dark bg-black">
    <div class="container-fluid">
        <a class="navbar-brand fs-4 fw-bolder m-auto" href="#">Brogangin</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="offcanvas offcanvas-end text-dark" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
              <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
              <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle text-dark" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    League
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
                    @foreach ($leagueList as $item)
                    <li class="my-1" style="">
                        <a class="dropdown-item" href="/scores/{{ $item['url'] }}">
                          <div class="row align-items-center" style="height: 30px">
                          <div class="col-2">
                            <div class="text-center"><img class="" src="https://media.api-sports.io/football/leagues/{{ $item['id'] }}.png" alt="" style="max-height: 30px; max-width: 30px;"></div>
                          </div>
                          <div class="col" style="margin-left: -0.5rem;"><div class="small" >{{ $item['name'] }}</div></div>
                          </div>
                        </a>
                    </li>
                    @endforeach
                  </ul>
                </li>
              </ul>
            </div>
          </div>
    </div>
</nav>