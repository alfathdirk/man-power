@extends('layout')

<?php 
    use ROH\Util\Inflector; 
    use \App\Schema\SysParamReference;
    use \Norm\Schema\Reference;
?>


@section('pagetitle')
    {{ l('{0}: ', array(Inflector::humanize(f('controller')->getClass()))).$entry->format() }}
@stop

@section('back')
    <a href="{{ f('controller.url') }}" class="direct"><i class="xn xn-angle-left"></i> {{ l('Back') }}</a>
@stop

@section('search')
@stop

@section('tabs')
@stop

@section('menusearch')
@stop

@section('menudefault')
@stop

@section('menumore')
@stop

@section('content')
    <div class="read contextual">
        <div class="scroll scroll-navbar">
            @section('fields')
                @if (!f('controller')->schema()['name']['hidden'])
                    <div class="row {{ (f('notification.message', 'name') AND $app->request->getMethod() !== 'GET') ? 'has-error' : ''}}">
                        <div class="span-4">{{ f('controller')->schema()['name']->label() }}</div>
                        <div class="span-8">{{ $entry->format('name', 'readonly') }}</div>
                        <span class="help-block">{{ f('notification.message', 'name') }}</span>
                    </div>
                @endif
                @if (!f('controller')->schema()['client_id']['hidden'])
                    <div class="row {{ (f('notification.message', 'client_id') AND $app->request->getMethod() !== 'GET') ? 'has-error' : ''}}">
                        <div class="span-4">{{ f('controller')->schema()['client_id']->label() }}</div>
                        <div class="span-8">{{ $entry->format('client_id', 'readonly') }}</div>
                        <span class="help-block">{{ f('notification.message', 'client_id') }}</span>
                    </div>
                @endif
                @if (!f('controller')->schema()['starttime']['hidden'])
                    <div class="row {{ (f('notification.message', 'starttime') AND $app->request->getMethod() !== 'GET') ? 'has-error' : ''}}">
                        <div class="span-4">{{ f('controller')->schema()['starttime']->label() }}</div>
                        <div class="span-8">{{ $entry->format('starttime', 'readonly') }}</div>
                        <span class="help-block">{{ f('notification.message', 'starttime') }}</span>
                    </div>
                @endif
                @if (!f('controller')->schema()['endtime']['hidden'])
                    <div class="row {{ (f('notification.message', 'endtime') AND $app->request->getMethod() !== 'GET') ? 'has-error' : ''}}">
                        <div class="span-4">{{ f('controller')->schema()['endtime']->label() }}</div>
                        <div class="span-8">{{ $entry->format('endtime', 'readonly') }}</div>
                        <span class="help-block">{{ f('notification.message', 'endtime') }}</span>
                    </div>
                @endif
                @if (!f('controller')->schema()['project_flag']['hidden'])
                    <div class="row {{ (f('notification.message', 'project_flag') AND $app->request->getMethod() !== 'GET') ? 'has-error' : ''}}">
                        <div class="span-4">{{ f('controller')->schema()['project_flag']->label() }}</div>
                        <div class="span-8">{{ $entry->format('project_flag', 'readonly') }}</div>
                        <span class="help-block">{{ f('notification.message', 'project_flag') }}</span>
                    </div>
                @endif
            @show

            @section('additionalfields')
            @show
            <!-- Participant -->
            <div class="row">
                
                <h3>Project Participants</h3>
                <div class="table-container">
                    <table class="table nowrap stripped hover">
                        <thead>
                            @section('table.head')
                            <tr>
                                <th>Name</th>
                                <th>Title</th>
                                <th colspan="2">Action</th>
                            </tr>
                            @show
                        </thead>
                        <tbody>
                            @section('table.body')
                                @if(empty($participants))
                                    <tr>
                                        <td colspan="3" class="empty"><i class="xn xn-file-o xn-5x"></i><br />Data still empty.<br />Click <a href="{{ URL::site('/participant/null/create') }}"><i class="xn xn-plus"></i> New</a> to add new data.</td>
                                    </tr>
                                @else
                                    @foreach ($participants as $participant)
                                        <?php $i = 0 ?>
                                        <tr>
                                            <td>
                                                <span>{{ Reference::create('user_id')->to('User', 'username')->formatPlain($participant['user_id']) }}</span>
                                            </td>
                                            <td>
                                                <span>{{ SysParamReference::create('project_title')->by('project_title')->formatPlain($participant['project_title']) }}</span>
                                            </td>
                                            <td>
                                                <a href="{{ URL::site('/participant/'.$participant['$id'].'/update') }}" class="solid"><i class="xn xn-edit"></i>{{{ l('Edit') }}}</a>
                                            </td>
                                            <td>
                                                <a href="{{ URL::site('/participant/'.$participant['$id'].'/delete') }}" class="button-outline error delete"><i class="xn xn-trash-o"></i>{{{ l('Delete') }}}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            @show
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>

        @section('contextual')
            <nav class="navbar navbar-bottom row">
                <div class="span-6 align-left">
                    <a href="{{ f('controller.url', '/:id/update') }}" class="button solid"><i class="xn xn-edit"></i>{{{ l('Edit') }}}</a>
                </div>
                <div class="span-6 align-right">
                    <a href="{{ f('controller.url', '/:id/delete') }}" class="button button-outline error delete"><i class="xn xn-trash-o"></i>{{{ l('Delete') }}}</a>
                </div>
            </nav>
        @show
    </div>
@stop
