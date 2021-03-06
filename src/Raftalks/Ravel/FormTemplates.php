<?php

Form::decorate('text',function($textInput)
{
	$textInput->class('text-input');
});

Form::decorate('password',function($textInput)
{
	$textInput->class('text-input');
});



Html::macro('box_panel',function($title, $callback)
{
	return Form::template('div',function($div) use($title, $callback)
	{

		$div->div(function($div) use($title)
		{
			$div->h3($title);
			$div->setClass('content-box-header');
		});

		$div->div(function($div) use($callback)
		{
			$callback($div);
			$div->setClass('content-box-content');
		});

		$div->setCLass('content-box');
	});
});


Html::macro('content_panel',function($title, $callback, $toolbarCallback = null)
{
	return Form::template('div',function($div) use($title, $callback, $toolbarCallback)
	{

		$div->div(function($div) use($title)
		{
			$div->h3($title);

			// $div->div(function($div)
			// {
			// 	$div->button('create')->class('button');

			// 	$div->setClass('align-right');
			// });

			$div->setClass('content-box-header');
		});

		$div->div(function($div) use($callback, $toolbarCallback)
		{
			if(!is_null($toolbarCallback))
			{
				$div->div(function($div) use($toolbarCallback)
	            {
	                  $toolbarCallback($div);
	                  $div->setClass('toolbar');
	            });

			}
			
			$callback($div);
			$div->setClass('content-box-content');
		});

		$div->setCLass('content-box');
	});
});



Form::macro('box_panel',function($title, $callback)
{
	$macro = Html::getMacro('box_panel');
	return $macro($title, $callback);
});





function get_form_error_message($form, $name, $format=':message')
{
	$errors = $form->get_errors();
	$error_message = null;

	if(!is_null($errors) && is_object($errors))
	{
		if($errors->has($name))
		{
			$error_message = $errors->first($name,':message');
		}
	}

	return $error_message;
}


function have_error($form, $name)
{
	$errors = $form->get_errors();
	if(!is_null($errors) && is_object($errors))
	{
		return $errors->has($name);
		
	}

	return false;
}



Form::include_all(function()
{
	return Form::template('div',function($form)
	{
		$form->hidden('csrf_token')->value(Session::getToken());
		$form->setClass('token');
	});
});



Form::macro('show_input_error',function($name, $message=null)
{
	return Form::template('span',function($form) use($name, $message)
	{
		$error_message = get_form_error_message($form, $name);			

		if(!is_null($error_message))
		{
			
			$form->putText($error_message);
			//$form->setRootAttr('data-title',$error_message);
			$form->setClass('help-block text-error');
		}
		else
		{
			
			$form->putText($message);

			$form->setClass('help-block');
		}
		
	});
});


Form::macro('break',function()
{
	return Form::template('br',function($form)
	{

	});
});


Form::macro('input_textarea', function($name, $label, $value=null, $attr = array())
{
	if(is_null($value) || $value =='')
	{
		$value = Input::old($name);
	}

	return Form::template('div',function($form) use ($name, $label, $attr, $value)
	{
		if(have_error($form, $name))
		{
			$attr['class']='error';
			$form->setClass('error');

		}
		$form->label($label)->for($name);
		$form->textarea($name)->value($value)->setAttributes($attr);
		$form->show_input_error($name);

		$form->setClass('input');
	});
});



Form::macro('input_number', function($name, $label, $value=null, $attr = array())
{
	if(is_null($value) || $value =='')
	{
		$value = Input::old($name);
	}

	return Form::template('div',function($form) use ($name, $label, $attr, $value)
	{
		if(have_error($form, $name))
		{
			$attr['class']='error';
			$form->setClass('error');

		}
		//$form->label($label)->for($name);
		$form->number($name)->placeholder($label)->value($value)->step('any')->setAttributes($attr);
		$form->show_input_error($name);

		$form->setClass('input');
	});
});






Form::macro('input_text', function($name, $label, $value=null, $attr = array())
{
	if(is_null($value) || $value =='')
	{
		$value = Input::old($name);
	}

	return Form::template('div',function($form) use ($name, $label, $attr, $value)
	{
		if(have_error($form, $name))
		{
			$attr['class']='error';
			$form->setClass('error');

		}
		//$form->label($label)->for($name);
		$form->text($name)->placeholder($label)->value($value)->setAttributes($attr);
		$form->show_input_error($name);

		$form->setClass('input');
	});
});








