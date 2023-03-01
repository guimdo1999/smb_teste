<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/fomantic-ui@2.9.2/dist/semantic.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fomantic-ui@2.9.2/dist/semantic.min.js"></script>
    <title>Lista de Cadastros</title>
</head>

<body>
    <div class="container">
        <h1>Lista de Cadastros</h1>

        <form action="lista" method="get">
            <input class="form-control" type="text" name="nome" />
            <input class="form-control" type="date" name="data_ini" />
            <input class="form-control" type="date" name="data_fim" />
            <input type="submit" class="form-control" class="btn btn-default" value="Buscar" />
            <button class="ui icon button">
                <i class="cloud icon"></i>
            </button>
        </form>
        <a href="<?= base_url('cadastrar') ?>" class="btn btn-primary">Novo Cadastro</a><br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Telefone</th>
                    <th>Data de Nascimento</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php
                function maskTel($telefone)
                {
                    $telefoneFormatado = preg_replace('/[^0-9]/', '', $telefone);
                    $combina = [];
                    preg_match('/^([0-9]{2})([0-9]{4,5})([0-9]{4})$/', $telefoneFormatado, $combina);
                    if ($combina) {
                        return '(' . $combina[1] . ') ' . $combina[2] . '-' . $combina[3];
                    }

                    return $telefone;
                }
                ?>
                <?php foreach ($lista_cadastros as $key_cadastro => $cadastro) { ?>
                    <tr>
                        <td><?= $cadastro->nome ?></td>
                        <td><?= $cadastro->email ?></td>
                        <td><?= maskTel($cadastro->telefone) ?></td>
                        <td><?= date("d/m/Y", strtotime($cadastro->data_nasc)) ?></td>
                        <td>
                            <a href="<?= base_url("editar/{$cadastro->id_cad}") ?>" class="btn btn-primary">Editar</a>
                            <a href="<?= base_url("excluir/{$cadastro->id_cad}") ?>" class="btn btn-danger btn-excluir">X</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>
<script>
    $(function() {
        $('.btn-excluir').click(function(e) {
            e.preventDefault();
            if (confirm("Tem certeza que deseja excluir esse registro?")) {
                const href = $(this).attr('href');
                window.location.href = href;
            }
        })
    })
</script>

</html>