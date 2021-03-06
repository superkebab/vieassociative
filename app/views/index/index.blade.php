@extends('template.theme')


@set_true $main_and_aside 
@section('main-content')
	
    <section>
	    <div>
			<h3 class="head">{{Lang::get('index/index.head_what_vieassociative')}}</h3>
	    	<div class="text-center">
	    	<iframe width="480" height="360" src="//www.youtube-nocookie.com/embed/4TlJ4qKO2Xg?rel=0" frameborder="0" allowfullscreen></iframe>
		    </div>
	        <h3 class="head">{{Lang::get('index/index.head_1')}}</h3>
	        <p>{{Lang::get('index/index.content_1_0')}}<br>
	        {{Lang::get('index/index.content_1_1')}}<br>
	        <h3 class="head">{{Lang::get('index/index.questions')}}</h3>
			<div class="accordion" id="accordion">
				<div class="accordion-group">
					<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
						{{Lang::get('index/index.avantage_contributor')}}
						</a>
					</div>
					<div id="collapseOne" class="accordion-body collapse in">
						<div class="accordion-inner">
							<p>{{Lang::get('index/index.avantage_contributor_1')}}</p>
							<p>{{Lang::get('index/index.avantage_contributor_2')}}</p>
						</div>
					</div>
				</div>
				<div class="accordion-group">
					<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
						{{Lang::get('index/index.avantage_association')}}
						</a>
					</div>
					<div id="collapseTwo" class="accordion-body collapse">
						<div class="accordion-inner">
							<p>{{Lang::get('index/index.avantage_association_1')}}</p>
							<p>{{Lang::get('index/index.avantage_association_2')}}</p>
						</div>
					</div>
				</div>
				<div class="accordion-group">
					<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
						{{Lang::get('index/index.join_us')}}
						</a>
					</div>
					<div id="collapseThree" class="accordion-body collapse">
						<div class="accordion-inner">
							<p>{{Lang::get('index/index.join_us_1')}}</p>
						</div>
					</div>
				</div>
				<div class="accordion-group">
					<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
						{{Lang::get('index/index.your_right')}}
						</a>
					</div>
					<div id="collapseFour" class="accordion-body collapse">
						<div class="accordion-inner">
							<p>{{Lang::get('index/index.your_right_1')}}</p>
							<p>{{Lang::get('index/index.your_right_2')}}</p>
						</div>
					</div>
				</div>
			</div>
        </div>
    </section>

@stop