<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Milestone Guaranty Corp and Assurance Inc.</title>

<style>

body{
margin:0;
font-family:'Segoe UI',Tahoma,Verdana;
background:#f5f6fa;
}

/* HEADER */

.header{
display:flex;
align-items:center;
padding:12px 24px;
background:#fff;
border-bottom:1px solid #e5e7eb;
box-shadow:0 2px 6px rgba(0,0,0,0.05);
position:sticky;
top:0;
z-index:1000;
}

.logo{
height:70px;
}

.menu-button{
font-size:24px;
cursor:pointer;
margin-right:15px;
padding:5px 10px;
border-radius:6px;
}

.menu-button:hover{
background:#f3f4f6;
}

/* SIDEBAR */

.sidenav{
height:100%;
width:0;
position:fixed;
z-index:1001;
top:0;
left:0;
background:#ffffff;
overflow-x:hidden;
overflow-y:auto;
transition:.3s;
box-shadow:4px 0 20px rgba(0,0,0,0.08);
border-right:1px solid #e5e7eb;
}

/* CLOSE BUTTON */

.closebtn{
position:absolute;
top:12px;
right:16px;
font-size:22px;
cursor:pointer;
color:#6b7280;
}

.closebtn:hover{
color:#111827;
}

/* OVERLAY */

.overlay{
position:fixed;
top:0;
left:0;
width:100%;
height:100%;
background:rgba(0,0,0,0.3);
display:none;
z-index:1000;
}

/* PROFILE */

.profile{
padding:20px;
border-bottom:1px solid #eee;
text-align:center;
}

.profile img{
height:60px;
margin-bottom:10px;
}

.profile .name{
font-weight:600;
font-size:14px;
}

.profile .email{
font-size:12px;
color:#6b7280;
}

/* NAV */

.nav-section{
font-size:11px;
font-weight:600;
color:#9ca3af;
padding:15px 18px 6px;
letter-spacing:1px;
}

.nav-item{
display:flex;
align-items:center;
justify-content:space-between;
padding:10px 14px;
margin:4px 12px;
font-size:14px;
border-radius:8px;
cursor:pointer;
transition:.2s;
}

.nav-item:hover{
background:#f3f4f6;
}

.submenu a{
display:block;
padding:8px 16px;
margin:3px 20px;
font-size:13px;
border-radius:6px;
color:#374151;
text-decoration:none;
}

.submenu a:hover{
background:#f3f4f6;
}

.active{
background:#16a34a !important;
color:white !important;
}

/* LOGOUT */

.logout-box{
padding:20px;
border-top:1px solid #eee;
}

.logout-btn{
width:100%;
padding:10px;
border:none;
background:#ef4444;
color:white;
border-radius:8px;
cursor:pointer;
}

.logout-btn:hover{
background:#dc2626;
}

#main-content{
padding:25px;
}

</style>
</head>

<body>

<!-- OVERLAY -->
<div id="overlay" class="overlay" onclick="closeNav()"></div>

<!-- SIDEBAR -->

<div id="mySidenav" class="sidenav">

<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">✕</a>

<div class="profile">

<img src="{{ asset('images/milestone-logo.png') }}">

