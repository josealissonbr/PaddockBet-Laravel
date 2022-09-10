<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="#">Painel Administrador</a>
    </li>
    <li class="breadcrumb-item active">
        @php
            if (\Request::route()->getName() == 'admin.home')
                echo "Dashboard";
            elseif (\Request::route()->getName() == 'admin.eventos')
                echo "Lista de Eventos";
            elseif (\Request::route()->getName() == 'admin.eventos.novo')
                echo "Novo Evento";
            elseif (\Request::route()->getName() == 'admin.provas')
                echo "Lista de Provas";
            elseif (\Request::route()->getName() == 'admin.provas.novo')
                echo "Nova Prova";
            elseif (\Request::route()->getName() == 'admin.usuarios')
                echo "Lista de Usuários";
            elseif (\Request::route()->getName() == 'admin.usuarios.novo')
                echo "Novo Usuário";
            elseif (\Request::route()->getName() == 'admin.transacoes')
                echo "Transacões";


        @endphp
    </li>
</ol>
