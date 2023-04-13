<?php

namespace App\Libraries;

// created by saepulfariz 12/10/2021
// alert library codeigniter 4

class Alert
{


	protected $session;
	public function __construct()
	{
		$this->session = \Config\Services::session();
	}


	function set($icon, $title, $text, $url = null)
	{
		$data = [
			'icon' => $icon,
			'title' => $title,
			'text' => $text,
			'url' => $url
		];

		$this->session->setFlashdata('iconFlash', $data['icon']);
		$this->session->setFlashdata('titleFlash', $data['title']);
		$this->session->setFlashdata('textFlash', $data['text']);
		$this->session->setFlashdata('urlFlash', $data['url']);
	}

	function get($value = null)
	{
		/*
		<div id="flash" data-icon="<?= $this->session->flashdata('iconFlash'); ?>" data-title="<?= $this->session->flashdata('titleFlash'); ?>" data-text="<?= $this->session->flashdata('textFlash'); ?>" data-url="<?= $this->session->flashdata('urlFlash'); ?>"></div>

		*/

		$data = '<div id="flash" data-icon="' . $this->session->getFlashdata('iconFlash') . '" data-title="' . $this->session->getFlashdata('titleFlash') . '" data-text="' . $this->session->getFlashdata('textFlash') . '" data-url="' . $this->session->getFlashdata('urlFlash') . '"></div>';

		// return $this->session->getFlashdata($value);
		return $data;
	}

	function init($set)
	{

		// ini javascript buat popup pidah link kayak pake target
		// window.open('https://www.w3schools.com');


		// $dataLink = '<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
		$dataLink = '<script src="' . base_url() . "/assets/sweetalert2/sweetalert2.all.min.js" . '"></script>';


		$data_jquery = "
	<script>
		const iconFlash = $('#flash').data('icon');
		const titleFlash = $('#flash').data('title');
		const textFlash = $('#flash').data('text');
		const urlFlash = $('#flash').data('url');
		const baseurl = $('#baseurl').val();


		if (iconFlash && urlFlash) {
			Swal.fire({
				icon: iconFlash,
				title: titleFlash,
				text: textFlash,
				footer: '<a href>Alert Pake Link</a>'
			}).then((result) => {
				if (result.value) {
					window.location.href = urlFlash;
				}
			})
		} else if (iconFlash) {
			Swal.fire({
				icon: iconFlash,
				title: titleFlash,
				text: textFlash
			})
		}

		// footer: '<a href>Alert Biasa?</a>'

		function deleteTombol(e){
			const ket = e.getAttribute('data-ket');
			const href = e.getAttribute('data-href') ? e.getAttribute('data-href') : e.getAttribute('href');
			Swal.fire({
				title: 'Are you sure?',
				text: ket,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
				if (result.value) {
					if(href){
						window.location.href = href;
					}else{
						e.parentElement.submit();
					}
					// Swal.fire(
					// 	'Deleted!',
					// 	'Your file has been deleted.',
					// 	'success'
					// ).then((result) => {
					// if (result.value) {
					// 		window.location.href = href;
					// 		}
					// 	})
				}
			})
			e.preventDefault();
		}

		$('.del-tombol').on('click', function(e){
			const ket = $(this).data('ket');
			const href = $(this).data('href') ? $(this).data('href') : $(this).attr('href');
			Swal.fire({
				title: 'Are you sure?',
				text: ket,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
				if (result.value) {
					if(href){
						window.location.href = href;
					}else{
						$(this).parent().submit();
					}
					// Swal.fire(
					// 	'Deleted!',
					// 	'Your file has been deleted.',
					// 	'success'
					// ).then((result) => {
					// if (result.value) {
					// 	window.location.href = href;
					// 	}
					// })
				}
			})
			e.preventDefault();
		});
	</script>

		";

		$data_vanilla = "
	<script>

		function deleteTombol(e){
			const ket = e.getAttribute('data-ket');
			const href = e.getAttribute('data-href') ? e.getAttribute('data-href') : e.getAttribute('href');
			Swal.fire({
				title: 'Are you sure?',
				text: ket,
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
				if (result.value) {
					if(href){
						window.location.href = href;
					}else{
						e.parentElement.submit();
					}
					// Swal.fire(
					// 	'Deleted!',
					// 	'Your file has been deleted.',
					// 	'success'
					// ).then((result) => {
					// if (result.value) {
					// 		window.location.href = href;
					// 		}
					// 	})
				}
			})
			e.preventDefault();
		}

		var btns = document.getElementsByClassName('del-tombol');
		for (var i = 0; i < btns.length; i++) {
			btns[i].addEventListener('click', function(e) {
				const ket = this.getAttribute('data-ket');
				const href = this.getAttribute('data-href') ? this.getAttribute('data-href') : this.getAttribute('href');
				Swal.fire({
					title: 'Are you sure?',
					text: ket,
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes, delete it!'
				}).then((result) => {
					if (result.value) {
						if(href){
							window.location.href = href;
						}else{
							this.parentElement.submit();
						}
						// Swal.fire(
						// 	'Deleted!',
						// 	'Your file has been deleted.',
						// 	'success'
						// ).then((result) => {
						// if (result.value) {
						// 		window.location.href = href;
						// 		}
						// 	})
					}
				})
				e.preventDefault();
			})
		}


		const iconFlash = document.getElementById('flash').getAttribute('data-icon');
		const titleFlash = document.getElementById('flash').getAttribute('data-title');
		const textFlash = document.getElementById('flash').getAttribute('data-text');
		const urlFlash = document.getElementById('flash').getAttribute('data-url');


		if (iconFlash && urlFlash) {
			Swal.fire({
				icon: iconFlash,
				title: titleFlash,
				text: textFlash,
				footer: '<a href>Alert Pake Link</a>'
			}).then((result) => {
				if (result.value) {
					window.location.href = urlFlash;
				}
			})
		} else if (iconFlash) {
			Swal.fire({
				icon: iconFlash,
				title: titleFlash,
				text: textFlash
			})
		}

		
	</script>

		";

		if ($set == "vanilla") {
			echo $dataLink . $data_vanilla;
		} else {
			// echo '<div id="flash" data-icon="" data-title="" data-text="" data-url=""></div>';
			echo  $dataLink . $data_jquery;
		}
	}
}
