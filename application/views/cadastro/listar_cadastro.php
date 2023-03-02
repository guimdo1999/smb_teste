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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.css">

    <title>Lista de Cadastros</title>
</head>
<body>
    <div class="container">
        <form action="lista" method="get">
            <div class="row justify-content-between">
                <div class="col">
                    <h1 class="titulo">Cadastrados</h1>
                </div>
                <div class="col-sm-3">
                    <a class="ui icon button primary form-control" href="<?= base_url('cadastrar') ?>">Novo Cadastro</a>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-end">
                        <div class="col-md-4">
                            <h3>Quer encontrar alguém? Procure a seguir: </h3>
                        </div>
                        <div class="col-md-2 ">
                            <div class="ui input">
                                <input class="form-control" type="text" name="nome" placeholder="Busque um nome" value="<?= set_value('nome') ?>">
                            </div>
                        </div>
                        <div class="col-md-2 ">
                            <div class="ui calendar datepick" id="calendar_ini">
                                <div class="ui input left icon">
                                    <i class="calendar icon"></i>
                                    <input id="datePic" type="text" class="form-control" name="data_ini" maxlength="10" value="<?= set_value('data_ini') ?>" placeholder="Data inicial">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 ">
                            <div class="ui calendar datepick" id="calendar_fim">
                                <div class="ui input left icon">
                                    <i class="calendar icon"></i>
                                    <input id="datePick" type="text" class="form-control" name="data_fim" maxlength="10" value="<?= set_value('data_fim') ?>" placeholder="Data final">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button class="ui icon button secundary form-control" type="submit">
                                <i class="search icon"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="row">
            <div class="col">
                <table class="ui stackable scrolling single line fixed table terciary long">
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
                        <?php foreach ($lista_cadastros as $key_cadastro => $cadastro) { ?>
                            <tr>
                                <td><?= $cadastro->nome ?></td>
                                <td><?= $cadastro->email ?></td>
                                <td><?= $cadastro->telefone ?></td>
                                <td><?= $cadastro->data_nasc ?></td>
                                <td>
                                    <a href="<?= base_url("editar/{$cadastro->id_cad}") ?>" class="btn primary">Editar</a>
                                    <a href="<?= base_url("excluir/{$cadastro->id_cad}") ?>" class="btn btn-danger btn-excluir">X</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
<script type='text/javascript' src ="<?php echo base_url(); ?>assets/js/listar_cadastro.js"></script>
</html>