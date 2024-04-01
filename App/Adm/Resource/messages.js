function showMessage(icon, text)
{
  sweetAlert(icon, text);  
}

function sweetAlert(icon, text)
{
  Swal.fire({
    toast: true,
    icon: icon,
    title: text,
    animation: true,
    position: 'top-right',
    showConfirmButton: false,
    timer: 5000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  });
}