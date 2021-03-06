<?php
class SiteHelpers{

	static function create_radio($options){
		$txt = '<div class="control-group">';
			$txt.= SiteHelpers::add_label($options);
			$txt.= '<div class="controls"';
			if(isset($options['data-toggle']))
				$txt.= ' data-toggle="'.$options['data-toggle'].'"';

			if(!isset($options['value']))
				$options['value']='';
			$txt.= '>';
				foreach ($options['elements'] as $k => $v) {
					$txt.= '<label class="checkbox">';
					if(isset($v['checked']) || $options['value']==$v['value']){
						$txt.= Form::radio($options['name'], $v['value'],true);
					}else{
						$txt.= Form::radio($options['name'], $v['value']);
					}
					$txt.= ' '.$v['text'];
					$txt.= '</label>';
				}
			$txt.= "</div>";
		$txt.= "</div>";
		return $txt;
	}

	static function create_checkbox($options){
		$txt = '<div>';
			$txt.= SiteHelpers::add_label($options);
			$txt.= '<div class="controls"';
			if(isset($options['data-toggle']))
				$txt.= ' data-toggle="'.$options['data-toggle'].'"';
			$txt.= '>';

				foreach ($options['elements'] as $k => $v) {
					$txt.= '<label class="checkbox">';
					if(isset($v['checked'])){
						$txt.= Form::checkbox($options['name'], $v['value'],$v['checked']);
					}else{
						$txt.= Form::checkbox($options['name'], $v['value']);
					}
					$txt.= ' '.$v['text'];
					$txt.= '</label>';
				}
			$txt.= "</div>";
		$txt.= "</div>";
		return $txt;
	}
	
	static function create_input($options){
		$txt = '<div class="control-group">';
			$txt.= SiteHelpers::add_label($options);
			if(isset($options['full-width']))
				$txt.= '<div class="controls-full-width">';
			else
				$txt.= '<div class="controls">';
				$txt.= SiteHelpers::simple_input($options);
			$txt.= "</div>";
		$txt.= "</div>";
		return $txt;
	}
	
	static function create_datepicker_range(){
		$txt = '<div class="date-container">';
			$txt.= '<div class="date-range-field"><span></span>';
			$txt.= '<a href="#">▼</a></div>';
			$txt.= '<div class="datepicker-calendar"></div>';
		$txt.= "</div>";
		return $txt;
	}

	static function create_datepicker(){
		$txt = '<div class="date-container">';
			$txt.= '<div class="date-range-field"><span></span>';
			$txt.= '<a href="#">▼</a></div>';
			$txt.= '<div class="datepicker-calendar"></div>';
		$txt.= "</div>";
		return $txt;
	}

	static function simple_input($options){
		$txt= '';
			// manage the form
			$options['form']['id'] = $options['id'];
			if(isset($options['form']['data-original-title'])){
				$options['form']['data-placement'] = 'right';
				$options['form']['data-rel'] = 'tooltip';
				$options['form']['data-trigger'] = 'change';
				$options['form']['rele'] = 'tooltip';
			}
			if(!isset($options['type'])){
				$options['type'] = 'text';
			}
			if(!isset($options['value'])){
				$options['value'] = '';
			}
			$txt.= SiteHelpers::callFormClass($options);

			$txt.= '	<span class="text-error">';
				if(isset($options['errors'])){
					foreach ($options['errors']->get('pseudo','<ul class="help-inline">:message</ul>') as $message){
			            $txt.=$message;
					}
				}
		$txt.= "	</span>";
		return $txt;
	}

	static function callFormClass($options){
		switch ($options['type']) {
			case 'password':
				return Form::password($options['id'], $options['form']);
			case 'dateandtime':
				$options['form']['data-format']="dd/MM/yyyy hh:mm:ss";
				return Form::text($options['id'],$options['value'],$options['form']).'
						<span class="add-on">
                            <i data-time-icon="icon-time" data-date-icon="icon-calendar">
                            </i>
                        </span>';
		}
		return Form::text($options['id'],$options['value'],$options['form']);
	}

	static function add_label($options){
		if(isset($options['label'])){
			return '<label class="control-label">'.$options['label'].'</label>';
		}
	}


	/**
	 * Textarea with wysi generator
	 */
	static function add_textarea($name, $value, $text = false, $font = false){
		$txt =' <div>
	            <div class="btn-toolbar" data-role="editor-toolbar" data-target="#editor">';
	            if(isset($font)){
	            	$txt .='<div class="btn-group">
	                <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="icon-font"></i><b class="caret"></b></a>
	                  <ul class="dropdown-menu">
	                  </ul>
	              </div>
	              <div class="btn-group">
	                <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="icon-text-height"></i>&nbsp;<b class="caret"></b></a>
	                  <ul class="dropdown-menu">
	                  <li><a data-edit="fontSize 5"><font size="5">Huge</font></a></li>
	                  <li><a data-edit="fontSize 3"><font size="3">Normal</font></a></li>
	                  <li><a data-edit="fontSize 1"><font size="1">Small</font></a></li>
	                  </ul>
	              </div>';
	            }
	            if(isset($text)){
	              $txt .='<div class="btn-group">
	                <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="icon-bold"></i></a>
	                <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="icon-italic"></i></a>
	                <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="icon-strikethrough"></i></a>
	                <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="icon-underline"></i></a>
	              </div>
	              <div class="btn-group">
	                    <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="icon-link"></i></a>
	                    <div class="dropdown-menu">
	                        <input class="span4" placeholder="URL" type="text" data-edit="createLink"/>
	                        <button class="btn" type="button">Add</button>
	                    </div>
	                    <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="icon-cut"></i></a>
	              </div>
	              <div class="btn-group">
	                <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="icon-list-ul"></i></a>
	                <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="icon-list-ol"></i></a>
	                <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="icon-indent-left"></i></a>
	                <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="icon-indent-right"></i></a>
	              </div>
	              <div class="btn-group">
	                <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="icon-align-left"></i></a>
	                <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="icon-align-center"></i></a>
	                <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="icon-align-right"></i></a>
	                <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="icon-align-justify"></i></a>
	              </div>
	              <div class="btn-group">
	                <a class="btn" title="Insert picture (or just drag & drop)" id="pictureBtn"><i class="icon-picture"></i></a>
	                <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" />
	              </div>
	              <div class="btn-group">
	                <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="icon-undo"></i></a>
	                <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="icon-repeat"></i></a>
	              </div>
	              <input type="text" data-edit="inserttext" id="voiceBtn" x-webkit-speech="">';
				}
				$txt.='</div>
	            <div class="wysiwyg-editor" data-name="'.$name.'">
	              '.$value.'
	            </div>
	        </div>';
	    return $txt;
	}
}