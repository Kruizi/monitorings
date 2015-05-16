<?php
/**
 * @package WordPress
 * @subpackage bank-rc
 */
get_header(); // Подключаем хедер?> 

	<?php $stavki = new WP_Query(array('post_type'=>'stavki','post__in'=>array(8,9,10,11,231), 'posts_per_page' => 5, 'orderby'=>'ID', 'order'=>'DESC')); ?>
	<? while($stavki->have_posts()):$stavki->the_post(); ?>
		<div class="more_info_block" id="more_info_block_<? the_ID(); ?>">
			<? echo get_field('more_info'); ?>
		</div>
	<? endwhile; wp_reset_postdata(); ?>
		<div class="more_info_block" id="more_info_block_104">
			<? echo get_field('more_info', 104); ?>
		</div>
		<div class="more_info_block" id="more_info_block_111">
			<? echo get_field('more_info', 111); ?>
		</div>
		<div class="more_info_block" id="more_info_block_112">
			<? echo get_field('more_info', 112); ?>
		</div>
		<div class="more_info_block" id="more_info_block_231">
			<? echo get_field('more_info', 231); ?>
		</div>
		<!-- end of header -->
		<div class="big-block" id="big-block">
			<div class="heading-wrap">
				<h1>Ставки по вкладам</h1>
			</div>
			<div class="tabs-wrapper">
				<div id="tabs-container">
					<? while($stavki->have_posts()):$stavki->the_post(); ?>
						<?
							ob_start();the_ID();$the_id=ob_get_contents();ob_end_clean();
							if ($the_id!=7) {?> 
						<div id="tab<? the_ID(); ?>" class="tabs">
							<div class="tab-left">
								<? the_content(); ?>
							</div>
							<div class="tab-right">
								<div class="more-block">
									<h1>Особенности</h1>
									<p><? echo get_field('intro_text'); ?></p>
									<a href="#more_info_block_<? the_ID(); ?>" class="more_info_link save_link">Подробнее</a>
								</div>
							</div>
						</div>
						<?}?>
					<? endwhile; wp_reset_postdata(); ?>
					<ul class='etabs' id="step2">
						<? while($stavki->have_posts()):$stavki->the_post(); ?>
						    <?
							ob_start();the_ID();$the_id=ob_get_contents();ob_end_clean();
							if ($the_id!=1) {?> 
							<li class="tab"><a href="#tab<? the_ID(); ?>"><? the_title(); ?></a></li>
							<?}?>
						<? endwhile; wp_reset_postdata(); ?>
					</ul>
				</div>
			</div>
		</div>
		<div class="calc-wrapper" id="calc-wrapper">
			<h1>Калькулятор процентов по вкладу</h1>
			<div class="calc-inner-wrapper">
				<div class="calc-controls">
					<div class="radiobutton-choice-wrapper">
						<fieldset>
							<div class="field">
								<input type="radio" id="radio1" name='radio_choice' nazv="Проценты на проценты"><label for="radio1">Накапливать на депозите, увеличивая % годовых</label>
							</div>
							<div class="field">
								<input type="radio" id="radio2" name='radio_choice'nazv="Капитал-онлайн"><label for="radio2">Ежемесячная выплата процентов</label>
							</div>
							<div class="field">
								<input type="radio" id="radio3" name='radio_choice' nazv="Отличный вклад" checked><label for="radio3">Досрочное расторжение с сохранением дохода</label>
							</div>
							<!--<div class="field">
								<input type="radio" id="radio4" name='radio_choice' nazv="Максимальный доход"><label for="radio4">Получение максимального дохода</label>
							</div>-->
							<div class="field">
								<input type="radio" id="radio5" name='radio_choice' nazv="Сберкнижка пенсионера"><label for="radio5">Для пенсионеров</label>
							</div>
							<div class="field">
								<input type="radio" id="radio6" name='radio_choice' nazv="Юбилейный вклад"><label for="radio6">Получение максимального дохода</label>
							</div>
						</fieldset>
					</div>
					<div class="field" id="currency_select_box">
						<label>Валюта</label>
						<select name="currency" id="currency">
							<option value="RUB">Рубли</option>
						</select>
					</div>
					<div id="currency_legend">
						При выбранных Вами условиях доступны только вклады в рублях.
					</div>
					<div class="field">
						
						<label>Сумма вклада</label>						
						<div class="value_block"><input id='sum_value_'/></div>
						<div id='sum_slider'></div>
						<div id='sum_slider_legend'><ul></ul><div class="clear"></div></div>
						<span id='sum_value'>130 000 руб</span>
					</div>
					<div class="field">
						<label>Срок вклада</label>
						<div class="value_block"><input id='time_value_' data-currency="дней"/></div> 
						<div id='time_slider' data-disabled='none'></div>
						<span id='time_value'>3</span>
						<span class='month-end'>дней</span>
						<div id='time_slider_legend'><ul></ul><div class="clear"></div></div>
					</div>
					<div class="field field-monthly">
						<input type='checkbox' name='monthly_pay' id='monthly_pay'  />
						<label for='monthly_pay'>Ежемесячное пополнение</label>
					</div>
					<div class="field month_pay_slider_field month_pay_slider_field_none">
						<div class="value_block"><input id='month_pay_value_'/></div>
						<div id='month_pay_slider'></div>
						<div id='percent_slider_legend'><ul></ul><div class="clear"></div></div>
						<div id='month_pay_value'>100 руб</div>
					</div>
					<div class="field">
						<label>Процент по вкладу</label>
						<span id="percent_span"></span>
						<span id="percent"></span>
					</div>
				</div>
                
				<div class="calc-output-wrap">
					<div class="calc-output-outer">
						<div class="calc-output-inner">
							<span class='dep-header'>Вам подойдёт вклад:</span>
							<div class='dep-select-wrap'>
								<div id="sssdep_select"></div>
								<select id="dep_select">
									<option value="Проценты на проценты">Проценты на проценты</option>
									<option value="Капитал-онлайн плюс">Капитал-онлайн</option>
									<option value="Отличный вклад" >Отличный вклад</option>
									<!--<option value="Максимальный доход">Максимальный доход</option>-->
									<option value="Сберкнижка пенсионера">Сберкнижка пенсионера</option>
									<option value="Юбилейный вклад">Юбилейный вклад</option>
								</select>
							</div>
							<div class='today-line'>
								Открывая вклад сегодня, к <span class='today-date'></span> <span class='next-year'></span> <span class='next-year-text'>года</span>
							</div>
							<div class="your-profit">
								<span>Ваш доход по вкладу составит:</span>
								<span id="profit"></span><span class='star'>*</span>
							</div>
								<div class="currency_block">
									<span class="currency_span_text">Выплаты и оценка доходности</span>
									<span id='currency_span'></span>
								</div>
							<table>
								<tr>
									<td>Сумма к выдаче</td>
									<td><span id='sum_out'>0</span></td>
								</tr>
								<!--
								<tr style="border-top:1px #DFDFDF solid;border-bottom:1px #DFDFDF solid;">
									<td>Сумма при начислении процента</td>
									<td><span id='sum_out_w'>0</span></td>
								</tr>
								-->
								<tr>
									<td>Доходность, % годовых</td>
									<td><span id='yield_percent'>0</span>%</td>
								</tr>
							</table>
							
							<a style="margin:30px 0;" id="vklad" class="wanna-open-btn wanna-open-btn-form" href="#open_deposit"> Хочу открыть вклад </a>
							
							<!--<div class='get-gift'>Получить <span class="open_gift">подарок</span> при открытии вклада!</div>-->
							<div class='calc-output-opis' id="step3">* Данный расчет носит информационный характер и не является публичной офертой</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php $action = new WP_Query(array('post_type'=>'action', 'posts_per_page' => 1, 'orderby'=>'ID', 'order'=>'DESC')); ?>		
		<div class="action-wrapper" id="action-wrapper">
			<? 
				while($action->have_posts()):$action->the_post(); 
				$image_id = get_post_thumbnail_id();
				$image_url = wp_get_attachment_image_src($image_id, 'large ');
				$image_url = $image_url[0];
			?>
				<div class="action-wrapper-inner" style="background-image: url(<? echo $image_url; ?>);" title="<? the_title(); ?>">
					<h1><? the_title(); ?></h1>
					<? the_content();?>
					<div class="link_open_action">Подробнее</div>
				</div>
				
			<div id="open_action_description">
				<? echo get_field('description'); ?>
			</div>
				
			<? endwhile; wp_reset_postdata(); ?>
			<div id="step4"></div>
		</div>
		<?php $advantage = new WP_Query(array('post_type'=>'advantages', 'posts_per_page' => 4, 'orderby'=>'ID', 'order'=>'ASC')); ?>
		<div class="advantage-wrapper" id="advantage-wrapper">
			<div class="advantage-wrapper-inner">
				<h1>Преимущества</h1>
				<div class="advantages">
					<? 
						while($advantage->have_posts()):$advantage->the_post(); 
						$image_id = get_post_thumbnail_id();
						$image_url = wp_get_attachment_image_src($image_id, 'large ');
						$image_url = $image_url[0];
					?>
						<div class="advantage" style="background-image:url(<? echo $image_url; ?>);" normal="<? echo $image_url; ?>" hover="<? echo get_field('img'); ?>" title="<? the_title(); ?>">
							<p><? the_title(); ?></p>
						</div>
					<? endwhile; wp_reset_postdata(); ?>
				</div>
				<div id="step5"></div>
			</div>
		</div>
		<?php $about = new WP_Query(array('post_type'=>'about', 'posts_per_page' => 4, 'orderby'=>'ID', 'order'=>'ASC')); ?>
		<div class="about-wrapper" id="about-wrapper">
			<div class="about-wrapper-inner">
				<h1>О Банке</h1>
				<div class="abouts">
					<? 
						while($about->have_posts()):$about->the_post(); 
						$image_id = get_post_thumbnail_id();
						$image_url = wp_get_attachment_image_src($image_id, 'large ');
						$image_url = $image_url[0];
					?>
					<div class="about">
						<img src="<? echo $image_url; ?>" title="<? the_title(); ?>">
						<p><? the_title(); ?></p>
					</div>
					<? endwhile; wp_reset_postdata(); ?>
				</div>
				<div class="clear"></div>
				<div id="step6"></div>
			</div>
		</div>

<?php get_footer(); // Подключаем футер ?>