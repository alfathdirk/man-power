@section('content-table')
<?php
$schema = array();

foreach ($schemadetail as $key => $field) {
    if ($field['list-column']) {
        $schema[$key] = $field;
    }
}
?>

<script> 
$(function(){

    $(".button.popup").click ( function () {        
        $.ajax({
            url:$(this).attr ("href")
        }).done(function(element, status) {
            if ($("#popupOverflow").length == 0) {
                $("body").append ("<div id='popupOverflow' style='display:none'><div id='popupMargin'><div id='popupContent' /'></div></div>");
            }

            $("#popupOverflow").fadeIn (100);
            $("#popupOverflow > div > div").html ($(element));
        });

        return false;
    });

});
</script>

    <div class="row" style="padding-left: 50px">
            <div class="wrapper"><h1>Billing Detail</h1></div>

            <div class="wrapper">
                <div class="row">
                    <div class="xlarge-10 large-10 medium-8 small-9 tiny-12">
                        <a href="" class="button popup">+ Create New</a>
                        <a href="" class="button">+ Upload</a>
                        <a href=""><i class="xin xin-file-excel-o"></i>Exel </a>
                        <a href=""><i class="xin xin-file-pdf-o"></i>pdf</a>
                    </div>
                    <div class="xlarge-2 large-2 medium-4 small-3 tiny-12"> 
                        <input type="text" class="search" placeholder="Search...">                  
                    </div>
                </div>
            </div>
        
            <div class="table-container">
                @if(! $entries->count(true))
                <table class="table nowrap stripped hover empty">
                @else
                <table class="table nowrap stripped hover">
                @endif
                    <thead>
                        @section('table.head')
                        <tr>
                            @if (count($schema))
                                @foreach ($schema as $key => $field)
                                    <th>
                                        <a href="{{{ f('controller.url', '?!sort['.$key.']='.(@$_GET['!sort'][$key] == 1 ? -1 : 1)) }}}">
                                            {{ $field['label'] }}
                                        </a>
                                    </th>
                                @endforeach
                            @else
                                <th>
                                    Data
                                </th>
                            @endif
                        </tr>
                        @show
                    </thead>
                    <tbody>
                        @section('table.filter')
                            <!-- <form method="get" id="search-form">
                            <tr>
                                <?php $i = 0 ?>
                                @foreach ($schema as $key => $field)
                                    @if($i++ === 4)
                                        <?php break ?>
                                    @endif
                                    @if(! $field['hidden'])
                                        <th>
                                        <div class="form-group">
                                            <input type="text" placeholder="{{ $field['label'] }}" name="{{ $key }}" value="{{ $app->request->get($key.'!like') }}">
                                        </div>
                                        </th>
                                    @endif
                                @endforeach
                                <td><input type="submit" style="display:none"></td>
                            </tr>
                            </form>
                            <script>
                            $('#search-form').on('submit', function(evt) {
                                evt.preventDefault();
                                var qs = [];
                                $(this).serializeArray().forEach(function(a) {
                                    if (a.value) {
                                        qs.push(a.name + '!like=' + a.value);
                                    }
                                });
                                location.href = (qs.length) ? location.pathname + '?' + qs.join('&') : location.pathname;
                            });
                            </script> -->
                        @show

                        @section('table.body')
                            @if(! $entries->count(true))
                                <tr>
                                    <td colspan="{{ count($schema) }}" class="empty"><i class="xn xn-file-o xn-5x"></i><br />Data still empty.<br />Click <a href="{{ f('controller.url', '/null/create') }}"><i class="xn xn-plus"></i> New</a> to add new data.</td>
                                </tr>
                            @else
                                @foreach ($entries as $entry)
                                    <?php $i = 0 ?>
                                    <tr>
                                        @if (count($schema))
                                            @foreach ($schema as $name => $field)
                                                <td>
                                                    @if($i++ === 0)
                                                        <a href="{{ f('controller.url', '/'.$entry['$id']) }}">
                                                            {{ $field->format('plain', $entry[$name], $entry) }}
                                                        </a>
                                                    @else
                                                    <?php try { echo $entry->format($name); } catch(\Exception $e) { echo 'xxx'; var_dump($e); } ?>

                                                    @endif
                                                </td>
                                            @endforeach
                                        @else
                                            <td>
                                                <a href="{{ f('controller.url', '/'.$entry['$id']) }}">
                                                    {{ $entry->format() }}
                                                </a>
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            @endif
                        @show
                    </tbody>
                </table>
            </div>
     
    </div>
@show