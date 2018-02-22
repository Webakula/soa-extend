<div class="form-group {{ $errors->has($name) ? 'has-error' : '' }} wa-table">

    <label for="{{ $name }}" class="control-label">
        {{ $label }}
        @if($required)
            <span class="form-element-required">*</span>
        @endif
    </label>
    <a class="wa-table-add" data-name="{{$name}}">[+] Добавить строку</a>
    <table {!! $table->attributes !!} {!! $table->style !!} {!! $table->data !!} data-name="{{$name}}"
           data-element="wa-table">
        <thead>
        <tr>
            @foreach($table->cols as $col=>$colData)
                <th>{{$colData['title']??''}}</th>
            @endforeach
            @if(!isset($table->disable_row_delete)||($table->disable_row_delete!==true))
                <th>Удалить</th>
            @endif
        </tr>
        </thead>
        <tbody>
        <tr class="initial-empty-row" style="display: none;">
            @foreach($table->cols as $colName=>$col)
                <td>{!! \App\Classes\DynamicTable\Fields::render([$colName=>$col], null, true, $name) !!}</td>
            @endforeach
            @if(!isset($table->disable_row_delete)||($table->disable_row_delete!==true))
                <td><a href="javascript://" data-table="{{$name}}" class="wa-table-remove-row">Удалить</a></td>
            @endif
        </tr>
        @if(!is_null($value)&&count($value)>0)
            @foreach($value as $item)
                <tr>
                    @foreach((array)$item as $colName=>$value)
                        <td>{!! \App\Classes\DynamicTable\Fields::render([$colName=>$table->cols[$colName]], $value, false, $name) !!}</td>
                    @endforeach
                    @if(!isset($table->disable_row_delete)||($table->disable_row_delete!==true))
                        <td><a href="javascript://" data-table="{{$name}}" class="wa-table-remove-row">Удалить</a></td>
                    @endif
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>
