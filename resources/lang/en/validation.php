<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute должен быть принят.',
    'accepted_if' => ':attribute должен быть принят :other = :value.',
    'active_url' => ':attribute не корректный URL.',
    'after' => ':attribute должно быть после :date.',
    'after_or_equal' => ':attribute должна быть после или в :date.',
    'alpha' => ':attribute должен содержать только буквы.',
    'alpha_dash' => ':attribute должен содержать только буквы, цифры, тире и подчеркивания.',
    'alpha_num' => ':attribute должен содержать только буквы и цифры.',
    'array' => ':attribute должен быть массивом.',
    'before' => ':attribute должно быть до :date.',
    'before_or_equal' => ':attribute должна быть дата, предшествующая или равная :date.',
    'between' => [
        'numeric' => ':attribute должно быть между :min и :max.',
        'file' => ':attribute должно быть между :min и :max килобайт.',
        'string' => ':attribute должно быть между :min и :max символов.',
        'array' => ':attribute должно быть между :min и :max предметов.',
    ],
    'boolean' => ':attribute поле должно быть true или false.',
    'confirmed' => ':attribute подтверждение не совпадает.',
    'current_password' => 'TНеверный пароль.',
    'date' => ':attribute это недействительная дата.',
    'date_equals' => ':attribute должна быть дата, равная :date.',
    'date_format' => ':attribute не соответствует формату :format.',
    'declined' => ':attribute должно быть отклонено.',
    'declined_if' => ':attribute должно быть отклонено, когда :other = :value.',
    'different' => ':attribute and :other должны отличаться.',
    'digits' => ':attribute должно быть :digits чисел.',
    'digits_between' => ':attribute должно быть :min и :max цифр.',
    'dimensions' => ':attribute имеет недопустимые размеры изображения.',
    'distinct' => ':attribute поле имеет повторяющееся значение.',
    'email' => ':attribute должен быть действительный адрес электронной почты.',
    'ends_with' => ':attribute  должно заканчиваться одним из следующих: :values.',
    'enum' => 'Выбранный :attribute некорректен.',
    'exists' => 'Выбранный :attribute некорректен.',
    'file' => ':attribute Должен быть файлом.',
    'filled' => ':attribute поле должно иметь значение.',
    'gt' => [
        'numeric' => ':attribute должно быть больше, чем :value.',
        'file' => ' :attribute должно быть больше, чем :value килобайт.',
        'string' => ':attribute должно быть больше, чем :value символов.',
        'array' => ':attribute должно быть больше, чем :value предметов.',
    ],
    'gte' => [
        'numeric' => ':attribute должно быть больше или равно :value.',
        'file' => ':attribute должно быть больше или равно :value килобайт.',
        'string' => ':attribute должно быть больше или равно :value символов.',
        'array' => ':attribute необходимо :value элементов больше.',
    ],
    'image' => ':attribute должно быть изображением.',
    'in' => 'Выбранный :attribute некорректен.',
    'in_array' => ':attribute не существует в :other.',
    'integer' => ':attribute должен быть целым числом.',
    'ip' => ':attribute должен быть IP адресом.',
    'ipv4' => ':attribute должен быть IPv4 адресом.',
    'ipv6' => ':attribute должен быть IPv6 адресом.',
    'json' => ':attribute должен быть JSON формата.',
    'lt' => [
        'numeric' => ':attribute должен быть мельше, чем :value.',
        'file' => ':attribute должен быть мельше, чем :value килобайт.',
        'string' => ':attribute должен быть мельше, чем :value символов.',
        'array' => ':attribute необходимо меньше, чем :value элементов.',
    ],
    'lte' => [
        'numeric' => ':attribute должно быть меньше или равно :value.',
        'file' => ':attribute должно быть меньше или равно :value килобайт.',
        'string' => ':attribute должно быть меньше или равно :value символов.',
        'array' => ':attribute должно быть больше, чем :value элементов.',
    ],
    'mac_address' => ':attribute должен быть корректный MAC адрес.',
    'max' => [
        'numeric' => ':attribute не должно быть больше, чем :max.',
        'file' => ':attribute не должно быть больше, чем :max килобайт.',
        'string' => ':attribute не должно быть больше, чем :max символов.',
        'array' => ':attribute должно быть больше, чем :max элементов.',
    ],
    'mimes' => ':attribute файл должен быть :values.',
    'mimetypes' => ':attribute файл должен быть :values.',
    'min' => [
        'numeric' => ':attribute должно быть, по крайней мере :min.',
        'file' => ':attribute должно быть, по крайней мере :min килобайт.',
        'string' => ':attribute должно быть, по крайней мере :min символов.',
        'array' => ':attribute должно быть, по крайней мере :min элементов.',
    ],
    'multiple_of' => ':attribute должно быть кратно :value.',
    'not_in' => 'Выбор не корректен :attribute.',
    'not_regex' => ':attribute неверный формат.',
    'numeric' => ':attribute должен быть числом.',
    'password' => 'Неверный пароль.',
    'present' => ':attribute должно быть заполнено.',
    'prohibited' => ':attribute запрещён.',
    'prohibited_if' => ':attribute запрещён, когда :other равен :value.',
    'prohibited_unless' => ':attribute запрещён, если только :other не находиться в :values.',
    'prohibits' => ':attribute запрещает присутствие :other.',
    'regex' => ':attribute неверный формат.',
    'required' => 'Поле :attribute обязательно для заполнения.',
    'required_array_keys' => ':attribute поле должно содержать записи для: :values.',
    'required_if' => ':attribute поле обязательно, когда  :other равно :value.',
    'required_unless' => ':attribute поле является обязательным, если только :other находится в :values.',
    'required_with' => ':attribute поле обязательно, когда :values присутствует.',
    'required_with_all' => ':attribute поле обязательно, когда  :values присутствуют.',
    'required_without' => ':attribute поле обязательно, когда  :values is not present.',
    'required_without_all' => ':attribute поле является обязательным, когда один из :values не присутствуют.',
    'same' => ':attribute и :other должны совпадать',
    'size' => [
        'numeric' => ':attribute должен быть :size.',
        'file' => ':attribute должен быть :size килобайт.',
        'string' => ':attribute должен быть :size символов.',
        'array' => ':attribute должен содержать :size элементов.',
    ],
    'starts_with' => ':attribute должен начинаться с одного из следующих: :values.',
    'string' => ':attribute должен быть строкой.',
    'timezone' => ':attribute должен быть действительный часовой пояс.',
    'unique' => ':attribute уже занят.',
    'uploaded' => ':attribute не удалось загрузить.',
    'url' => ':attribute должен быть действительным URL.',
    'uuid' => ':attribute должен быть действительным UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