Form::macro('input_text_fill', function($name, $label, $value=null, $attr = array())
{
	if(is_null($value) || $value =='')
	{
		$value = Input::old($name);
	}

	return Form::template('div',function($form) use ($name, $label, $attr, $value)
	{
		if(have_error($form, $name))
		{
			$attr['class']='error';
			$form->setClass('error');

		}

		$form->text($name)->placeholder($label)->value($value)->class('fill-up')->setAttributes($attr);
		$form->show_input_error($name);

		$form->setClass('input');
	});
});




Form::macro('input_text_small', function($name, $label, $value=null, $attr = array())
{
	if(is_null($value) || $value =='')
	{
		$value = Input::old($name);
	}

	return Form::template('div',function($form) use ($name, $label, $attr, $value)
	{
		if(have_error($form, $name))
		{
			$attr['class']='error';
			$form->setClass('error');
		}

		$form->text($name)->placeholder($label)->value($value)->class('input-small')->setAttributes($attr);
		$form->show_input_error($name);

		$form->setClass('input');
	});

});



Form::macro('input_text_large', function($name, $label, $value=null, $attr = array())
{
	if(is_null($value) || $value =='')
	{
		$value = Input::old($name);
	}

	return Form::template('div',function($form) use ($name, $label, $attr, $value)
	{
		if(have_error($form, $name))
		{
			$attr['class']='error';
			$form->setClass('error');
		}

		$form->text($name)->placeholder($label)->value($value)->class('span4')->setAttributes($attr);
		$form->show_input_error($name);

		$form->setClass('input');
	});

});



//input password field types
Form::macro('input_password', function($name, $label, $attr = array())
{
	
	return Form::template('div',function($form) use ($name, $label, $attr)
	{
		if(have_error($form, $name))
		{
			$attr['class']='error';
			$form->setClass('error');
		}

		$form->password($name)->placeholder($label)->value(null)->setAttributes($attr);
		$form->show_input_error($name);

		$form->setClass('input');
	});
});





Form::macro('input_password_fill', function($name, $label,  $attr = array())
{

	return Form::template('div',function($form) use ($name, $label, $attr)
	{
		if(have_error($form, $name))
		{
			$attr['class']='error';
			$form->setClass('error');
		}

		$form->password($name)->placeholder($label)->value(null)->class('fill-up')->setAttributes($attr);
		$form->show_input_error($name);

		$form->setClass('input');
	});
});







Form::macro('input_checkbox', function($name, $label, $checked=false, $attr = array())
{
	if($checked)
	{
		$attr['checked'] = true;
	}
	
	return Form::template('div',function($form) use ($name, $label, $attr)
	{
		if(have_error($form, $name))
		{
			$attr['class']='error';
			$form->setClass('error');
		}

		$form->checkbox($name)->id($name)->class('normal-check')->setAttributes($attr);
		$form->label($label)->for($name);
		$form->show_input_error($name);

		$form->setClass('input');
	});
});





Form::macro('input_radio', function($name, $id, $label, $checked=false, $attr = array())
{
	if($checked)
	{
		$attr['checked'] = true;
	}
	
	return Form::template('div',function($form) use ($name, $id, $label, $attr)
	{
		if(have_error($form, $name))
		{
			$attr['class']='error';
			$form->setClass('error');
		}

		$form->radio($name)->id($id)->class('normal-radio')->setAttributes($attr);
		$form->label($label)->for($id);
		$form->show_input_error($name);

		$form->setClass('input');
	});
});





Form::macro('submit_actions',function($submitName='Submit', $CancelBt=true, $attr=array())
{

	return Form::template('div',function($form) use ($submitName, $CancelBt, $attr)
	{
		$form->submit($submitName)->class('button blue')->setAttributes($attr);
		if($CancelBt)
		{
			$returnUrl = Request::url();	
			$form->a('Cancel')->class('button')->href($returnUrl);
			
		}
	
		$form->setClass('form-actions');
	});

});


Form::macro('ng_submit_actions',function($submitName='Submit', $CancelBt=true, $attr=array())
{

	return Form::template('div',function($form) use ($submitName, $CancelBt, $attr)
	{
		$form->submit($submitName)->class('btn btn-primary')->setAttributes($attr);
		if($CancelBt)
		{
			
			$form->button('Cancel')->class('btn')->ng_click('cancel()','ng-click');
			
		}
	
		$form->setClass('form-actions');
	});

});






