@extends('template.theme')




@set_true $large_centred 
@section('large-content')
<section>
    <div>
        <ul class="breadcrumb">
          <li><a href="/1-qsdf">Faites de la musique</a> <span class="divider">/</span></li>
          <li><a href="/1/edit">Edition</a> <span class="divider">/</span></li>
          <li><a href="/1/edit/news">Mes publications</a> <span class="divider">/</span></li>
          <li class="active">Editer une publication</li>
        </ul>
        <h3 class="head">{{Lang::get('association/edit/news.modify_news')}}</h3>
        <p>{{Lang::get('association/edit.warn_possiblity_for_normal_user')}}</p>
        <hr>
        {{ Form::open(array('class' => 'form-horizontal')) }}

        <div class="tabbable tabs-left">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#lA">{{Lang::get('association/edit/news.content')}}</a></li>
                <li><a data-toggle="tab" href="#lB">{{Lang::get('association/edit/news.advanced_options')}}</a></li>
            </ul>
            <div class="tab-content">
                <div id="lA" class="tab-pane active">
                    <h5>Informations sur votre évènement :</h5>
                    
                    @input = array(
                        'id'=>"link",
                        'label'=>Lang::get('association/edit/news.label_title'),
                        'form' => array(
                            'placeholder'=>Lang::get('association/edit/news.placeholder_title'),
                            'class' => 'input-xlarge',
                            'data-maxlength'=>"30",
                        )
                    )@
                    {{SiteHelpers::create_input($input)}}
                    <div>
                        <label class="control-label" for="inputPassword">{{Lang::get('association/edit/news.label_text')}}</label>
                        <div class="controls controls-textarea">
                            <textarea rows="8" id="text" class="input-xxlarge" onclick="launchEditor($(this))">
                            </textarea>
                        </div>
                    </div>
                </div>
                <div id="lB" class="tab-pane">
                    <h5>{{Lang::get('association/edit/news.wish_time_publish')}} :</h5>
                    @input = array(
                        'id'=>"link",
                        'label'=>Lang::get('association/edit/news.label_wish_time_publish'),
                        'form' => array(
                            'placeholder'=>Lang::get('association/edit/news.placeholder_wish_time_publish'),
                            'class' => 'input-xlarge',
                            'data-maxlength'=>"30",
                        )
                    )@
                    {{SiteHelpers::create_input($input)}}
                </div>
            </div>
        </div>
        <br>
        <div class="pull-right">
            <input class="button button-orange" id="bouton-envoie" type=button value="Valider" onClick="submit();">
        </div>
    {{ Form::close() }}
    </div>
</section>
@stop

{{-- Footer script --}}
@section('footer-js')
    <script src="http://maps.google.com/maps/api/js?sensor=false&libraries=places&v=3.exp"></script>
    <script src="{{ asset('/pluggin/googleMap/ajouterEve.js') }}"></script>
    <script src="{{ asset('/pluggin/tinyMCE/tiny.js') }}"></script>
    <script src="{{ asset('/pluggin/tinyMCE/tiny_mce/tiny_mce.js') }}"></script>
    <script src="{{ asset('/js/page/ajouterEve-timepicker.js') }}"></script>
    <script src="{{ asset('/js/page/ajouterEve.js') }}"></script>
@stop