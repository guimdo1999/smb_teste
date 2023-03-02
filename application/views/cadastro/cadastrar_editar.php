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
    <title><?= uri_string() === 'cadastrar' ? "Cadastro" : "Editar" ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/style.css">
</head>
<body>

    <div class="container">
        <div class="card">
            <div class="card-body">
                <?= $this->session->flashdata('cadastro-movimentacao') ?>
                <h1><?= uri_string() === 'cadastrar' ? "Cadastro" : "Editar" ?></h1>
                <form action="<?= uri_string() === 'cadastrar' ? "cadastrar" : base_url("editar/{$cadastro->id_cad}") ?>" method="post">
                    <div class="form-group">
                        <label>Nome</label>
                        <input class="form-control" type="text" placeholder="Nome e sobrenome" name="nome" value="<?= uri_string() === 'cadastrar' ? set_value('nome') : $cadastro->nome ?>" />
                        <span class="danger"><?= form_error('nome') ?></span>
                    </div>
                    <div class="form-group">
                        <label>Telefone</label>
                        <input class="form-control" id="telefone" name="telefone" placeholder="(__) _____-____" maxlength="15" pattern="\(\d{2}\)\s*\d{4,5}-\d{4}" value="<?= uri_string() === 'cadastrar' ? set_value('telefone') : $cadastro->telefone ?>">
                        <span class="danger"><?= form_error('telefone') ?></span>

                    </div>
                    <div class="form-group">
                        <label>E-mail</label>
                        <input class="form-control" type="email" name="email" placeholder="seu.email@gmail.com" value="<?= uri_string() === 'cadastrar' ? set_value('email') : $cadastro->email ?>" />
                        <span class="danger"><?= form_error('email') ?></span>

                    </div>
                    <div class="form-group">
                        <label>Data de Nascimento</label>
                        <div class="ui calendar datepick" id="calendar">
                            <div class="ui fluid input left icon">
                                <i class="calendar icon"></i>
                                <input id="datePicker" class="form-control" type="text" name="data_nasc" maxlength="10" placeholder="10/10/1999" value="<?= uri_string() === 'cadastrar' ? set_value('data_nasc') : $cadastro->data_nasc ?>">
                            </div>
                        </div>
                        <span class="danger"><?= form_error('data_nasc') ?></span>

                    </div>
                    <div class="form-group">
                        <input type="submit" class="ui icon button primary form-control" nome="<?= uri_string() === 'cadastrar' ? "Enviar" : "Atualizar" ?>" />
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
<script type='text/javascript' src ="<?php echo base_url(); ?>assets/js/cadastrar_editar.js"></script>

</html>