Form::macro('datepicker', function($name, $label, $value=null, $attr = array(), $type = 'date')
{
	if(is_null($value) || $value =='')
	{
		$value = Input::old($name);
	}

	return Form::template('div',function($form) use ($name, $label, $attr, $value, $type)
	{
		if(have_error($form, $name))
		{
			$attr['class']='error';
			$form->setClass('error');

		}

		if(!is_null($label))
		{
			$form->label($label);
		}
		
		$form->$type($name)->placeholder($label)->value($value)->class('input-medium')->setAttributes($attr);
		$form->show_input_error($name);

		$form->setClass('input');
	});

});


Form::macro('ng_datepicker',function($name, $label, $ng_model, $value = null, $attr = null)
{
	return Form::template('div',function($form) use ($name, $label, $ng_model, $value, $attr)
	{
		if(is_null($attr))
		{
			$attr = array();
		}

		if(!is_null($value))
		{
			$attr['value'] = $value;
		}

		$form->ngdatepicker('publish_date',$label)->ng_model($ng_model,'ng-model')->formatteddate('short')->setAttributes($attr);

	});
});

Form::macro('label_value', function($label, $value, $attr = array())
{
	return Form::template('div', function($form) use($label, $value, $attr)
	{
		$form->label($label);
		$form->span($value)->setAttributes($attr);
		$form->setClass('input_value');
	});
});


Form::macro('multi_select',function($name, $label, $options, $value=null, $attr=array())
{
	return Form::template('div',function($form) use($name, $label, $options, $value, $attr)
	{
		$form->select($name, $label)->options($options, $value)->multiple(true)->setAttributes($attr);
	});
});


Form::macro('input_select',function($name, $label, $options, $value=null, $attr=array())
{
	return Form::template('div',function($form) use($name, $label, $options, $value, $attr)
	{
		$form->select($name, $label)->options($options, $value)->setAttributes($attr);
	});
});


Form::macro('ng_toolbar',function($buttons)
{
	return Form::template('div',function($form) use($buttons)
	{
		foreach($buttons as $btnLabel => $btnAction)
		{
				$form->button($btnLabel)->ng_click($btnAction,'ng-click')->class('btn');
		}

		$form->setClass('panel-toolbar btn-group');
	});
});


//Accordion Template

Form::macro('acc_heading',function($parent_id, $link, $heading)
{
	return Form::template('div',function($form)use($parent_id, $link, $heading)
	{
		$form->a(function($a) use ($heading, $parent_id, $link)
		{
			$a->putText($heading);
			$a->setClass('accordion-toggle');
			$a->setDataToggle('collapse','data-toggle');
			$a->setDataParent('#'.$parent_id ,'data-parent');
			$a->setHref('#'.$link);

		});
		$form->setClass('accordion-heading');
	});
});



Form::macro('acc_group',function($parent_id, $group_id, $heading, $callback, $open)
{
	return Form::template('div',function($form)use($parent_id, $group_id, $heading, $callback, $open)
	{

		$form->acc_heading($parent_id, $group_id, $heading);
		$form->div(function($div) use ($callback, $parent_id, $group_id, $heading, $open)
		{
			

			$div->div(function($div) use($callback)
			{
				$callback($div);
				$div->setClass('accordion-inner');
			});

			$div->setId($group_id);

			$addClass = '';
			if($open)
			{
				$addClass='in';
			}
			$div->setClass('accordion-body collapse '.$addClass);
		});

		
		$form->setClass('accordion-group');
	});
});



Form::macro('accordion',function($container_id, $data)
{

		return Form::template('div',function($form) use ($data, $container_id)
		{
			$accord_id = $container_id.'_accod';
			$i = 1;
			foreach($data as $heading => $callback)
			{
				$group_id = $accord_id . $i;
				$open = ($i == 1);

					$form->acc_group($container_id, $group_id, $heading, $callback, $open);

				$i++;
			}

			$form->setId($container_id);
			$form->setClass('accordion');
		});
		
});


//layout panels

Form::macro('sub_section',function($title, $callback)
{

	return Form::template('div',function($form) use($title, $callback)
	{
		$form->h4($title);
		$form->hr();
		$form->div(function($form) use ($callback)
		{
			$callback($form);
			$form->setClass('span12');
		});
		
		$form->setClass('row-fluid');

	});
});


