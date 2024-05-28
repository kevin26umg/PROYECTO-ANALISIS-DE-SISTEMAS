$(document).ready(function(){
	$(".btn-exit-system").on("click", function(e){
		e.preventDefault();
		var urlDir=$(this).attr("href");
		
// 		swal({
// 		  title: '¿Estás seguro?',
// 		  text: "Quieres salir del sistema y finalizar la sesión actual",
// 		  type: 'warning',
// 		  showCancelButton: true,
// 		  confirmButtonColor: '#3085d6',
// 		  cancelButtonColor: '#d33',
// 		  confirmButtonText: 'Si, Salir',
// 		  cancelButtonText: 'Cancelar'
// 		}).then(function () {
// 		  window.location.href="endsession.php";
// 		});
		
		
		Swal.fire({
  title: '¿Estás seguro?',
  text: "Quieres salir del sistema y finalizar la sesión actual",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si',
    cancelButtonText: 'No'
}).then((result) => {
  if (result.isConfirmed) {
window.location.href="endsession.php";
  }
})


	});
});