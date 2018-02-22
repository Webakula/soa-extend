    'base_table' => [
        'attributes' => [
            'class' => 'table table-bordered table-striped'
        ],
        'disable_row_delete' => false,//необязательно, если true, то строки из таблицы удалять нельзя
        'data' => [
            //Any data-attributes. Can use data-* in 'attributes' section instead
        ],
        'style' => [
            //Any inline style key-pairs (e.g. 'color'=>'#fff')
        ],
    ],
    'timetable' => [
        'extends' => 'base_table', //Имя таблицы, которую нужно отнаследовать
        //'exclude' => true, //array of field names from base table, if ===TRUE then all fields will be escluded, only attributes will be used
        'cols' => [
            'is_holiday' => [
                'type' => 'checkbox',
                'title' => 'Выходной день',
                'default_value' => 1,
                'options' => [
                    'style' => [], //Список css-свойств, key=>value
                    'data' => ['foo' => 'bar'], //Список data-атрибутов, key=>value,
                    'attributes' => ['class' => 'fii'], //Список произвольных HTML-атрибутов, key-value
                ]
            ],
            'day_title' => [
                'type' => 'text',
                'title' => 'Название',
            ],
            'day_description' => [
                'type' => 'text',
                'title' => 'Описание'
            ],
//            'test_select' => [
//                'type' => 'select',
//                'title' => 'Select',
//                'values' => \App\Models\Store::class, //Можно передать класс модели
//                //    'values'=>[1=>'Да', 2=>'Нет'], //или массив значений
//                'default_option' => true, //Показывать ли опцию "выберите" если ничего не выбрано, по умолчанию true
//                'scopes' => ['visible'], //scopes если указана модель
//                'key' => 'id', //Ключ, option value=""
//                'value' => 'title' //Отображаепое значение опции
//            ] //scopes, key, value используются только если уазать модель в качестве источника данных
        ]
    ]