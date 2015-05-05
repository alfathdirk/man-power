@extends('skeleton2')

@section('sidebar')
	<script type="text/javascript" src="{{{ Theme::base('vendor/platform/platform.js') }}}"></script>>
	<link rel="import" href="{{{ Theme::base('vendor/pants-tablefield/pants-tablefield.html') }}}">

    <aside class="sidebar">
        <nav class="navbar row">
            <div class="span-12 navsearch">
                <input type="text" tabindex="-1" placeholder="{{ l('Search') }} {{ l('Menu') }} ...">
            </div>
        </nav>
	    <div class="scroll scroll-navbar">
			<ul class="listview">
				@if(f('auth.allowed', '/project') || f('auth.allowed', '/client') )
				<li class="list-group-container">
					<h5>{{ l('Input') }}</h5>
					<ul class="list-group">
						@if(f('auth.allowed', '/project'))
							<li class="plain"><a href="{{ URL::site('/project') }}"><i class="xn xn-briefcase xn-lg"></i> <span>{{ l('Project') }}</span></a></li>
						@endif
						@if(f('auth.allowed', '/client'))
							<li class="plain"><a href="{{ URL::site('/client') }}"><i class="xn xn-gift xn-lg"></i> <span>{{ l('Client') }}</span></a></li>
						@endif
						@if(f('auth.allowed', '/participant'))
							<li class="plain"><a href="{{ URL::site('/participant') }}"><i class="xn xn-group xn-lg"></i> <span>{{ l('Project Participant') }}</span></a></li>
						@endif
					</ul>
				</li>
				@endif

				<li class="list-group-container">
					<h5>{{ l('Report') }}</h5>
					<ul class="list-group">
						<li class="plain"><a href="#"><i class="xn xn-briefcase xn-lg"></i> <span>{{ l('Project Summary') }}</span></a></li>
						<li class="plain"><a href="#"><i class="xn xn-paper-plane xn-lg"></i> <span>{{ l('Project Performace') }}</span></a></li>
						<li class="plain"><a href="#"><i class="xn xn-calendar xn-lg"></i> <span>{{ l('Member On Project') }}</span></a></li>
					</ul>
				</li>

				@if(f('auth.allowed', '/user') || f('auth.allowed', '/role') || f('auth.allowed', '/merchant_industry') || f('auth.allowed', '/org_type'))
				<li class="list-group-container">
					<h5>{{ l('System') }}</h5>
					<ul class="list-group">
						@if(f('auth.allowed', '/user'))
                        <li class="plain"><a href="{{ URL::site('/user') }}"><i class="xn xn-user xn-lg"></i> <span>{{ l('User') }}</span></a></li>
                        @endif
                        @if(f('auth.allowed', '/role'))
                        <li class="plain"><a href="{{ URL::site('/role') }} "><i class="xn xn-group xn-lg"></i> <span>{{ l('Role') }}</span></a></li>
                        @endif
                        
					</ul>
				</li>
				@endif
			</ul>
		</div>
    </aside>
@stop

@section('usermenu')
	<ul class="flat topbar">
		<li class="user">
			<a href="#">
				<span class="avatar"><i class="xn xn-user xn-lg"></i></span>
				<span class="name">Admin <i class="xn xn-angle-down"></i></span>
			</a>
			<ul class="sub animated">
				<li><a href="#">{{ l('Profile') }}</a></li>
				<li><a href="#">{{ l('Settings') }}</a></li>
				<li><a href="{{ URL::site('/logout') }}">{{ l('Logout') }}</a></li>
			</ul>
		</li>
		<li class="notification">
			<a href="#"><span class="badge">2</span></a>
		</li>
	</ul>
@stop