<div class="name">
{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
</div>

<div class="email">
{{ Auth::user()->email }}
</div>

</div>

<div class="nav-section">MODULES</div>

<nav>

@php
$navClasses="block px-4 py-2 text-gray-800 rounded-md hover:bg-gray-200 transition";
$activeClasses="active";
@endphp


<!-- QUOTATION -->

<div x-data="{ open: {{ request()->is('quotations*') || request()->is('overview*') ? 'true' : 'false' }} }">

<div @click="open=!open" class="nav-item">

    <div style="display:flex; align-items:center; gap:8px;">

        <!-- Icon -->
        <svg xmlns="http://www.w3.org/2000/svg"
            width="18"
            height="18"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            viewBox="0 0 24 24">

            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
            <polyline points="14 2 14 8 20 8"></polyline>
            <line x1="16" y1="13" x2="8" y2="13"></line>
            <line x1="16" y1="17" x2="8" y2="17"></line>

        </svg>

        <span>Quotation</span>

    </div>

    <!-- Arrow -->
    <span x-show="!open">▾</span>
    <span x-show="open">▴</span>

</div>

<div x-show="open" class="submenu">

<x-nav-link :href="route('quotations.index')" :active="request()->routeIs('quotations.index')" class="{{ request()->routeIs('quotations.index') ? $activeClasses : $navClasses }}">
Quotation List
</x-nav-link>

@if(in_array(Auth::user()->role_id,[1,4]))
<x-nav-link :href="route('quotations.create')" :active="request()->routeIs('quotations.create')" class="{{ request()->routeIs('quotations.create') ? $activeClasses : $navClasses }}">
Create Quotation
</x-nav-link>
@endif

@if(in_array(Auth::user()->role_id,[1,2,3]))

<x-nav-link :href="route('overviewquotations.index')" :active="request()->routeIs('overviewquotations.index')" class="{{ request()->routeIs('overviewquotations.index') ? $activeClasses : $navClasses }}">
Overview Intermediary
</x-nav-link>

<x-nav-link :href="route('overviewintialapprovers.index')" :active="request()->routeIs('overviewintialapprovers.index')" class="{{ request()->routeIs('overviewintialapprovers.index') ? $activeClasses : $navClasses }}">
Overview Approvers
</x-nav-link>

<x-nav-link :href="route('overviewdeclinedquotations.index')" :active="request()->routeIs('overviewdeclinedquotations.index')" class="{{ request()->routeIs('overviewdeclinedquotations.index') ? $activeClasses : $navClasses }}">
Declined Quotations
</x-nav-link>

<x-nav-link :href="route('overviewpropertyoccupancy.index')" :active="request()->routeIs('overviewpropertyoccupancy.index')" class="{{ request()->routeIs('overviewpropertyoccupancy.index') ? $activeClasses : $navClasses }}">
Overview Property Occupancy
</x-nav-link>

@endif

</div>

</div>


<!-- QUEUING -->

<div x-data="{ open: {{ request()->is('issuancequeues*') ? 'true' : 'false' }} }">

<div @click="open=!open" class="nav-item">

    <div style="display:flex; align-items:center; gap:8px;">

        <!-- Icon -->
        <svg xmlns="http://www.w3.org/2000/svg"
            width="18"
            height="18"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            viewBox="0 0 24 24">

            <path d="M3 7h18"></path>
            <path d="M3 12h18"></path>
            <path d="M3 17h18"></path>

        </svg>

        <span>Queuing</span>

    </div>

    <!-- Arrow -->
    <svg xmlns="http://www.w3.org/2000/svg"
        width="16"
        height="16"
        :class="{ 'rotate-180': open }"
        style="transition:0.2s"
        viewBox="0 0 20 20"
        fill="currentColor">

        <path fill-rule="evenodd"
        d="M5.293 7.293a1 1 0 011.414 0L10
        10.586l3.293-3.293a1 1 0
        111.414 1.414l-4 4a1 1 0
        01-1.414 0l-4-4a1 1 0
        010-1.414z"/>

    </svg>

</div>

<div x-show="open" class="submenu">

<x-nav-link :href="route('issuancequeues.index')">
Ticket List
</x-nav-link>

@if(in_array(Auth::user()->role_id,[1,4]))
<x-nav-link :href="route('issuancequeues.create')">
Create Ticket
</x-nav-link>
@endif

</div>

</div>


<!-- CLAIMS -->

@if(in_array(Auth::user()->role_id,[1,4]))

<div x-data="{ open: {{ request()->is('claims*') ? 'true' : 'false' }} }">

<div @click="open=!open" class="nav-item">

    <div style="display:flex; align-items:center; gap:8px;">

        <!-- Claims Icon -->
        <svg xmlns="http://www.w3.org/2000/svg"
            width="18"
            height="18"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            viewBox="0 0 24 24">

            <path d="M21 15V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v9"></path>
            <path d="M7 10h10"></path>
            <path d="M7 14h6"></path>
            <path d="M3 15l3 3 3-3"></path>

        </svg>

        <span>Claims</span>

    </div>

    <!-- Arrow -->
    <svg xmlns="http://www.w3.org/2000/svg"
        width="16"
        height="16"
        :class="{ 'rotate-180': open }"
        style="transition:0.2s"
        viewBox="0 0 20 20"
        fill="currentColor">

        <path fill-rule="evenodd"
        d="M5.293 7.293a1 1 0 011.414 0L10
        10.586l3.293-3.293a1 1 0
        111.414 1.414l-4 4a1 1 0
        01-1.414 0l-4-4a1 1 0
        010-1.414z"/>

    </svg>

</div>

<div x-show="open" class="submenu">

<x-nav-link :href="route('claims.index')">
Dashboard
</x-nav-link>

<x-nav-link :href="route('claims.create')">
Open File
</x-nav-link>

<x-nav-link :href="route('claims.create')">
Reports
</x-nav-link>

</div>

</div>

@endif


<!-- KYC -->


<!-- SYSTEM -->

@if(in_array(Auth::user()->role_id,[1,2]))

<div class="nav-section">SYSTEM</div>

<div x-data="{ open:false }">

<div @click="open=!open" class="nav-item">

    <div style="display:flex; align-items:center; gap:8px;">

        <!-- Maintenance Icon -->
        <svg xmlns="http://www.w3.org/2000/svg"
            width="18"
            height="18"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round"
            viewBox="0 0 24 24">

            <circle cx="12" cy="12" r="3"></circle>
            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82
                     l.06.06a2 2 0 1 1-2.83 2.83
                     l-.06-.06a1.65 1.65 0 0 0-1.82-.33
                     1.65 1.65 0 0 0-1 1.51V21
                     a2 2 0 1 1-4 0v-.09
                     a1.65 1.65 0 0 0-1-1.51
                     1.65 1.65 0 0 0-1.82.33
                     l-.06.06a2 2 0 1 1-2.83-2.83
                     l.06-.06a1.65 1.65 0 0 0 .33-1.82
                     1.65 1.65 0 0 0-1.51-1H3
                     a2 2 0 1 1 0-4h.09
                     a1.65 1.65 0 0 0 1.51-1
                     1.65 1.65 0 0 0-.33-1.82
                     l-.06-.06a2 2 0 1 1 2.83-2.83
                     l.06.06a1.65 1.65 0 0 0 1.82.33
                     h.02A1.65 1.65 0 0 0 9 3.09V3
                     a2 2 0 1 1 4 0v.09
                     a1.65 1.65 0 0 0 1 1.51
                     1.65 1.65 0 0 0 1.82-.33
                     l.06-.06a2 2 0 1 1 2.83 2.83
                     l-.06.06a1.65 1.65 0 0 0-.33 1.82
                     v.02A1.65 1.65 0 0 0 20.91 11H21
                     a2 2 0 1 1 0 4h-.09
                     a1.65 1.65 0 0 0-1.51 1z">
            </path>

        </svg>

        <span>Maintenance</span>

    </div>

    <!-- Dropdown Arrow -->
    <svg xmlns="http://www.w3.org/2000/svg"
        width="16"
        height="16"
        :class="{ 'rotate-180': open }"
        style="transition:0.2s"
        viewBox="0 0 20 20"
        fill="currentColor">

        <path fill-rule="evenodd"
        d="M5.293 7.293a1 1 0 011.414 0L10
        10.586l3.293-3.293a1 1 0
        111.414 1.414l-4 4a1 1 0
        01-1.414 0l-4-4a1 1 0
        010-1.414z"/>

    </svg>

</div>

<div x-show="open" class="submenu">

<x-nav-link :href="route('lines.index')">
Line Maintenance
</x-nav-link>

<x-nav-link :href="route('initialapprovers.index')">
Authority Maintenance
</x-nav-link>

</div>

</div>

@endif

</nav>

<div class="logout-box">

<form method="POST" action="{{ route('logout') }}">
@csrf
<button class="logout-btn">Logout</button>
</form>

</div>

</div>


<!-- HEADER -->

<header class="header">

<span class="menu-button" onclick="openNav()">☰</span>

<a href="{{ route('dashboard') }}">
<img src="{{ asset('images/milestone-logo.png') }}" class="logo">
</a>

</header>


<!-- CONTENT -->

<main id="main-content"></main>


<script>

function openNav(){
document.getElementById("mySidenav").style.width="280px";
document.getElementById("overlay").style.display="block";
}

function closeNav(){
document.getElementById("mySidenav").style.width="0";
document.getElementById("overlay").style.display="none";
}

/* ESC key close */

document.addEventListener("keydown",function(e){
if(e.key==="Escape"){
closeNav();
}
});

</script>

</body>
</html>
