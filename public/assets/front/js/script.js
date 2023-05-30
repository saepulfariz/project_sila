var btnLupa = document.getElementById('lupa-wae');

if (btnLupa) {
  
  btnLupa.addEventListener('click', function(){
      Swal.fire({
          title: 'Kok lupa sikh!',
          text: 'Mungkin belum donasi kali ^_^, jadi wekh lupa..',
          icon: 'error',
        })
  })
}