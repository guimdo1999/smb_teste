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

    const datePicker = document.getElementById('datePicker');
    datePicker.addEventListener('keypress', (e) => maskDate(e.target.value));

    const maskDate = (val) => {
        val = val.replace(/\D/g, "");
        val = val.replace(/^(\d{2})(\d)/g, "$1/$2");
        val = val.replace(/(\d)(\d{3})$/, "$1/$2");

        datePicker.value = val;
    }