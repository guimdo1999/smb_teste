$(".datepick").calendar({
	type: "date",
	monthFirst: false,
	formatter: {
		date: "DD/MM/Y",
	},
	text: {
		days: ["D", "S", "T", "Q", "Q", "S", "S"],
		dayNamesShort: ["Dom", "Seg", "Terça", "Qua", "Qui", "Sexta", "Sáb"],
		dayNames: [
			"Domingo",
			"Segunda",
			"Terça",
			"Quarta",
			"Quinta",
			"Sexta",
			"Sábado",
		],
		months: [
			"Janeiro",
			"Fevereiro",
			"Março",
			"Abril",
			"Maio",
			"Junho",
			"Julho",
			"Agosto",
			"Setembro",
			"Outubro",
			"Novembro",
			"Dezembro",
		],
		monthsShort: [
			"Jan",
			"Fev",
			"Mar",
			"Abr",
			"Mai",
			"Jun",
			"Jul",
			"Ago",
			"Set",
			"Out",
			"Nov",
			"Dez",
		],
		today: "Hoje",
		now: "Agora",
		am: "AM",
		pm: "PM",
		weekNo: "Semana",
	},
});
$(function () {
	$(".btn-excluir").click(function (e) {
		e.preventDefault();
		if (confirm("Tem certeza que deseja excluir esse registro?")) {
			const href = $(this).attr("href");
			window.location.href = href;
		}
	});
});

//lidando com tamanhos de tela a partir de tablet
if (window.screen.width > 768) {
	$(".table").removeClass("very long").addClass("long");
} else {
	$(".table").removeClass("long").addClass("very long");
}
$(window).resize(function () {
	if (window.screen.width > 768) {
		$(".table").removeClass("very long").addClass("long");
	} else {
		$(".table").removeClass("long").addClass("very long");
	}
});
