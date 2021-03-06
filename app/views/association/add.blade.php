@extends('template.theme')


@set_true $main_and_aside 
@section('main-content')
    <section>
        <div>
            <h3 class="head">{{Lang::get('association/form_create.head_add_association')}}</h3>
            {{ Form::open(array('class'=> 'form-horizontal','data-validate'=>'our-parsey', 'data-loading'=>'true')) }}

                @input = array(
                    'id'=>"link",
                    'label'=>Lang::get('association/form_create.label_choice_link'),
                    'name'=> 'choice',
                    'data-toggle'=> 'div-linked',
                    'elements' => array(
                        '1'=>array(
                            'value'=>'true',
                            'text'=>Lang::get('association/form_create.radio_yes'),
                        ),
                        '2'=>array(
                            'value'=>'false',
                            'text'=>Lang::get('association/form_create.radio_no'),
                            'checked'=>true,
                        ),
                    )
                )@

                {{SiteHelpers::create_radio($input)}}
                <div style="display:none;" id="div-linked">
                    <p>{{Lang::get('association/form_create.you_are')}} : 
                        <a class="btn-vie-assoc" type="button" onclick="$('#link').val($(this).text());">{{Lang::get('association/form_create.link_one')}}</a>
                        <a class="btn-vie-assoc" type="button" onclick="$('#link').val($(this).text());">{{Lang::get('association/form_create.link_two')}}</a>
                        <a class="btn-vie-assoc" type="button" onclick="$('#link').val($(this).text());">{{Lang::get('association/form_create.link_three')}}</a>
                    </p>
                    @input = array(
                        'id'=>"link",
                        'label'=>Lang::get('association/form_create.label_link'),
                        'form' => array(
                            'placeholder'=>Lang::get('association/form_create.placeholder_link'),
                            'class' => 'input-xlarge',
                            'data-original-title'=>Lang::get('association/form_create.tooltip_link'),
                            'data-maxlength'=>"30",
                        )
                    )@
                    {{SiteHelpers::create_input($input)}}
                </div>

                    <hr>

                @input = array(
                    'id'=>"name",
                    'label'=>Lang::get('association/form_create.placeholder_name'),
                    'form' => array(
                        'placeholder'=>Lang::get('association/form_create.placeholder_name'),
                        'class' => 'input-xlarge',
                        'data-original-title'=>Lang::get('association/form_create.tooltip_name'),
                        'required'=>"required",
                        'data-maxlength'=>"100",
                    )
                )@
                {{ SiteHelpers::create_input($input) }}

                @input = array(
                    'id'=>"link",
                    'label'=>'',
                    'name'=> 'choice',
                    'data-toggle'=> 'div-real-name',
                    'elements' => array(
                        '1'=>array(
                            'value'=>'true',
                            'text'=>Lang::get('association/form_create.checkbox_prefecture'),
                        ),
                    )
                )@
                {{SiteHelpers::create_checkbox($input)}}
                <div style="display:none;" id="div-real-name">
                    @input = array(
                        'id'=>"link",
                        'label'=>Lang::get('association/form_create.label_prefecture'),
                        'data-toggle'=> 'div-real-name',
                        'form' => array(
                            'placeholder'=>Lang::get('association/form_create.label_prefecture'),
                            'class' => 'input-xlarge',
                            'data-original-title'=>Lang::get('association/form_create.tooltip_prefecture'),
                            'data-maxlength'=>"30",
                        )
                    )@
                    {{SiteHelpers::create_input($input)}}
                </div>

                @input = array(
                    'id'=>"link",
                    'label'=>'',
                    'name'=> 'choice',
                    'data-toggle'=> 'div-acronym',
                    'elements' => array(
                        '1'=>array(
                            'value'=>'true',
                            'text'=>Lang::get('association/form_create.label_acronym'),
                        ),
                    )
                )@
                {{SiteHelpers::create_checkbox($input)}}
                <div style="display:none;" id="div-acronym">
                    @input = array(
                        'id'=>"acronym",
                        'label'=>Lang::get('association/form_create.placeholder_acronym'),
                        'form' => array(
                            'placeholder'=>Lang::get('association/form_create.placeholder_acronym'),
                            'class' => 'input-xlarge',
                            'data-original-title'=>Lang::get('association/form_create.tooltip_acronym'),
                            'data-maxlength'=>"8",
                        )
                    )@
                    {{ SiteHelpers::create_input($input) }}
                </div>

                

                <hr>
                <div>
                    <label class="checkbox justify">
                        <input name="approuve" type="checkbox" required="required">{{Lang::get('association/form_create.notice_part_1')}}<a target="_blank" href="/info/condition">{{Lang::get('association/form_create.notice_part_link')}}</a>{{Lang::get('association/form_create.notice_part_2')}}

                        {{Lang::get('association/form_create.notice_create_association')}}
                    </label>
                    
                </div>
                <div class="nav text-right">
                    <button type="submit" class="button button-green">{{Lang::get('core/form.send')}}</button>
                </div>
            {{ Form::close() }}
        </div>
    </section>

@stop