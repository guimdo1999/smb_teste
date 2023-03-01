<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/fomantic-ui@2.9.2/dist/semantic.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fomantic-ui@2.9.2/dist/semantic.min.js"></script>
    <title><?= uri_string() === 'cadastrar' ? "Cadastro" : "Editar" ?></title>
</head>

<body>
    <?php
    $nome = isset($_POST['nome']) ?  $_POST['nome'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : "";
    $data_nasc = isset($_POST['data_nasc']) ? $_POST['data_nasc'] : "";
    ?>
    <div class="container">
        <div class="row">
            <div class="col-6 offset-3">
                <?php echo validation_errors() ?>
                <?= $this->session->flashdata('cadastro-movimentacao') ?>
                <h1><?= uri_string() === 'cadastrar' ? "Cadastro" : "Editar" ?></h1>
                <form action="<?= uri_string() === 'cadastrar' ? "cadastrar" : base_url("editar/{$cadastro->id_cad}") ?>" method="post">
                    <div class="form-group">
                        <label>Nome</label>
                        <input class="form-control" type="text" name="nome" value="<?= uri_string() === 'cadastrar' ? $nome : $cadastro->nome ?>" />
                    </div>
                    <div class="form-group">
                        <label>Telefone</label>
                        <input class="form-control" id="telefone" name="telefone" maxlength="15" pattern="\(\d{2}\)\s*\d{4,5}-\d{4}" value="<?= uri_string() === 'cadastrar' ? $telefone : $cadastro->telefone ?>">
                    </div>
                    <div class="form-group">
                        <label>E-mail</label>
                        <input class="form-control" type="email" name="email" value="<?= uri_string() === 'cadastrar' ? $email : $cadastro->email ?>" />

                    </div>
                    <div class="form-group">
                        <label>Data de Nascimento</label>
                        <div class="ui calendar datepick" id="calendar_fim">
                            <div class="ui fluid input left icon">
                                <i class="calendar icon"></i>
                                <input class="form-control" type="text" name="data_nasc" placeholder="Data" value="<?= uri_string() === 'cadastrar' ? $data_nasc : $cadastro->data_nasc ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="form-control" class="btn btn-default" nome="enviar" value="Enviar" />
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

<script>
    $('.datepick')
        .calendar({
            type: "date",
            monthFirst: false,
            formatter: {
                date: 'DD/MM/Y'
            },
            text: {
                days: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
                dayNamesShort: ['Dom', 'Seg', 'Terça', 'Qua', 'Qui', 'Sexta', 'Sáb'],
                dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
                months: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                today: 'Hoje',
                now: 'Agora',
                am: 'AM',
                pm: 'PM',
                weekNo: 'Semana'
            }
        });

    const telefone = document.getElementById('telefone');

    telefone.addEventListener('keypress', (e) => maskTel(e.target.value));
    telefone.addEventListener('click', (e) => maskTel(e.target.value));
    telefone.addEventListener('change', (e) => maskTel(e.target.value));

    const maskTel = (val) => {
        val = val.replace(/\D/g, "");
        val = val.replace(/^(\d{2})(\d)/g, "($1) $2");
        val = val.replace(/(\d)(\d{4})$/, "$1-$2");
        telefone.value = val;
    }
</script>

</html>