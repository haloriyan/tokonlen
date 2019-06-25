<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | @yield('nama_toko')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('fw/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @yield('head.dependencies')
</head>
<body class="hiddenLeftMenu">
    
<div class="atas">
    <div id="tblMenu" aksi="bkMenu"><i class="fas fa-bars"></i></div>
    <h1>@yield('title')</h1>
    @yield('cta')
</div>

<div class="kiri">
    <div class="wrap">
        <a href="#"><li><div class="icon"><i class="fas fa-home"></i></div> <span>Dashboard</span></li></a>
        <a href="#"><li><div class="icon"><i class="fas fa-database"></i></div> <span>Master Data <i class="fas fa-angle-down"></i></span>
			<ul class="sub">
                <a href="{{ route('admin.product') }}"><li><div class="icon"><i class="fas fa-box"></i></div> <span>Produk</span></li></a>
                <a href="{{ route('admin.category') }}"><li><div class="icon"><i class="fas fa-tags"></i></div> <span>Kategori</span></li></a>
                <a href="#"><li><div class="icon"><i class="fas fa-percent"></i></div> <span>Kupon</span></li></a>
                <a href="{{ route('admin.payment') }}"><li><div class="icon"><i class="fas fa-money-bill-alt"></i></div> <span>Pembayaran</span></li></a>
                <a href="#"><li><div class="icon"><i class="fas fa-users"></i></div> <span>Karyawan</span></li></a>
			</ul>
        </li></a>
        <a href="#"><li><div class="icon"><i class="fas fa-comments"></i></div> <span>Messaging</span></li></a>
        <a href="#"><li><div class="icon"><i class="fas fa-chart-area"></i></div> <span>Laporan</span></li></a>
        <a href="{{ route('admin.config') }}"><li><div class="icon"><i class="fas fa-cogs"></i></div> <span>Setelan</span></li></a>
        <a href="{{ route('logout') }}"><li><div class="icon"><i class="fas fa-sign-out-alt"></i></div> <span>Logout</span></li></a>
    </div>
</div>

<div class="container">
    @yield('content')
</div>

<script src="{{ asset('js/embo.js') }}"></script>
<script>
	function select(sel) {
		return document.querySelector(sel)
	}
	function toggleMenu(acts) {
		let act = acts || ""
		if(act == "") {
			act = select("#tblMenu").getAttribute('aksi')
		}
		if(act == "xMenu") {
			select("body").setAttribute('class', 'hiddenLeftMenu')
			select("#tblMenu").setAttribute('aksi', 'bkMenu')
		}else {
			select("body").removeAttribute('class', 'hiddenLeftMenu')
			select("#tblMenu").setAttribute('aksi', 'xMenu')
		}
	}
    $("#tblMenu").klik(function() {
        toggleMenu()
    })

    // swipe
	function detectswipe(el,func) {
		swipe_det = new Object();
		swipe_det.sX = 0; swipe_det.sY = 0; swipe_det.eX = 0; swipe_det.eY = 0;
		var min_x = 30;  //min x swipe for horizontal swipe
		var max_x = 30;  //max x difference for vertical swipe
		var min_y = 50;  //min y swipe for vertical swipe
		var max_y = 60;  //max y difference for horizontal swipe
		var direc = "";
		ele = document.querySelector(el);
		ele.addEventListener('touchstart',function(e){
			var t = e.touches[0];
			swipe_det.sX = t.screenX; 
			swipe_det.sY = t.screenY;
		},false);
		ele.addEventListener('touchmove',function(e){
			e.preventDefault();
			var t = e.touches[0];
			swipe_det.eX = t.screenX; 
			swipe_det.eY = t.screenY;    
		},false);
		ele.addEventListener('touchend',function(e){
			//horizontal detection
			if ((((swipe_det.eX - min_x > swipe_det.sX) || (swipe_det.eX + min_x < swipe_det.sX)) && ((swipe_det.eY < swipe_det.sY + max_y) && (swipe_det.sY > swipe_det.eY - max_y) && (swipe_det.eX > 0)))) {
				if(swipe_det.eX > swipe_det.sX) direc = "r";
				else direc = "l";
			}
			//vertical detection
			else if ((((swipe_det.eY - min_y > swipe_det.sY) || (swipe_det.eY + min_y < swipe_det.sY)) && ((swipe_det.eX < swipe_det.sX + max_x) && (swipe_det.sX > swipe_det.eX - max_x) && (swipe_det.eY > 0)))) {
				if(swipe_det.eY > swipe_det.sY) direc = "d";
				else direc = "u";
			}

			if (direc != "") {
				if(typeof func == 'function') func(el,direc);
			}
			direc = "";
			swipe_det.sX = 0; swipe_det.sY = 0; swipe_det.eX = 0; swipe_det.eY = 0;
		},false);  
	}

function myfunction(el,d) {
	if(d == "r") {
		toggleMenu("bkMenu")
  	}else if(d == "l") {
		toggleMenu("xMenu")
	}
}

detectswipe('body',myfunction);

</script>
@yield('javascript')

</body>
</html>