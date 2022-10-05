<div class="user-panel-header">
    <div class="container">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="user-face">
                    <div class="part-left">

                        <div class="part-name">
                            <span class="welcome-text">Bem Vindo</span>
                            <span class="user-name-text">@if(Auth::check()) {{auth()->user()->nome}} @endif</span>
                        </div>
                    </div>
                    <div class="part-right">
                        <ul>
                            <li>
                                <a href="{{route('dashboard.perfil.editar')}}" class=" @if (\Request::route()->getName() == "dashboard.perfil.editar") active @endif">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fal" data-icon="pen-nib" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-pen-nib fa-w-16 fa-fw fa-2x"><path fill="currentColor" d="M493.87 95.6L416.4 18.13C404.32 6.04 388.48 0 372.64 0c-15.84 0-31.68 6.04-43.76 18.13l-92.45 92.45-99.83 28.21a64.003 64.003 0 0 0-43.31 41.35L0 460l52 52 279.86-93.29a64.003 64.003 0 0 0 41.35-43.31l28.21-99.83 92.45-92.45c24.17-24.17 24.17-63.35 0-87.52zM342.42 366.7a31.985 31.985 0 0 1-20.68 21.66l-261.1 87.03-.7-.7L175.7 358.93c9.52 5.62 20.47 9.07 32.3 9.07 35.28 0 64-28.7 64-64s-28.72-64-64-64-64 28.7-64 64c0 11.83 3.45 22.79 9.07 32.31L37.32 452.06l-.71-.7 87.03-261.1a31.986 31.986 0 0 1 21.66-20.68l99.83-28.21 1.25-.36 124.6 124.6-.35 1.25-28.21 99.84zM176 304c0-17.64 14.34-32 32-32s32 14.36 32 32-14.34 32-32 32-32-14.36-32-32zm295.25-143.51l-80.06 80.06-119.75-119.73 80.07-80.06c11.67-11.67 30.58-11.69 42.27 0l77.47 77.47c11.65 11.65 11.65 30.61 0 42.26z" class=""></path></svg>
                                    <span class="text">Conta</span>
                                </a>
                            </li>
                            @if (auth()->user()->permission == 2)
                            <li>
                                <a href="{{route('admin.home')}}">
                                    <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="sign-out" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-sign-out fa-w-16 fa-fw fa-2x"><path fill="currentColor" d="M96 64h84c6.6 0 12 5.4 12 12v24c0 6.6-5.4 12-12 12H96c-26.5 0-48 21.5-48 48v192c0 26.5 21.5 48 48 48h84c6.6 0 12 5.4 12 12v24c0 6.6-5.4 12-12 12H96c-53 0-96-43-96-96V160c0-53 43-96 96-96zm231.1 19.5l-19.6 19.6c-4.8 4.8-4.7 12.5.2 17.1L420.8 230H172c-6.6 0-12 5.4-12 12v28c0 6.6 5.4 12 12 12h248.8L307.7 391.7c-4.8 4.7-4.9 12.4-.2 17.1l19.6 19.6c4.7 4.7 12.3 4.7 17 0l164.4-164c4.7-4.7 4.7-12.3 0-17l-164.4-164c-4.7-4.6-12.3-4.6-17 .1z" class=""></path></svg>
                                    <span class="text">Admin</span>
                                </a>
                            </li>
                            @endif
                            <li>
                                <a href="{{route('login.logout')}}">
                                    <svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="sign-out" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="svg-inline--fa fa-sign-out fa-w-16 fa-fw fa-2x"><path fill="currentColor" d="M96 64h84c6.6 0 12 5.4 12 12v24c0 6.6-5.4 12-12 12H96c-26.5 0-48 21.5-48 48v192c0 26.5 21.5 48 48 48h84c6.6 0 12 5.4 12 12v24c0 6.6-5.4 12-12 12H96c-53 0-96-43-96-96V160c0-53 43-96 96-96zm231.1 19.5l-19.6 19.6c-4.8 4.8-4.7 12.5.2 17.1L420.8 230H172c-6.6 0-12 5.4-12 12v28c0 6.6 5.4 12 12 12h248.8L307.7 391.7c-4.8 4.7-4.9 12.4-.2 17.1l19.6 19.6c4.7 4.7 12.3 4.7 17 0l164.4-164c4.7-4.7 4.7-12.3 0-17l-164.4-164c-4.7-4.6-12.3-4.6-17 .1z" class=""></path></svg>
                                    <span class="text">Sair</span>
                                </a>
                            </li>
                        </ul>
                        <br>
                        <ul>

                        <li>
                            <a href="{{route('dashboard')}}" class="menu-item @if (\Request::route()->getName() == "dashboard") active @endif">
                                Painel
                            </a>
                        </li>
                        <li>
                            <a href="{{route('dashboard.apostas')}}" class="menu-item @if (\Request::route()->getName() == "dashboard.apostas") active @endif">
                                Apostas
                            </a>
                        </li>
                        <li>
                            <a href="{{route('dashboard.depositos.historico')}}" class="menu-item @if (\Request::route()->getName() == "dashboard.depositos.historico") active @endif">
                                Depósitos
                            </a>
                        </li>
                        {{--<li>
                            <a href="bonus.php" class="menu-item">
                                Bônus de Indicações
                            </a>
                        </li>--}}

                        <li>
                            <a href="{{route('dashboard.saques')}}" class="menu-item ">
                                Saques
                            </a>
                        </li>
                    </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
